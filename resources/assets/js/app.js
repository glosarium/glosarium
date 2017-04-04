
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./libraries');
require('./routes');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */


// Bootstarap components
Vue.component('alert', require('./components/Bootstrap/alert.vue'));
Vue.component('loader', require('./components/Bootstrap/loader.vue'));
Vue.component('pagination', require('./components/Bootstrap/pagination.vue'));
Vue.component('button-edit', require('./components/Bootstrap/Button/edit.vue'));
Vue.component('button-delete', require('./components/Bootstrap/Button/delete.vue'));

// App components
Vue.component('search', require('./components/App/search.vue'));
Vue.component('admin-search', require('./components/App/admin-search.vue'));
Vue.component('user-index', require('./components/App/User/index.vue'));
Vue.component('user-create', require('./components/App/User/create.vue'));
Vue.component('user-notification', require('./components/App/User/notification.vue'));
Vue.component('contact-form', require('./components/App/Contact/form.vue'));

// Glosarium
Vue.component('glosarium-category-index', require('./components/App/Glosarium/Category/index.vue'));
Vue.component('glosarium-word-latest', require('./components/App/Glosarium/Word/latest.vue'));

/**
 * jQuery handler
 */
$(() => {
	$('a.logout').click(() => {
		$('#logout-form').submit();
		return false;
	});
});