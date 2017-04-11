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

const routes = [
	// user self management
	{
		path: '/dashboard',
		name: 'user.dashboard',
		component: view('user/dashboard')
	},
	{
		path: '/notification',
		name: 'user.notification',
		component: view('user/notification')
	},
	{
		path: '/password',
		name: 'user.password',
		component: view('user/change-password')
	},

	// glosarium
	{
		path: '/glosarium/category',
		name: 'glosarium.category',
		component: view('glosarium/category/table')
	},
	{
		path: '/glosarium/category/:slug/edit',
		name: 'glosarium.category.edit',
		component: view('glosarium/category/edit')
	},
	{
		path: '/glosarium/word',
		name: 'glosarium.word',
		component: view('glosarium/word/table')
	},
	{
		path: '/glosarium/word/moderation',
		name: 'glosarium.word.moderation',
		component: view('glosarium/word/moderation')
	},
	{
		path: '/glosarium/word/create',
		name: 'glosarium.word.create',
		component: view('glosarium/word/create')
	},
	{
		path: '/glosarium/word/:slug/edit',
		name: 'glosarium.word.edit',
		component: view('glosarium/word/edit')
	},

	// users
	{
		path: '/contributor',
		name: 'contributor',
		component: view('user/index')
	},

	// BOT
	{
		path: '/bot/keyword',
		name: 'bot.keyword',
		component: view('bot/keyword/table')
	}
];

const router = new VueRouter({ routes });

const app = new Vue({
	router,
	data: {
		bus: bus
	}
}).$mount('#app');