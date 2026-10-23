<script setup>
defineProps({
    languages: { type: Array, default: () => [] },
    title: { type: String, default: 'Languages' },
});
</script>

<template>
    <section class="cv-languages">
        <h2 class="cv-heading">{{ title }}</h2>
        <div v-for="lang in languages" :key="lang.id" class="lang-row">
            <div class="lang-name">{{ lang.name }}</div>
            <div class="lang-dots">
                <span
                    v-for="n in 10"
                    :key="n"
                    class="dot"
                    :class="{ filled: n <= lang.level }"
                />
            </div>
        </div>
    </section>
</template>

<style scoped>
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
.lang-row { margin-bottom: 0.7rem; }
.lang-name { font-size: 0.86rem; margin-bottom: 0.3rem; }
.lang-dots { display: flex; gap: 4px; flex-wrap: wrap; }
.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.25);
}
.dot.filled { background: var(--cv-accent, #7ec8e8); }
</style>
