<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from 'vue';
import { useDocViewer } from '../../composables/useDocViewer';

const props = defineProps({
    open: { type: Boolean, default: false },
    items: { type: Array, default: () => [] },
    ui: { type: Object, default: () => ({}) },
});

const emit = defineEmits(['close']);
const { openDoc } = useDocViewer();

const filter = ref('all');

const filtered = computed(() => {
    if (filter.value === 'all') {
        return props.items;
    }
    return props.items.filter((item) => item.group === filter.value);
});

const hasAws = computed(() => props.items.some((i) => i.group === 'aws'));
const hasEdu = computed(() => props.items.some((i) => i.group === 'education'));

function close() {
    emit('close');
}

function onKey(e) {
    if (e.key === 'Escape' && props.open) {
        close();
    }
}

function viewItem(item) {
    openDoc(item, props.ui);
}

watch(
    () => props.open,
    (isOpen) => {
        document.body.style.overflow = isOpen ? 'hidden' : '';
        if (isOpen) {
            filter.value = 'all';
        }
    }
);

onMounted(() => window.addEventListener('keydown', onKey));
onUnmounted(() => {
    window.removeEventListener('keydown', onKey);
    if (props.open) {
        document.body.style.overflow = '';
    }
});
</script>

<template>
    <Teleport to="body">
        <div
            v-if="open"
            class="gallery-overlay no-print"
            role="dialog"
            aria-modal="true"
            :aria-label="ui.certificates || 'Certificates'"
            @click.self="close"
        >
            <div class="gallery-panel">
                <header class="gallery-head">
                    <div>
                        <h2>{{ ui.certificates || 'Certificates' }}</h2>
                        <p>{{ items.length }} {{ ui.certificates || 'Certificates' }}</p>
                    </div>
                    <button type="button" class="close-btn" @click="close">{{ ui.close || 'Close' }}</button>
                </header>

                <div v-if="hasAws || hasEdu" class="filters">
                    <button type="button" class="filter-chip" :class="{ active: filter === 'all' }" @click="filter = 'all'">
                        All
                    </button>
                    <button
                        v-if="hasAws"
                        type="button"
                        class="filter-chip"
                        :class="{ active: filter === 'aws' }"
                        @click="filter = 'aws'"
                    >
                        {{ ui.certificate_aws || 'AWS' }}
                    </button>
                    <button
                        v-if="hasEdu"
                        type="button"
                        class="filter-chip"
                        :class="{ active: filter === 'education' }"
                        @click="filter = 'education'"
                    >
                        {{ ui.certificate_education || 'Degrees' }}
                    </button>
                </div>

                <div v-if="filtered.length" class="gallery-grid">
                    <button
                        v-for="item in filtered"
                        :key="item.id"
                        type="button"
                        class="card"
                        @click="viewItem(item)"
                    >
                        <div class="thumb">
                            <img v-if="item.is_image" :src="item.url" :alt="item.title" loading="lazy" />
                            <div v-else class="pdf-thumb">
                                <span>PDF</span>
                            </div>
                        </div>
                        <div class="meta">
                            <strong>{{ item.title }}</strong>
                            <span v-if="item.subtitle">{{ item.subtitle }}</span>
                        </div>
                    </button>
                </div>
                <p v-else class="empty">{{ ui.no_certificates || 'No certificates uploaded yet.' }}</p>
            </div>
        </div>
    </Teleport>
</template>

<style scoped>
.gallery-overlay {
    position: fixed;
    inset: 0;
    z-index: 9000;
    background: rgba(15, 18, 40, 0.72);
    display: grid;
    place-items: center;
    padding: 1rem;
    backdrop-filter: blur(4px);
}
.gallery-panel {
    width: min(960px, 100%);
    max-height: min(88vh, 900px);
    overflow: auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 28px 60px -20px rgba(0, 0, 0, 0.45);
    padding: 1.1rem 1.2rem 1.4rem;
}
.gallery-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 0.85rem;
}
.gallery-head h2 {
    margin: 0;
    font-family: Outfit, 'Kantumruy Pro', sans-serif;
    font-size: 1.25rem;
    color: #1a1a4b;
}
.gallery-head p {
    margin: 0.25rem 0 0;
    font-size: 0.8rem;
    color: #5a5a72;
}
.close-btn {
    font: inherit;
    font-size: 0.82rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    padding: 0.5rem 0.95rem;
    border-radius: 999px;
    background: #1a1a4b;
    color: #fff;
}
.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    margin-bottom: 1rem;
}
.filter-chip {
    font: inherit;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid #cfd5e2;
    background: #fff;
    color: #1a1a4b;
    border-radius: 999px;
    padding: 0.35rem 0.75rem;
    cursor: pointer;
}
.filter-chip.active {
    background: #1a1a4b;
    border-color: #1a1a4b;
    color: #fff;
}
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 0.85rem;
}
.card {
    display: flex;
    flex-direction: column;
    text-align: left;
    border: 1px solid #e2e6ef;
    border-radius: 12px;
    overflow: hidden;
    background: #f8f9fc;
    padding: 0;
    cursor: pointer;
    font: inherit;
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -12px rgba(26, 26, 75, 0.35);
}
.thumb {
    aspect-ratio: 4 / 3;
    background: #e8ecf4;
    overflow: hidden;
}
.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.pdf-thumb {
    width: 100%;
    height: 100%;
    display: grid;
    place-items: center;
    background: linear-gradient(145deg, #1a1a4b, #2a3a6b);
    color: #fff;
    font-weight: 800;
    letter-spacing: 0.08em;
}
.meta {
    padding: 0.55rem 0.65rem 0.7rem;
    display: flex;
    flex-direction: column;
    gap: 0.15rem;
    min-width: 0;
}
.meta strong {
    font-size: 0.8rem;
    color: #1a1a4b;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.meta span {
    font-size: 0.72rem;
    color: #5a5a72;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.empty {
    margin: 1.5rem 0;
    text-align: center;
    color: #5a5a72;
}
</style>
