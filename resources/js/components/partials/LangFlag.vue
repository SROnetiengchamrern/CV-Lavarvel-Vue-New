<script setup>
import { computed } from 'vue';

const props = defineProps({
    code: { type: String, required: true },
});

const src = computed(() => {
    if (props.code === 'en') {
        return '/images/flags/en.png';
    }
    if (props.code === 'km') {
        return '/images/flags/km.png';
    }
    return null;
});

const alt = computed(() => {
    if (props.code === 'en') {
        return 'English';
    }
    if (props.code === 'km') {
        return 'ខ្មែរ';
    }
    return props.code;
});
</script>

<template>
    <img
        v-if="src"
        class="flag"
        :src="src"
        :alt="alt"
        width="22"
        height="15"
        loading="lazy"
        decoding="async"
    />
    <span v-else class="flag-fallback">{{ code.toUpperCase() }}</span>
</template>

<style scoped>
.flag {
    width: 1.4rem;
    height: 0.95rem;
    border-radius: 2px;
    display: block;
    flex-shrink: 0;
    object-fit: cover;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.15);
}
.flag-fallback {
    font-size: 0.65rem;
    font-weight: 800;
}
</style>
