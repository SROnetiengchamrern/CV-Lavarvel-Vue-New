<script setup>
defineProps({
    name: { type: String, default: 'dot' },
});
</script>

<template>
    <svg class="cv-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <!-- contact -->
        <template v-if="name === 'contact'">
            <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3.1-8.7A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.3 1.8.6 2.6a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.5-1.1a2 2 0 0 1 2.1-.4c.8.3 1.7.5 2.6.6a2 2 0 0 1 1.7 2z" />
        </template>
        <!-- skills / technical -->
        <template v-else-if="name === 'skills' || name === 'technical'">
            <path d="M16.5 9.4 7.6 18.3" />
            <path d="m14.7 6.3 1.6 1.6a1 1 0 0 0 1.4 0l3.1-3.1a6 6 0 0 1-7.9 7.9l-6.9 6.9a2.1 2.1 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.9-7.9l-3.1 3.1z" />
        </template>
        <!-- languages -->
        <template v-else-if="name === 'languages'">
            <circle cx="12" cy="12" r="9" />
            <path d="M3 12h18" />
            <path d="M12 3a14 14 0 0 1 0 18" />
            <path d="M12 3a14 14 0 0 0 0 18" />
        </template>
        <!-- personal -->
        <template v-else-if="name === 'personal'">
            <circle cx="12" cy="8" r="4" />
            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
        </template>
        <!-- education -->
        <template v-else-if="name === 'education'">
            <path d="M22 10 12 5 2 10l10 5 10-5z" />
            <path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5" />
            <path d="M22 10v6" />
        </template>
        <!-- experience -->
        <template v-else-if="name === 'experience'">
            <rect x="3" y="7" width="18" height="13" rx="2" />
            <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
            <path d="M3 12h18" />
        </template>
        <!-- training -->
        <template v-else-if="name === 'training'">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
            <path d="M8 7h8M8 11h6" />
        </template>
        <!-- aws -->
        <template v-else-if="name === 'aws'">
            <path d="M18 10a4 4 0 0 0-8 0 5 5 0 0 0 1 9.9h10a4 4 0 0 0 0-8h-1z" />
            <path d="M8 10a4 4 0 0 1 3.5-4" />
        </template>
        <!-- interests -->
        <template v-else-if="name === 'interests'">
            <path d="M12 21s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.6-7 10-7 10z" />
        </template>
        <!-- references -->
        <template v-else-if="name === 'references'">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M23 21v-2a4 4 0 0 0-3-3.9" />
            <path d="M16 3.1a4 4 0 0 1 0 7.8" />
        </template>
        <template v-else>
            <circle cx="12" cy="12" r="4" />
        </template>
    </svg>
</template>

<style scoped>
.cv-icon {
    width: 1.25rem;
    height: 1.25rem;
    flex-shrink: 0;
    display: block;
    stroke: currentColor;
    fill: none;
    stroke-width: 2.2;
    stroke-linecap: round;
    stroke-linejoin: round;
}
</style>
