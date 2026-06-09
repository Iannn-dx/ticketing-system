import './bootstrap';
import { createIcons, icons } from 'lucide';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const initLucideIcons = () => createIcons({ icons });

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLucideIcons);
} else {
    initLucideIcons();
}
