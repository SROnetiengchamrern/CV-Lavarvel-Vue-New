<script setup>
import CvPhoto from '../partials/CvPhoto.vue';
import CvContact from '../partials/CvContact.vue';
import CvSkillGroups from '../partials/CvSkillGroups.vue';
import CvLanguages from '../partials/CvLanguages.vue';
import CvMainSections from '../partials/CvMainSections.vue';

defineProps({ cv: { type: Object, required: true } });
</script>

<template>
    <article class="sheet theme-mirror">
        <main class="main">
            <div class="intro">
                <CvPhoto :profile="cv.profile" size="sm" />
                <div>
                    <h1>{{ cv.profile?.full_name }}</h1>
                    <p>{{ cv.profile?.title }}</p>
                </div>
            </div>
            <CvMainSections :cv="cv" :profile="cv.profile" :show-hero="false" />
        </main>
        <aside class="sidebar">
            <CvContact :profile="cv.profile" :title="cv.ui?.contact || 'Contact'" :labels="cv.ui || {}" />
            <CvSkillGroups :skill-groups="cv.skill_groups" />
            <CvLanguages :languages="cv.languages" :title="cv.ui?.languages || 'Languages'" />
        </aside>
    </article>
</template>

<style scoped>
.theme-mirror {
    --cv-primary: #0f172a;
    --cv-accent: #38bdf8;
    --cv-accent-soft: #7dd3fc;
    --cv-accent-ink: #0f172a;
    --cv-panel: #e8eef6;
    --cv-muted: rgba(255,255,255,0.9);
}
.sheet {
    max-width: 980px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 300px;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 28px 60px -24px rgba(15, 23, 42, 0.4);
    min-width: 0;
}
.main {
    padding: 1.75rem;
    background: linear-gradient(180deg, #f8fafc, #eef3f8);
    min-width: 0;
}
.intro {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.35rem;
    padding: 0.9rem 1rem;
    border-radius: 14px;
    background: #fff;
    border: 1px solid #e2e8f0;
}
.intro h1 {
    margin: 0;
    font-family: Outfit, sans-serif;
    font-size: clamp(1.35rem, 2.5vw, 1.85rem);
    color: #0f172a;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    overflow-wrap: anywhere;
}
.intro p {
    margin: 0.3rem 0 0;
    color: #0284c7;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    font-size: 0.8rem;
}
.sidebar {
    background:
        radial-gradient(circle at top right, rgba(56,189,248,0.2), transparent 45%),
        linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
    color: #fff;
    padding: 1.75rem 1.25rem 2rem;
}
@media (max-width: 820px) {
    .sheet { grid-template-columns: 1fr; }
    .sidebar { order: -1; }
    .main, .sidebar { padding: 1.2rem 1rem; }
}
</style>
