class Modal {
    constructor() {
        this.init();
    }

    init() {
        // Handle all modal triggers
        document.addEventListener('click', (e) => {
            const trigger = e.target.closest('[data-modal-trigger]');
            if (trigger) {
                const modalId = trigger.dataset.modalTrigger;
                this.open(modalId);
            }
        });

        // Handle all close buttons
        document.addEventListener('click', (e) => {
            const closeBtn = e.target.closest('[data-modal-close]');
            if (closeBtn) {
                const modal = closeBtn.closest('[data-modal]');
                if (modal) this.close(modal.id);
            }
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            const modal = e.target.closest('[data-modal]');
            if (e.target.hasAttribute('data-modal')) {
                this.close(e.target.id);
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('[data-modal]:not(.hidden)');
                if (openModal) this.close(openModal.id);
            }
        });
    }

    open(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    close(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }
}

// Initialize modal system
window.modalSystem = new Modal();