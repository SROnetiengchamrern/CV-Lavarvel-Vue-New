<script setup>
import { computed, inject, ref, unref } from 'vue';
import { profileInitials, resolvePhotoFromProfile } from '../../composables/useCv';
import { useDocViewer } from '../../composables/useDocViewer';

const props = defineProps({
    profile: { type: Object, default: () => ({}) },
    size: { type: String, default: 'md' },
});

const photo = computed(() => resolvePhotoFromProfile(props.profile));
const initials = computed(() => profileInitials(props.profile));
const broken = ref(false);
const { openDoc } = useDocViewer();
const uiRef = inject('cvUi', null);
const ui = computed(() => (uiRef ? unref(uiRef) : {}) || {});

function openPhoto() {
    if (!photo.value || broken.value) {
        return;
    }

    openDoc({
        url: photo.value,
        title: props.profile?.full_name || 'Photo',
        original_name: props.profile?.full_name || 'cv-photo',
        is_image: true,
        is_pdf: false,
    }, ui.value);
}
</script>

<template>
    <button
        v-if="photo && !broken"
        type="button"
        class="cv-photo clickable no-print-border"
        :class="`size-${size}`"
        :title="ui.view_photo || 'View Photo'"
        @click="openPhoto"
    >
        <img
            :src="photo"
            :alt="profile.full_name"
            @error="broken = true"
        />
    </button>
    <div v-else class="cv-photo" :class="`size-${size}`">
        <div class="fallback">{{ initials }}</div>
    </div>
</template>

<style scoped>
.cv-photo {
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 3px solid rgba(255, 255, 255, 0.85);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    padding: 0;
    background: transparent;
    display: block;
}
.cv-photo.clickable {
    cursor: zoom-in;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.cv-photo.clickable:hover {
    transform: scale(1.04);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.28);
}
.cv-photo.clickable:focus-visible {
    outline: 2px solid var(--cv-accent, #7ec8e8);
    outline-offset: 3px;
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
    pointer-events: none;
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
@media print {
    .cv-photo.clickable {
        cursor: default;
        transform: none !important;
    }
}
</style>
