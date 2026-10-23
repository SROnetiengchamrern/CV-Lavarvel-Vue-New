<script setup>
import CvPhoto from '../partials/CvPhoto.vue';
import CvContact from '../partials/CvContact.vue';
import CvSkillGroups from '../partials/CvSkillGroups.vue';
import CvLanguages from '../partials/CvLanguages.vue';
import CvMainSections from '../partials/CvMainSections.vue';

defineProps({ cv: { type: Object, required: true } });
</script>

<template>
    <article class="sheet theme-minimal">
        <div class="accent-stripe" aria-hidden="true" />
        <div class="inner">
            <header class="top">
                <CvPhoto :profile="cv.profile" size="md" />
                <div>
                    <h1>{{ cv.profile?.full_name }}</h1>
                    <p class="role">{{ cv.profile?.title }}</p>
                </div>
            </header>
            <div class="grid">
                <aside class="side">
                    <CvContact :profile="cv.profile" :title="cv.ui?.contact || 'Contact'" :labels="cv.ui || {}" />
                    <CvSkillGroups :skill-groups="cv.skill_groups" />
                    <CvLanguages :languages="cv.languages" :title="cv.ui?.languages || 'Languages'" />
                </aside>
                <main class="main">
                    <CvMainSections :cv="cv" :profile="cv.profile" :show-hero="false" />
                </main>
            </div>
        </div>
    </article>
</template>

<style scoped>
.theme-minimal {
    --cv-primary: #0f172a;
    --cv-accent: #2563eb;
    --cv-accent-soft: #93c5fd;
    --cv-accent-ink: #ffffff;
    --cv-panel: #eff6ff;
    --cv-muted: #475569;
}
.sheet {
    max-width: 920px;
    margin: 0 auto;
    background: #fff;
    border-radius: 18px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 24px 50px -22px rgba(15, 23, 42, 0.28);
    border: 1px solid #e2e8f0;
    min-width: 0;
}
.accent-stripe {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 10px;
    background: linear-gradient(180deg, #2563eb, #0ea5e9 55%, #38bdf8);
}
.inner { padding: 1.8rem 1.8rem 1.8rem 2.1rem; }
.top {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 1.6rem;
    padding-bottom: 1.2rem;
    border-bottom: 2px solid #e2e8f0;
}
.top :deep(.cv-photo) {
    border-color: #bfdbfe;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.18);
}
.top h1 {
    margin: 0;
    font-family: Outfit, sans-serif;
    font-size: clamp(1.55rem, 3vw, 2.05rem);
    color: #0f172a;
    letter-spacing: 0.02em;
    overflow-wrap: anywhere;
}
.role {
    margin: 0.35rem 0 0;
    color: #2563eb;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    font-size: 0.84rem;
}
.grid {
    display: grid;
    grid-template-columns: 250px 1fr;
    gap: 1.35rem;
    min-width: 0;
}
.side {
    color: #1e293b;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 1rem;
    border-radius: 14px;
}
.side :deep(.cv-heading),
.side :deep(.sub.accent) {
    background: #2563eb;
    color: #fff;
}
.side :deep(.skill-bar) { background: #e2e8f0; }
.side :deep(.dot) { background: #cbd5e1; }
.side :deep(.dot.filled) { background: #2563eb; }
.side :deep(.bullet-list li::before) { background: #2563eb; }
.main { min-width: 0; }
@media (max-width: 820px) {
    .inner { padding: 1.15rem 1rem 1.15rem 1.4rem; }
    .top { flex-direction: column; text-align: center; }
    .grid { grid-template-columns: 1fr; }
}
</style>
