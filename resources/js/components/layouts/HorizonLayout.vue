<script setup>
import CvPhoto from '../partials/CvPhoto.vue';
import CvContact from '../partials/CvContact.vue';
import CvSkillGroups from '../partials/CvSkillGroups.vue';
import CvLanguages from '../partials/CvLanguages.vue';
import CvMainSections from '../partials/CvMainSections.vue';

defineProps({ cv: { type: Object, required: true } });
</script>

<template>
    <article class="sheet theme-horizon">
        <header class="banner">
            <div class="banner-glow" aria-hidden="true" />
            <CvPhoto :profile="cv.profile" size="lg" />
            <div class="banner-text">
                <h1>{{ cv.profile?.full_name }}</h1>
                <p>{{ cv.profile?.title }}</p>
                <div class="banner-meta">
                    <span v-if="cv.profile?.email">{{ cv.profile.email }}</span>
                    <span v-if="cv.profile?.phone_primary">{{ cv.profile.phone_primary }}</span>
                    <span v-if="cv.profile?.address">{{ cv.profile.address }}</span>
                </div>
            </div>
        </header>
        <div class="body">
            <aside class="side">
                <CvSkillGroups :skill-groups="cv.skill_groups" />
                <CvLanguages :languages="cv.languages" :title="cv.ui?.languages || 'Languages'" />
                <div class="side-contact"><CvContact :profile="cv.profile" :title="cv.ui?.contact || 'Contact'" :labels="cv.ui || {}" /></div>
            </aside>
            <main class="main">
                <CvMainSections :cv="cv" :profile="cv.profile" :show-hero="false" />
            </main>
        </div>
    </article>
</template>

<style scoped>
.theme-horizon {
    --cv-primary: #2c3e5b;
    --cv-accent: #f0b35a;
    --cv-accent-soft: #f6d09a;
    --cv-accent-ink: #172033;
    --cv-panel: #f1ebe2;
    --cv-muted: rgba(255,255,255,0.9);
}
.sheet {
    max-width: 980px;
    margin: 0 auto;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 28px 60px -24px rgba(23, 32, 51, 0.42);
    min-width: 0;
}
.banner {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.8rem;
    color: #fff;
    background: linear-gradient(120deg, #172033 0%, #2c3e5b 55%, #3f5578 100%);
    overflow: hidden;
}
.banner-glow {
    position: absolute;
    right: -40px;
    top: -60px;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(240,179,90,0.35), transparent 70%);
}
.banner-text { position: relative; z-index: 1; }
.banner-text h1 {
    margin: 0;
    font-family: Outfit, sans-serif;
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    letter-spacing: 0.05em;
    text-transform: uppercase;
    overflow-wrap: anywhere;
}
.banner-text p {
    margin: 0.4rem 0 0.75rem;
    color: #f0b35a;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    font-size: 0.9rem;
    font-weight: 700;
}
.banner-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.35rem 1rem;
    font-size: 0.84rem;
    opacity: 0.92;
}
.body { display: grid; grid-template-columns: 280px 1fr; min-width: 0; }
.side {
    background: linear-gradient(180deg, #1d2a40, #243247);
    color: #fff;
    padding: 1.35rem 1.15rem;
}
.side-contact { margin-top: 1rem; }
.main { padding: 1.5rem; background: linear-gradient(180deg, #fbf8f3, #f3eee6); min-width: 0; }
@media (max-width: 820px) {
    .banner { flex-direction: column; text-align: center; }
    .banner-meta { justify-content: center; }
    .body { grid-template-columns: 1fr; }
}
</style>
