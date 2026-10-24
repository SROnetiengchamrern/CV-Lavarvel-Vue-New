import { computed } from 'vue';

export function useCv(cvRef) {
    const profile = computed(() => cvRef.value?.profile || cvRef.value?.profile || {});

    const resolvedPhoto = computed(() => resolvePhotoFromProfile(cvRef.value?.profile));

    const initials = computed(() => {
        const name = cvRef.value?.profile?.full_name || 'TC';
        return name
            .split(' ')
            .map((w) => w[0])
            .join('')
            .slice(0, 2)
            .toUpperCase();
    });

    return { profile, resolvedPhoto, initials };
}

export function resolvePhotoFromProfile(profile) {
    if (!profile) {
        return null;
    }

    // Prefer server-built URL when available
    if (profile.photo_url) {
        return profile.photo_url;
    }

    const photo = profile.photo;
    if (!photo) {
        // Static fallback shipped in public/images
        return '/images/profile.jpg';
    }
    if (photo.startsWith('images/')) {
        return `/${photo}`;
    }
    // Uploaded files are served by MediaController at /media/{path}
    if (
        photo.startsWith('profiles/')
        || photo.startsWith('certificates/')
        || photo.startsWith('cv-files/')
    ) {
        return `/media/${photo}`;
    }
    if (photo.startsWith('http') || photo.startsWith('/')) {
        return photo;
    }
    return `/${photo}`;
}

export function profileInitials(profile) {
    const name = profile?.full_name || 'TC';
    return name
        .split(' ')
        .map((w) => w[0])
        .join('')
        .slice(0, 2)
        .toUpperCase();
}
