import Alpine from 'alpinejs';
import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Alpine = Alpine
window.slugify = require('slugify');


Alpine.store('notifications', {
    items: [],
    add(notification) {
        this.items.push(notification);
    },
    remove(index) {
        this.items.splice(index, 1);
    }
})
