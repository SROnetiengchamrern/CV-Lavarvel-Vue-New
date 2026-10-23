<script setup>
import { computed } from 'vue';
import CvDocButtons from './CvDocButtons.vue';
import CvSectionIcon from './CvSectionIcon.vue';

const props = defineProps({
    profile: { type: Object, default: () => ({}) },
    cv: { type: Object, required: true },
    showHero: { type: Boolean, default: true },
});

const ui = computed(() => props.cv?.ui || {});
</script>

<template>
    <div class="cv-main-sections">
        <header v-if="showHero" class="hero">
            <h1>{{ profile.full_name }}</h1>
            <div class="title-line"><span>{{ profile.title }}</span></div>
        </header>

        <section class="panel">
            <h2 class="pill"><CvSectionIcon name="personal" /><span>{{ ui.personal_data || 'Personal Data' }}</span></h2>
            <dl class="data-grid">
                <template v-if="profile.gender"><dt>{{ ui.gender || 'Gender' }}</dt><dd>{{ profile.gender }}</dd></template>
                <template v-if="profile.date_of_birth"><dt>{{ ui.date_of_birth || 'Date of Birth' }}</dt><dd>{{ profile.date_of_birth }}</dd></template>
                <template v-if="profile.marital_status"><dt>{{ ui.marital_status || 'Marital Status' }}</dt><dd>{{ profile.marital_status }}</dd></template>
                <template v-if="profile.nationality"><dt>{{ ui.nationality || 'Nationality' }}</dt><dd>{{ profile.nationality }}</dd></template>
                <template v-if="profile.place_of_birth"><dt>{{ ui.place_of_birth || 'Place of Birth' }}</dt><dd>{{ profile.place_of_birth }}</dd></template>
            </dl>
        </section>

        <section class="panel">
            <h2 class="pill"><CvSectionIcon name="education" /><span>{{ ui.education || 'Education Background' }}</span></h2>
            <ul class="timeline">
                <li v-for="item in cv.education" :key="item.id">
                    <span class="years">{{ item.years }}</span>
                    <div class="timeline-body">
                        <strong>{{ item.institution }}</strong>
                        <span v-if="item.description">{{ item.description }}</span>
                        <CvDocButtons :documents="item.documents || []" />
                    </div>
                </li>
            </ul>
        </section>

        <section class="panel">
            <h2 class="pill"><CvSectionIcon name="experience" /><span>{{ ui.experience || 'Work Experiences' }}</span></h2>
            <ul class="timeline">
                <li v-for="job in cv.experiences" :key="job.id">
                    <span class="years">{{ job.years }}</span>
                    <div class="timeline-body">
                        <strong>{{ job.company }}</strong>
                        <em v-if="job.role">{{ job.role }}</em>
                        <ul v-if="job.highlights?.length" class="highlights">
                            <li v-for="(h, i) in job.highlights" :key="i">{{ h }}</li>
                        </ul>
                    </div>
                </li>
            </ul>
        </section>

        <section class="panel">
            <h2 class="pill"><CvSectionIcon name="training" /><span>{{ ui.training || 'Other Training' }}</span></h2>
            <ul class="plain-list">
                <li v-for="item in cv.trainings" :key="item.id">{{ item.description }}</li>
            </ul>
        </section>

        <section v-if="cv.aws_courses?.length" class="panel">
            <h2 class="pill"><CvSectionIcon name="aws" /><span>{{ ui.aws_courses || 'AWS Courses & Certificates' }}</span></h2>
            <ul class="aws-list">
                <li v-for="course in cv.aws_courses" :key="course.id" class="aws-item">
                    <div class="aws-head">
                        <span class="aws-badge" :style="{ background: course.badge_color || '#0ea5e9' }" />
                        <div class="aws-meta">
                            <strong>{{ course.display_title || course.title }}</strong>
                            <span class="aws-role">
                                {{ course.role || 'Student' }}
                                · {{ course.is_completed ? (ui.completed || 'Completed') : (ui.in_progress || 'In progress') }}
                            </span>
                        </div>
                    </div>
                    <CvDocButtons :documents="course.certificates || []" />
                </li>
            </ul>
        </section>

        <section class="panel">
            <h2 class="pill"><CvSectionIcon name="interests" /><span>{{ ui.interests || 'Special Interest' }}</span></h2>
            <ul class="plain-list">
                <li v-for="item in cv.interests" :key="item.id">{{ item.description }}</li>
            </ul>
        </section>

        <section class="panel">
            <h2 class="pill"><CvSectionIcon name="references" /><span>{{ ui.references || 'References' }}</span></h2>
            <div class="refs">
                <div v-for="ref in cv.references" :key="ref.id" class="ref-card">
                    <strong>{{ ref.name }}</strong>
                    <span v-if="ref.title">{{ ref.title }}</span>
                    <span v-if="ref.organization">{{ ref.organization }}</span>
                    <span v-if="ref.phone">{{ ui.tel || 'Tel' }}: {{ ref.phone }}</span>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
