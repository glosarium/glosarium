
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
Vue.component('alert', require('./components/bootstrap/alert.vue'));
Vue.component('loader', require('./components/bootstrap/loader.vue'));
Vue.component('pagination', require('./components/bootstrap/pagination.vue'));
Vue.component('button-edit', require('./components/bootstrap/button/edit.vue'));
Vue.component('button-delete', require('./components/bootstrap/button/delete.vue'));

// app components
Vue.component('search', require('./components/app/search.vue'));
Vue.component('admin-search', require('./components/app/admin-search.vue'));
Vue.component('contact-form', require('./components/app/contact/form.vue'));

// Glosarium
Vue.component('glosarium-category-index', require('./components/app/glosarium/category/index.vue'));
Vue.component('glosarium-word-latest', require('./components/app/glosarium/word/latest.vue'));

/**
 * jQuery handler
 */
$(() => {
	$('a.logout').click(() => {
		$('#logout-form').submit();
		return false;
	});
});