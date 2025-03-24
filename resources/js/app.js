import Alpine from 'alpinejs';
import {focus} from "@alpinejs/focus";

Alpine.plugin(focus);
window.Alpine = Alpine;


Alpine.store('notifications', {
    items: [],
    add(notification) {
        this.items.push(notification);
    },
    remove(index) {
        this.items.splice(index, 1);
    }
})