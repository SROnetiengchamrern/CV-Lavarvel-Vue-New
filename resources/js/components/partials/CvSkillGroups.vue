<script setup>
defineProps({
    skillGroups: { type: Array, default: () => [] },
});
</script>

<template>
    <section
        v-for="group in skillGroups"
        :key="group.section"
        class="skill-group"
    >
        <h2 class="cv-heading">{{ group.section }}</h2>

        <template v-for="category in group.categories" :key="category.id">
            <h3 class="sub" :class="{ accent: category.accent }">{{ category.name }}</h3>

            <template v-if="category.show_bars">
                <div v-for="skill in category.skills" :key="skill.id" class="skill-row">
                    <div class="skill-name">{{ skill.name }}</div>
                    <div class="skill-bar">
                        <div class="skill-fill" :style="{ width: skill.level + '%' }" />
                    </div>
                </div>
            </template>
            <ul v-else class="bullet-list" :class="{ dense: !category.accent }">
                <li v-for="skill in category.skills" :key="skill.id">{{ skill.name }}</li>
            </ul>
        </template>
    </section>
</template>

<style scoped>
.skill-group { margin-bottom: 1.25rem; }
.cv-heading {
    display: inline-block;
    margin: 0 0 0.85rem;
    padding: 0.35rem 1rem;
    border-radius: 999px;
    font-family: Outfit, sans-serif;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    background: var(--cv-accent, #7ec8e8);
    color: var(--cv-accent-ink, #12123a);
}
.sub {
    margin: 0.75rem 0 0.45rem;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    color: var(--cv-muted, rgba(255,255,255,0.8));
}
.sub.accent {
    display: inline-block;
    background: var(--cv-accent, #7ec8e8);
    color: var(--cv-accent-ink, #12123a);
    padding: 0.25rem 0.65rem;
    border-radius: 999px;
}
.skill-row { margin-bottom: 0.5rem; }
.skill-name { font-size: 0.8rem; margin-bottom: 0.2rem; }
.skill-bar {
    height: 7px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.18);
    overflow: hidden;
}
.skill-fill {
    height: 100%;
    border-radius: inherit;
    background: linear-gradient(90deg, var(--cv-accent-soft, #a8d8ea), var(--cv-accent, #7ec8e8));
}
.bullet-list {
    list-style: none;
    margin: 0;
    padding: 0;
}
.bullet-list li {
    position: relative;
    padding-left: 0.9rem;
    margin-bottom: 0.35rem;
    font-size: 0.86rem;
}
.bullet-list li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0.45rem;
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: var(--cv-accent, #7ec8e8);
}
.bullet-list.dense { columns: 1; }
@media (max-width: 820px) {
    .bullet-list.dense { columns: 2; column-gap: 1rem; }
}
@media (max-width: 480px) {
    .bullet-list.dense { columns: 1; }
}
</style>
