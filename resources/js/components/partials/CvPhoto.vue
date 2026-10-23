<script setup>
import { computed } from 'vue';
import { profileInitials, resolvePhotoFromProfile } from '../../composables/useCv';

const props = defineProps({
    profile: { type: Object, default: () => ({}) },
    size: { type: String, default: 'md' },
});

const photo = computed(() => resolvePhotoFromProfile(props.profile));
const initials = computed(() => profileInitials(props.profile));
</script>

<template>
    <div class="cv-photo" :class="`size-${size}`">
        <img
            v-if="photo"
            :src="photo"
            :alt="profile.full_name"
            @error="($event.target.style.display = 'none')"
        />
        <div v-else class="fallback">{{ initials }}</div>
    </div>
</template>

<style scoped>
.cv-photo {
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 3px solid rgba(255, 255, 255, 0.85);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
}
.cv-photo.size-sm { width: 88px; height: 88px; }
.cv-photo.size-md { width: 140px; height: 140px; }
.cv-photo.size-lg { width: 160px; height: 160px; }
.cv-photo img,
.cv-photo .fallback {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.cv-photo .fallback {
    display: grid;
    place-items: center;
    background: var(--cv-accent, #7ec8e8);
    color: var(--cv-ink, #12123a);
    font-family: Outfit, sans-serif;
    font-weight: 700;
    font-size: 2rem;
}
</style>