.hero {
    text-align: center;
    margin-bottom: 1.5rem;
    padding: 0.65rem 1rem 1rem;
    border: 1px solid color-mix(in srgb, var(--cv-primary, #1a1a4b) 12%, transparent);
    background: #fff;
}
.hero h1 {
    margin: 0;
    font-family: var(--font-display, Outfit, 'Kantumruy Pro', sans-serif);
    font-size: clamp(1.5rem, 3vw, 2.25rem);
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--cv-primary, #1a1a4b);
    overflow-wrap: anywhere;
}
.title-line {
    margin-top: 0.55rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.85rem;
    color: var(--cv-primary, #1a1a4b);
    font-family: var(--font-display, Outfit, 'Kantumruy Pro', sans-serif);
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    font-size: 0.9rem;
}
.title-line::before,
.title-line::after {
    content: '';
    height: 1px;
    width: 40px;
    background: color-mix(in srgb, var(--cv-primary, #1a1a4b) 35%, transparent);
}
.panel {
    background: var(--cv-panel, #f0f2f5);
    padding: 0.85rem 1rem 1rem;
    margin-bottom: 1rem;
    border-radius: 0 12px 12px 0;
}
.pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    margin: 0 0 0.85rem;
    padding: 0.35rem 1rem;
    border-radius: 999px;
    font-family: var(--font-display, Outfit, 'Kantumruy Pro', sans-serif);
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    background: var(--cv-primary, #1a1a4b);
    color: #fff;
}
.data-grid {
    display: grid;
    grid-template-columns: 140px 1fr;
    gap: 0.35rem 0.75rem;
    margin: 0;
    font-size: 0.92rem;
}
.data-grid dt { font-weight: 600; color: var(--cv-text-muted, #5a5a72); }
.data-grid dd { margin: 0; }
.timeline, .plain-list, .highlights { list-style: none; margin: 0; padding: 0; }
.timeline li {
    display: grid;
    grid-template-columns: 120px 1fr;
    gap: 0.75rem;
    margin-bottom: 0.85rem;
    font-size: 0.92rem;
}
.years { font-weight: 700; color: var(--cv-primary, #1a1a4b); font-size: 0.84rem; }
.timeline-body { display: flex; flex-direction: column; gap: 0.15rem; }
.timeline-body em { font-style: normal; color: var(--cv-text-muted, #5a5a72); font-size: 0.86rem; }
.timeline-body strong { overflow-wrap: anywhere; }
.highlights { margin-top: 0.25rem; }
.highlights li {
    display: list-item;
    list-style: disc;
    margin-left: 1.1rem;
    margin-bottom: 0.15rem;
    grid-template-columns: none;
}
.plain-list li {
    position: relative;
    padding-left: 0.95rem;
    margin-bottom: 0.4rem;
    font-size: 0.92rem;
}
.plain-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.5rem;
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--cv-primary, #1a1a4b);
}
.refs { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.ref-card {
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
    font-size: 0.88rem;
    overflow-wrap: anywhere;
}
.ref-card strong { color: var(--cv-primary, #1a1a4b); }

.aws-list { list-style: none; margin: 0; padding: 0; }
.aws-item {
    padding: 0.7rem 0;
    border-bottom: 1px solid color-mix(in srgb, var(--cv-primary, #1a1a4b) 10%, transparent);
}
.aws-item:last-child { border-bottom: none; }
.aws-head {
    display: flex;
    align-items: flex-start;
    gap: 0.65rem;
}
.aws-badge {
    width: 12px;
    height: 12px;
    border-radius: 3px;
    margin-top: 0.35rem;
    flex-shrink: 0;
}
.aws-meta {
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
    min-width: 0;
}
.aws-meta strong {
    color: var(--cv-primary, #1a1a4b);
    font-size: 0.92rem;
    overflow-wrap: anywhere;
}
.aws-role {
    font-size: 0.8rem;
    color: var(--cv-text-muted, #5a5a72);
}
@media (max-width: 820px) {
    .timeline li, .data-grid, .refs { grid-template-columns: 1fr; }
    .data-grid dt { margin-top: 0.35rem; }
    .title-line { font-size: 0.78rem; gap: 0.5rem; }
    .title-line::before, .title-line::after { width: 24px; }
}
</style>
