<script setup>
import { computed, provide, ref, watchEffect } from 'vue';
import ClassicLayout from './layouts/ClassicLayout.vue';
import EmeraldLayout from './layouts/EmeraldLayout.vue';
import HorizonLayout from './layouts/HorizonLayout.vue';
import MinimalLayout from './layouts/MinimalLayout.vue';
import MirrorLayout from './layouts/MirrorLayout.vue';
import CvCertificateGallery from './partials/CvCertificateGallery.vue';
import CvDocViewer from './partials/CvDocViewer.vue';

const props = defineProps({
    cv: {
        type: Object,
        required: true,
    },
});

const layouts = {
    classic: ClassicLayout,
    emerald: EmeraldLayout,
    horizon: HorizonLayout,
    minimal: MinimalLayout,
    mirror: MirrorLayout,
};

const ui = computed(() => props.cv?.ui || {});
const locale = computed(() => props.cv?.locale || 'en');
const locales = computed(() => props.cv?.locales || { en: 'English', km: 'ខ្មែរ' });
const certificates = computed(() => props.cv?.certificates || []);
const cvDownloadUrl = computed(() => props.cv?.cv_download_url || null);
const galleryOpen = ref(false);

provide('cvUi', ui);

watchEffect(() => {
    document.documentElement.lang = locale.value;
    document.documentElement.classList.toggle('locale-km', locale.value === 'km');
});

const layoutKey = computed(() => {
    const fromProfile = props.cv?.profile?.layout;
    const fromQuery = new URLSearchParams(window.location.search).get('layout');
    const key = fromQuery || fromProfile || 'classic';
    return layouts[key] ? key : 'classic';
});

const activeLayout = computed(() => layouts[layoutKey.value]);

function printCv() {
    window.print();
}

function switchLocale(code) {
    const redirect = encodeURIComponent(window.location.href);
    window.location.href = `/lang/${code}?redirect=${redirect}`;
}
</script>

<template>
    <div class="page-wrap">
        <div class="toolbar no-print">
            <div class="lang-switch" :aria-label="ui.language || 'Language'">
                <button
                    v-for="(label, code) in locales"
                    :key="code"
                    type="button"
                    class="lang-chip"
                    :class="{ active: locale === code }"
                    @click="switchLocale(code)"
                >
                    {{ label }}
                </button>
            </div>
            <div class="toolbar-actions">
                <a
                    v-if="cvDownloadUrl"
                    :href="cvDownloadUrl"
                    class="toolbar-link"
                    download
                >{{ ui.download_cv || 'Download CV' }}</a>
                <button type="button" class="toolbar-btn" @click="galleryOpen = true">
                    {{ ui.certificates || 'Certificates' }}
                </button>
                <a href="/cover-letter" class="toolbar-link">{{ ui.cover_letter || 'Cover Letter' }}</a>
                <button type="button" class="toolbar-btn" @click="printCv">{{ ui.print_pdf || 'Print / PDF' }}</button>
            </div>
        </div>

        <component :is="activeLayout" :cv="cv" />
        <CvCertificateGallery
            :open="galleryOpen"
            :items="certificates"
            :ui="ui"
            @close="galleryOpen = false"
        />
        <CvDocViewer />
    </div>
</template>

<style scoped>
.page-wrap {
    padding: 2rem 1rem 3rem;
    overflow-x: hidden;
    min-width: 0;
}

.toolbar {
    max-width: 980px;
    margin: 0 auto 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.lang-chip {
    border: 1px solid #cfd5e2;
    background: #fff;
    color: #1a1a4b;
    border-radius: 999px;
    padding: 0.35rem 0.7rem;
    font: inherit;
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
}

.lang-chip.active {
    background: #1a1a4b;
    border-color: #1a1a4b;
    color: #fff;
}

.lang-switch {
    display: inline-flex;
    gap: 0.3rem;
}

.toolbar-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
    align-items: center;
}

.toolbar-link,
.toolbar-btn {
    font-family: inherit;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    padding: 0.55rem 1rem;
    border-radius: 999px;
    background: #1a1a4b;
    color: #fff;
}

.toolbar-link:hover,
.toolbar-btn:hover {
    background: #2a2a6b;
}

@media (max-width: 820px) {
    .page-wrap { padding: 0.85rem 0.55rem 1.75rem; }
    .toolbar { justify-content: stretch; }
    .toolbar-actions { width: 100%; }
    .toolbar-link,
    .toolbar-btn {
        flex: 1;
        text-align: center;
        min-height: 42px;
    }
}

@media print {
    .page-wrap { padding: 0; }
    .no-print { display: none !important; }
}
</style>
