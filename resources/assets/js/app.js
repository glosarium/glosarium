/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// https://github.com/hilongjw/vue-progressbar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
  color: '#ecf0f1',
  failedColor: '#d9534f',
  thickness: '4px'
});

// highlight js
window.hljs = require('highlight.js');

// vue head
import VueHead from 'vue-head';
Vue.use(VueHead, {
  separator: '-'
});

/**
 * Asynchronously load view (Webpack Lazy loading compatible)
 * @param  {string}   name     the filename (basename) of the view to load.
 */
function view(name, path = 'app') {
  return function(resolve) {
    require([`./components/${path}/${name}.vue`], resolve);
  }
};

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

// Bootstarap components
Vue.component('alert', require('./components/bootstrap/alert.vue'));
Vue.component('loader', require('./components/bootstrap/loader.vue'));
Vue.component('pagination', require('./components/bootstrap/pagination.vue'));
Vue.component('button-edit', require('./components/bootstrap/button/edit.vue'));
Vue.component('button-delete', require('./components/bootstrap/button/delete.vue'));

// Common components
Vue.component('app-search', require('./components/app/common/search.vue'));
Vue.component('app-title', require('./components/app/common/title.vue'));

// Glosarium
Vue.component('glosarium-word-latest', require('./components/app/glosarium/word/latest.vue'));
Vue.component('glosarium-category-all', require('./components/app/glosarium/category/all.vue'));

window.bus = new Vue({});

import VueRouter from 'vue-router';
Vue.use(VueRouter);

const routes = [
  { path: '/', name: 'index', component: view('glosarium/word/index') },
  { path: '/category/:slug', name: 'glosarium.category.show', component: view('glosarium/category/show') },
  { path: '/:category/:word', name: 'glosarium.word.show', component: view('glosarium/word/show') },
  { path: '/category', name: 'glosarium.category.index', component: view('glosarium/category/index') },
  { path: '/contact', name: 'contact', component: view('contact/form') },
  { path: '*', component: view('error/404') },

  // user self management
  { path: '/dashboard', name: 'user.dashboard', component: view('user/dashboard') },
  { path: '/notification', name: 'user.notification', component: view('user/notification') },
  { path: '/password', name: 'user.password', component: view('user/change-password') },

  // glosarium for admin
  { path: '/glosarium/category', name: 'glosarium.category', component: view('glosarium/category/table') },
  { path: '/glosarium/category/:slug/edit', name: 'glosarium.category.edit', component: view('glosarium/category/edit') },
  { path: '/glosarium/word', name: 'glosarium.word', component: view('glosarium/word/table') },
  { path: '/glosarium/word/moderation', name: 'glosarium.word.moderation', component: view('glosarium/word/moderation') },
  { path: '/glosarium/word/create', name: 'glosarium.word.create', component: view('glosarium/word/create') },
  { path: '/glosarium/word/:slug/edit', name: 'glosarium.word.edit', component: view('glosarium/word/edit')
  },

  // users
  { path: '/contributor', name: 'contributor', component: view('user/index') },

  // BOT
  {  path: '/bot/keyword', name: 'bot.keyword', component: view('bot/keyword/table') }
];

const router = new VueRouter({ routes });

/*e

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

const app = new Vue({
  router,
  data: {
    bus: bus,
    app: {
      search: false,
      auth: Laravel.auth
    }
  }
}).$mount('#app');

/**
 * jQuery handler
 */
$(() => {
	$('a.logout').click(() => {
		$('#logout-form').submit();
		return false;
	});
});