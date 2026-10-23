<script setup>
import CvPhoto from '../partials/CvPhoto.vue';
import CvContact from '../partials/CvContact.vue';
import CvSkillGroups from '../partials/CvSkillGroups.vue';
import CvLanguages from '../partials/CvLanguages.vue';
import CvMainSections from '../partials/CvMainSections.vue';

defineProps({ cv: { type: Object, required: true } });
</script>

<template>
    <article class="sheet theme-classic">
        <aside class="sidebar">
            <div class="photo-wrap"><CvPhoto :profile="cv.profile" /></div>
            <CvContact :profile="cv.profile" :title="cv.ui?.contact || 'Contact'" :labels="cv.ui || {}" />
            <CvSkillGroups :skill-groups="cv.skill_groups" />
            <CvLanguages :languages="cv.languages" :title="cv.ui?.languages || 'Languages'" />
        </aside>
        <main class="main">
            <CvMainSections :cv="cv" :profile="cv.profile" />
        </main>
    </article>
</template>

<style scoped>
.theme-classic {
    --cv-primary: #1a1a4b;
    --cv-accent: #7ec8e8;
    --cv-accent-soft: #a8d8ea;
    --cv-accent-ink: #12123a;
    --cv-panel: #eef1f7;
    --cv-muted: rgba(255,255,255,0.88);
}
.sheet {
    max-width: 980px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 300px 1fr;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 28px 60px -24px rgba(18, 18, 58, 0.45);
    min-width: 0;
}
.sidebar {
    background:
        radial-gradient(circle at top, rgba(126,200,232,0.18), transparent 45%),
        linear-gradient(180deg, #0f1030 0%, #1a1a4b 55%, #243063 100%);
    color: #fff;
    padding: 1.8rem 1.25rem 2rem;
}
.photo-wrap { display: flex; justify-content: center; margin-bottom: 1.4rem; }
.main {
    padding: 1.75rem;
    background:
        linear-gradient(180deg, #ffffff 0%, #f5f7fb 100%);
    min-width: 0;
}
@media (max-width: 820px) {
    .sheet { grid-template-columns: 1fr; }
    .sidebar, .main { padding: 1.2rem 1rem; }
}
</style>
