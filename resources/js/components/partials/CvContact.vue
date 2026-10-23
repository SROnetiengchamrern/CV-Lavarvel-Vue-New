<script setup>
import CvSectionIcon from './CvSectionIcon.vue';

defineProps({
    profile: { type: Object, default: () => ({}) },
    title: { type: String, default: 'Contact' },
    labels: { type: Object, default: () => ({}) },
});
</script>

<template>
    <section class="cv-contact">
        <h2 class="cv-heading"><CvSectionIcon name="contact" /><span>{{ title }}</span></h2>
        <ul>
            <li v-if="profile.email">
                <span class="label">{{ labels.email || 'Email' }}</span>
                <a :href="`mailto:${profile.email}`">{{ profile.email }}</a>
            </li>
            <li v-if="profile.phone_primary">
                <span class="label">{{ labels.tel || 'Phone' }}</span>
                <span>{{ profile.phone_primary }}</span>
            </li>
            <li v-if="profile.phone_secondary">
                <span class="label">{{ labels.tel || 'Phone' }}</span>
                <span>{{ profile.phone_secondary }}</span>
            </li>
            <li v-if="profile.address">
                <span class="label">{{ labels.address || 'Address' }}</span>
                <span>{{ profile.address }}</span>
            </li>
        </ul>
    </section>
</template>

<style scoped>
ul { list-style: none; margin: 0; padding: 0; }
li { margin-bottom: 0.7rem; font-size: 0.86rem; line-height: 1.35; }
.label {
    display: block;
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    opacity: 0.75;
    margin-bottom: 0.1rem;
}
a { color: inherit; text-decoration: none; word-break: break-all; }
.cv-heading {
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
    background: var(--cv-accent, #7ec8e8);
    color: var(--cv-accent-ink, #12123a);
}
</style>
