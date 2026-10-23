<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';
import { useDocViewer } from '../../composables/useDocViewer';

const { state, closeDoc } = useDocViewer();

const isOpen = computed(() => state.open && state.doc);
const zoom = ref(1);

function onKey(e) {
    if (e.key === 'Escape') {
        closeDoc();
    }
}

function zoomIn() {
    zoom.value = Math.min(3, Math.round((zoom.value + 0.25) * 100) / 100);
}

function zoomOut() {
    zoom.value = Math.max(0.5, Math.round((zoom.value - 0.25) * 100) / 100);
}

function zoomReset() {
    zoom.value = 1;
}

watch(isOpen, (open) => {
    if (open) {
        zoom.value = 1;
    }
});

onMounted(() => window.addEventListener('keydown', onKey));
onUnmounted(() => {
    window.removeEventListener('keydown', onKey);
    document.body.style.overflow = '';
});
</script>

<template>
    <Teleport to="body">
        <div
            v-if="isOpen"
            class="viewer-overlay no-print"
            role="dialog"
            aria-modal="true"
            :aria-label="state.doc.title"
            @click.self="closeDoc"
        >
            <div class="viewer-panel">
                <header class="viewer-head">
                    <div>
                        <strong>{{ state.doc.title }}</strong>
                        <p>{{ state.doc.original_name }}</p>
                    </div>
                    <div class="viewer-actions">
                        <template v-if="state.doc.is_image">
                            <button type="button" class="viewer-btn" @click="zoomOut">−</button>
                            <button type="button" class="viewer-btn" @click="zoomReset">{{ Math.round(zoom * 100) }}%</button>
                            <button type="button" class="viewer-btn" @click="zoomIn">+</button>
                        </template>
                        <a class="viewer-btn" :href="state.doc.url" target="_blank" rel="noopener">{{ state.doc.labels?.open_tab || 'Open tab' }}</a>
                        <a class="viewer-btn" :href="state.doc.url" download>{{ state.doc.labels?.download || 'Download' }}</a>
                        <button type="button" class="viewer-btn close" @click="closeDoc">{{ state.doc.labels?.close || 'Close' }}</button>
                    </div>
                </header>

                <div class="viewer-body" :class="{ scrollable: state.doc.is_image }">
                    <img
                        v-if="state.doc.is_image"
                        :src="state.doc.url"
                        :alt="state.doc.original_name"
                        class="viewer-image"
                        :style="{ transform: `scale(${zoom})` }"
                    />
                    <iframe
                        v-else
                        :src="state.doc.url"
                        class="viewer-frame"
                        title="Document preview"
                    />
                </div>
            </div>
        </div>
    </Teleport>
</template>

<style scoped>
.viewer-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(15, 18, 40, 0.72);
    display: grid;
    place-items: center;
    padding: 1rem;
    backdrop-filter: blur(4px);
    animation: fade 0.18s ease;
}
@keyframes fade {
    from { opacity: 0; }
    to { opacity: 1; }
}
.viewer-panel {
    width: min(980px, 100%);
    height: min(88vh, 900px);
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
}
.viewer-head {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    align-items: flex-start;
    padding: 0.9rem 1rem;
    border-bottom: 1px solid #e8ebf2;
    background: #f8fafc;
    flex-shrink: 0;
}
.viewer-head strong {
    display: block;
    color: #1a1a4b;
    font-family: Outfit, sans-serif;
}
.viewer-head p {
    margin: 0.2rem 0 0;
    color: #5a5a72;
    font-size: 0.78rem;
    overflow-wrap: anywhere;
}
.viewer-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
}
.viewer-btn {
    border: 1px solid #d5d9e4;
    background: #fff;
    color: #1a1a4b;
    text-decoration: none;
    border-radius: 999px;
    padding: 0.4rem 0.8rem;
    font: inherit;
    font-size: 0.78rem;
    font-weight: 700;
    cursor: pointer;
}
.viewer-btn.close {
    background: #1a1a4b;
    border-color: #1a1a4b;
    color: #fff;
}
.viewer-body {
    flex: 1;
    min-height: 0;
    background: #111827;
}
.viewer-body.scrollable {
    overflow: auto;
    -webkit-overflow-scrolling: touch;
    padding: 1rem;
    text-align: center;
}
.viewer-image {
    display: inline-block;
    max-width: 100%;
    width: auto;
    height: auto;
    vertical-align: top;
    transform-origin: top center;
    transition: transform 0.15s ease;
}
.viewer-frame {
    width: 100%;
    height: 100%;
    border: 0;
    background: #fff;
}
@media (max-width: 700px) {
    .viewer-panel { height: 92vh; border-radius: 12px; }
    .viewer-head { flex-direction: column; }
}
</style>
