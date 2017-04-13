
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

// App components
Vue.component('app-search', require('./components/app/common/search.vue'));
Vue.component('app-title', require('./components/app/common/title.vue'));

/**
 * jQuery handler
 */
$(() => {
	$('a.logout').click(() => {
		$('#logout-form').submit();
		return false;
	});
});