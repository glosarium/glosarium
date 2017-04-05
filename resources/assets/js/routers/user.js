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
	router
}).$mount('.body-content');

// bus event
app.bus = bus;