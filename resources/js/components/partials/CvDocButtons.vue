<script setup>
import { computed, inject, unref } from 'vue';
import { useDocViewer, shortDocTitle } from '../../composables/useDocViewer';

defineProps({
    documents: { type: Array, default: () => [] },
});

const { openDoc } = useDocViewer();
const uiRef = inject('cvUi', null);
const ui = computed(() => (uiRef ? unref(uiRef) : {}) || {});
</script>

<template>
    <div v-if="documents?.length" class="doc-actions no-print">
        <button
            v-for="(doc, index) in documents"
            :key="doc.id || index"
            type="button"
            class="doc-btn"
            :title="doc.original_name || doc.title || 'Document'"
            @click="openDoc(doc, ui)"
        >
            <span class="doc-tag">{{ doc.is_pdf ? 'PDF' : (doc.is_image ? 'IMG' : 'FILE') }}</span>
            <span class="doc-label">{{ shortDocTitle(doc, index, ui) }}</span>
        </button>
    </div>
</template>

<style scoped>
.doc-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    margin-top: 0.45rem;
}
.doc-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    border: 1px solid color-mix(in srgb, var(--cv-primary, #1a1a4b) 18%, transparent);
    background: #fff;
    color: var(--cv-primary, #1a1a4b);
    border-radius: 999px;
    padding: 0.3rem 0.7rem;
    font: inherit;
    font-size: 0.75rem;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.15s ease, transform 0.15s ease;
}
.doc-btn:hover {
    background: color-mix(in srgb, var(--cv-accent, #7ec8e8) 28%, #fff);
    transform: translateY(-1px);
}
.doc-tag {
    font-size: 0.62rem;
    letter-spacing: 0.04em;
    padding: 0.12rem 0.32rem;
    border-radius: 4px;
    background: var(--cv-primary, #1a1a4b);
    color: #fff;
}
.doc-label {
    white-space: nowrap;
}
</style>
