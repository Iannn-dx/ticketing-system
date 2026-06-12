import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import { createIcons, icons } from 'lucide';

window.Alpine = Alpine;
window.Swal = Swal;

Alpine.start();

const initLucideIcons = () => createIcons({ icons });

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLucideIcons);
} else {
    initLucideIcons();
}