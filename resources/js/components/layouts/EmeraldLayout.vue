<script setup>
import CvPhoto from '../partials/CvPhoto.vue';
import CvContact from '../partials/CvContact.vue';
import CvSkillGroups from '../partials/CvSkillGroups.vue';
import CvLanguages from '../partials/CvLanguages.vue';
import CvMainSections from '../partials/CvMainSections.vue';

defineProps({ cv: { type: Object, required: true } });
</script>

<template>
    <article class="sheet theme-emerald">
        <aside class="sidebar">
            <div class="photo-wrap"><CvPhoto :profile="cv.profile" /></div>
            <div class="name-block">
                <h1>{{ cv.profile?.full_name }}</h1>
                <p>{{ cv.profile?.title }}</p>
            </div>
            <CvContact :profile="cv.profile" :title="cv.ui?.contact || 'Contact'" :labels="cv.ui || {}" />
            <CvSkillGroups :skill-groups="cv.skill_groups" />
            <CvLanguages :languages="cv.languages" :title="cv.ui?.languages || 'Languages'" />
        </aside>
        <main class="main">
            <CvMainSections :cv="cv" :profile="cv.profile" :show-hero="false" />
        </main>
    </article>
</template>

<style scoped>
.theme-emerald {
    --cv-primary: #1b5a45;
    --cv-accent: #d4a017;
    --cv-accent-soft: #e6c35a;
    --cv-accent-ink: #0b2e24;
    --cv-panel: #e8f2ed;
    --cv-muted: rgba(255,255,255,0.9);
}
.sheet {
    max-width: 980px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 300px 1fr;
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 28px 60px -24px rgba(11, 46, 36, 0.42);
    min-width: 0;
}
.sidebar {
    background:
        radial-gradient(circle at 20% 10%, rgba(212,160,23,0.22), transparent 40%),
        linear-gradient(165deg, #0b2e24 0%, #1b5a45 55%, #247055 100%);
    color: #fff;
    padding: 1.8rem 1.25rem 2rem;
}
.photo-wrap { display: flex; justify-content: center; margin-bottom: 1rem; }
.name-block {
    text-align: center;
    margin-bottom: 1.3rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(212, 160, 23, 0.35);
}
.name-block h1 {
    margin: 0;
    font-family: Outfit, sans-serif;
    font-size: 1.2rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
}
.name-block p {
    margin: 0.35rem 0 0;
    color: #d4a017;
    font-size: 0.8rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    font-weight: 700;
}
.main { padding: 1.75rem; background: linear-gradient(180deg, #fbfffd, #f1f7f4); min-width: 0; }
@media (max-width: 820px) {
    .sheet { grid-template-columns: 1fr; }
    .sidebar, .main { padding: 1.2rem 1rem; }
}
</style>
