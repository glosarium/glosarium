// components for glosarium
Vue.component('glosarium-word-latest', require('../components/app/glosarium/word/latest.vue'));
Vue.component('glosarium-category-all', require('../components/app/glosarium/category/all.vue'));

/*
 * By extending the Vue prototype with a new '$bus' property
 * we can easily access our global event bus from any child component.
 *
 * @link https://laracasts.com/discuss/channels/vue/use-a-global-event-bus
 */
Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return this.$root.bus;
    }
});

window.bus = new Vue({});

import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * @param  {string}   name     the filename (basename) of the view to load.
 */
function view(name) {
    return function(resolve) {
        require(['../components/app/' + name + '.vue'], resolve);
    }
};

const routes = [{
        path: '/',
        name: 'index',
        component: view('glosarium/word/index')
    },
    {
        path: '/category/:slug',
        name: 'glosarium.category.show',
        component: view('glosarium/category/show')
    },
    {
        path: '/:category/:word',
        name: 'glosarium.word.show',
        component: view('glosarium/word/show')
    },
    {
        path: '/category',
        name: 'glosarium.category',
        component: view('glosarium/category/index')
    },
    {
        path: '/contact',
        name: 'contact',
        component: view('contact/form')
    }
];

const router = new VueRouter({ routes });

const app = new Vue({
    router,
    data: {
        bus: bus,
        app: {
            search: false
        }
    }
}).$mount('#app');