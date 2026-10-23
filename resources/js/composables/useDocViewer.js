import { inject, reactive } from 'vue';

const state = reactive({
    open: false,
    doc: null,
});

export function useDocViewer() {
    function openDoc(doc, labels = {}) {
        if (!doc?.url) {
            return;
        }
        state.doc = {
            url: doc.url,
            title: shortDocTitle(doc, 0, labels),
            is_pdf: !!doc.is_pdf,
            is_image: !!doc.is_image,
            original_name: doc.original_name || doc.title || 'Document',
            labels,
        };
        state.open = true;
        document.body.style.overflow = 'hidden';
    }

    function closeDoc() {
        state.open = false;
        state.doc = null;
        document.body.style.overflow = '';
    }

    return { state, openDoc, closeDoc };
}

export function shortDocTitle(doc, index = 0, labels = {}) {
    if (doc?.is_pdf) {
        const base = labels.view_pdf || 'View PDF';
        return index > 0 ? `${base} ${index + 1}` : base;
    }
    if (doc?.is_image) {
        const base = labels.view_photo || 'View Photo';
        return index > 0 ? `${base} ${index + 1}` : base;
    }
    const base = labels.view_file || 'View File';
    return index > 0 ? `${base} ${index + 1}` : base;
}

export function useCvUi() {
    return inject('cvUi', () => ({}));
}
