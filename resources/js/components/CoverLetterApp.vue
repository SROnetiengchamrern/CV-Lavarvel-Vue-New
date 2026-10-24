<script setup>
import { computed, watchEffect } from 'vue';
import LangFlag from './partials/LangFlag.vue';

const props = defineProps({
    letter: { type: Object, required: true },
});

const ui = computed(() => props.letter.ui || {});
const locale = computed(() => props.letter.locale || 'en');
const locales = computed(() => props.letter.locales || { en: 'English', km: 'ខ្មែរ' });
const profile = computed(() => props.letter.profile || {});

watchEffect(() => {
    document.documentElement.lang = locale.value;
    document.documentElement.classList.toggle('locale-km', locale.value === 'km');
});

const paragraphs = computed(() => {
    const text = props.letter.body || '';
    return text
        .split(/\n\s*\n/)
        .map((p) => p.trim())
        .filter(Boolean);
});

const closingLines = computed(() => {
    const text = props.letter.closing || '';
    return text
        .split(/\n/)
        .map((p) => p.trim())
        .filter(Boolean);
});

const photoUrl = computed(() => props.letter.photo_url || null);

function switchLocale(code) {
    const redirect = encodeURIComponent(window.location.href);
    window.location.href = `/lang/${code}?redirect=${redirect}`;
}
</script>

<template>
    <div class="page">
        <div class="toolbar no-print">
            <a href="/">← {{ ui.back_to_cv || 'Back to CV' }}</a>
            <div class="actions">
                <div class="lang-switch">
                    <button
                        v-for="(label, code) in locales"
                        :key="code"
                        type="button"
                        class="lang-chip"
                        :class="{ active: locale === code }"
                        @click="switchLocale(code)"
                    >
                        <LangFlag :code="code" />
                        <span>{{ label }}</span>
                    </button>
                </div>
            </div>
        </div>

        <article class="sheet">
            <header class="banner">
                <div class="photo-wrap">
                    <img v-if="photoUrl" :src="photoUrl" :alt="profile.full_name" class="photo" />
                    <div v-else class="photo fallback">
                        {{ (profile.full_name || 'TC').split(' ').map(w => w[0]).join('').slice(0, 2) }}
                    </div>
                </div>
                <div class="banner-text">
                    <h1>{{ profile.full_name }}</h1>
                    <p>{{ profile.title }}</p>
                </div>
            </header>

            <div class="body">
                <h2 class="title">{{ ui.cover_letter || 'Cover Letter' }}</h2>

                <aside class="contact">
                    <div v-if="profile.full_name"><strong>{{ ui.name || 'Name' }}</strong><span>{{ profile.full_name }}</span></div>
                    <div v-if="profile.email"><strong>{{ ui.email || 'E-mail' }}</strong><span>{{ profile.email }}</span></div>
                    <div v-if="profile.phone_primary || profile.phone_secondary">
                        <strong>{{ ui.tel || 'Tel' }}</strong>
                        <span>
                            <template v-if="profile.phone_primary">(+855) {{ profile.phone_primary }}</template>
                            <template v-if="profile.phone_primary && profile.phone_secondary"> : </template>
                            <template v-if="profile.phone_secondary">(+855) {{ profile.phone_secondary }}</template>
                        </span>
                    </div>
                    <div v-if="profile.address"><strong>{{ ui.address || 'Address' }}</strong><span>{{ profile.address }}</span></div>
                </aside>

                <div class="letter">
                    <p class="salutation">{{ letter.salutation }}</p>
                    <p v-for="(para, i) in paragraphs" :key="i">{{ para }}</p>
                    <p v-for="(line, i) in closingLines" :key="'c'+i">{{ line }}</p>

                    <div class="sign">
                        <div class="sign-script">{{ letter.signature }}</div>
                        <div class="sign-name">{{ letter.signature }}</div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</template>

