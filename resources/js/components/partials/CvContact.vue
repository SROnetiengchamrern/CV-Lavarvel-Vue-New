<script setup>
import CvSectionIcon from './CvSectionIcon.vue';

defineProps({
    profile: { type: Object, default: () => ({}) },
    title: { type: String, default: 'Contact' },
    labels: { type: Object, default: () => ({}) },
});

const emailIcon = '/images/icons/email.png';
const phoneIcon = '/images/icons/phone.png';
const telegramIcon = '/images/icons/telegram.png';
const facebookIcon = '/images/icons/facebook.png';
const addressIcon = '/images/icons/address.png';

function displayTelegram(value) {
    if (!value) return '';
    if (value.startsWith('http://') || value.startsWith('https://')) {
        try {
            const path = new URL(value).pathname.replace(/^\/+/, '');
            return path ? `@${path.replace(/^@/, '')}` : value;
        } catch {
            return value;
        }
    }
    return value.startsWith('@') ? value : `@${value}`;
}

function displayFacebook(value) {
    if (!value) return '';
    if (value.startsWith('http://') || value.startsWith('https://')) {
        try {
            return new URL(value).pathname.replace(/^\/+|\/$/g, '') || value;
        } catch {
            return value;
        }
    }
    return value.replace(/^@/, '');
}
</script>

<template>
    <section class="cv-contact">
        <h2 class="cv-heading"><CvSectionIcon name="contact" /><span>{{ title }}</span></h2>
        <ul>
            <li v-if="profile.email">
                <span class="label">
                    <img class="social-icon" :src="emailIcon" alt="" width="14" height="14" />
                    {{ labels.email || 'Email' }}
                </span>
                <a :href="`mailto:${profile.email}`">{{ profile.email }}</a>
            </li>
            <li v-if="profile.phone_primary">
                <span class="label">
                    <img class="social-icon" :src="phoneIcon" alt="" width="14" height="14" />
                    {{ labels.tel || 'Phone' }}
                </span>
                <span>{{ profile.phone_primary }}</span>
            </li>
            <li v-if="profile.phone_secondary">
                <span class="label">
                    <img class="social-icon" :src="phoneIcon" alt="" width="14" height="14" />
                    {{ labels.tel || 'Phone' }}
                </span>
                <span>{{ profile.phone_secondary }}</span>
            </li>
            <li v-if="profile.telegram">
                <span class="label">
                    <img class="social-icon" :src="telegramIcon" alt="" width="14" height="14" />
                    {{ labels.telegram || 'Telegram' }}
                </span>
                <a :href="profile.telegram_url" target="_blank" rel="noopener">{{ displayTelegram(profile.telegram) }}</a>
            </li>
            <li v-if="profile.facebook">
                <span class="label">
                    <img class="social-icon" :src="facebookIcon" alt="" width="14" height="14" />
                    {{ labels.facebook || 'Facebook' }}
                </span>
                <a :href="profile.facebook_url" target="_blank" rel="noopener">{{ displayFacebook(profile.facebook) }}</a>
            </li>
            <li v-if="profile.address">
                <span class="label">
                    <img class="social-icon" :src="addressIcon" alt="" width="14" height="14" />
                    {{ labels.address || 'Address' }}
                </span>
                <span>{{ profile.address }}</span>
            </li>
        </ul>
    </section>
</template>

<style scoped>
ul { list-style: none; margin: 0; padding: 0; }
li { margin-bottom: 0.7rem; font-size: 0.86rem; line-height: 1.35; }
.label {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.68rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    opacity: 0.75;
    margin-bottom: 0.1rem;
}
.social-icon {
    width: 0.95rem;
    height: 0.95rem;
    object-fit: contain;
    flex-shrink: 0;
}
a { color: inherit; text-decoration: none; word-break: break-all; }
a:hover { text-decoration: underline; }
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
