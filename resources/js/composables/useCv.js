import { computed } from 'vue';

export function useCv(cvRef) {
    const profile = computed(() => cvRef.value?.profile || cvRef.value?.profile || {});

    const resolvedPhoto = computed(() => {
        const photo = (typeof cvRef.value === 'object' && cvRef.value?.profile?.photo)
            || null;

        if (!photo) {
            return null;
        }
        if (photo.startsWith('images/')) {
            return `/${photo}`;
        }
        if (photo.startsWith('profiles/')) {
            return `/storage/${photo}`;
        }
        if (photo.startsWith('http') || photo.startsWith('/')) {
            return photo;
        }
        return `/${photo}`;
    });

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
    if (!profile?.photo) {
        return null;
    }
    const photo = profile.photo;
    if (photo.startsWith('images/')) {
        return `/${photo}`;
    }
    if (photo.startsWith('profiles/')) {
        return `/storage/${photo}`;
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