<style scoped>
.page {
    padding: 1.5rem 1rem 2.5rem;
    min-height: 100vh;
}
.toolbar {
    max-width: 900px;
    margin: 0 auto 1rem;
    display: flex;
    justify-content: space-between;
    gap: 0.75rem;
    flex-wrap: wrap;
}
.toolbar a,
.toolbar button {
    font: inherit;
    font-size: 0.85rem;
    font-weight: 700;
    text-decoration: none;
    border: none;
    cursor: pointer;
    padding: 0.55rem 1rem;
    border-radius: 999px;
    background: #1a1a4b;
    color: #fff;
}
.actions { display: flex; gap: 0.5rem; flex-wrap: wrap; align-items: center; }
.lang-switch { display: inline-flex; gap: 0.3rem; }
.lang-chip {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.4rem !important;
    border: 1px solid #cfd5e2 !important;
    background: #fff !important;
    color: #1a1a4b !important;
    padding: 0.4rem 0.8rem !important;
    font-size: 0.78rem !important;
}
.lang-chip.active {
    background: #1a1a4b !important;
    border-color: #1a1a4b !important;
    color: #fff !important;
}
.sheet {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 24px 50px -20px rgba(26, 26, 75, 0.35);
}
.banner {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    padding: 1.35rem 1.75rem;
    background: linear-gradient(90deg, #e8ecf4, #f4f6fa);
    border-bottom: 1px solid #d9deea;
}
.photo {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 8px 18px rgba(26, 26, 75, 0.2);
}
.fallback {
    display: grid;
    place-items: center;
    background: #7ec8e8;
    color: #1a1a4b;
    font-family: var(--font-display, Outfit, 'Kantumruy Pro', sans-serif);
    font-weight: 800;
    font-size: 1.8rem;
}
.banner-text h1 {
    margin: 0;
    font-family: var(--font-display, Outfit, 'Kantumruy Pro', sans-serif);
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    color: #1a1a4b;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}
.banner-text p {
    margin: 0.35rem 0 0;
    color: #2a2a6b;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    font-size: 0.95rem;
}
.body {
    position: relative;
    padding: 1.5rem 1.75rem 2rem;
}
.title {
    margin: 0 0 1.1rem;
    text-align: center;
    font-family: var(--font-display, Outfit, 'Kantumruy Pro', sans-serif);
    color: #1a1a4b;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    font-size: 1.35rem;
}
.contact {
    position: absolute;
    top: 4.2rem;
    right: 1.75rem;
    width: min(280px, 42%);
    text-align: right;
    font-size: 0.82rem;
    line-height: 1.35;
    color: #1e1e2f;
}
.contact div {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 0.45rem;
    margin-bottom: 0.35rem;
    align-items: start;
}
.contact strong {
    color: #1a1a4b;
    justify-self: end;
}
.contact span {
    text-align: left;
    overflow-wrap: anywhere;
}
.letter {
    max-width: 58%;
    color: #222;
    font-size: 0.95rem;
    line-height: 1.65;
}
.salutation {
    font-weight: 700;
    margin-bottom: 0.9rem;
}
.letter p { margin: 0 0 0.95rem; text-align: justify; }
.sign { margin-top: 1.6rem; }
.sign-script {
    font-family: 'Segoe Script', 'Brush Script MT', cursive;
    font-size: 1.7rem;
    color: #1a1a4b;
    line-height: 1.1;
}
.sign-name {
    margin-top: 0.35rem;
    font-weight: 700;
    letter-spacing: 0.04em;
}
@media (max-width: 820px) {
    .banner { flex-direction: column; text-align: center; }
    .contact {
        position: static;
        width: 100%;
        text-align: left;
        margin-bottom: 1.25rem;
    }
    .contact div { grid-template-columns: 80px 1fr; }
    .contact strong { justify-self: start; }
    .letter { max-width: 100%; }
}
@media print {
    .page { padding: 0; background: #fff; }
    .no-print { display: none !important; }
    .sheet { box-shadow: none; border-radius: 0; }
}
</style>
