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

const routes = [
	// user self management
	{
		path: '/dashboard',
		name: 'user.dashboard',
		component: require('../components/App/User/dashboard.vue')
	},
	{
		path: '/notification',
		name: 'user.notification',
		component: require('../components/App/User/notification.vue')
	},
	{
		path: '/password',
		name: 'user.password',
		component: require('../components/App/User/change-password.vue')
	},

	// glosarium
	{
		path: '/glosarium/category',
		name: 'glosarium.category',
		component: require('../components/App/Glosarium/Category/table.vue')
	},

	// users
	{
		path: '/contributor',
		name: 'contributor',
		component: require('../components/App/User/index.vue')
	},

	// BOT
	{
		path: '/bot/keyword',
		name: 'bot.keyword',
		component: require('../components/App/Bot/Keyword/table.vue')
	}
];

const router = new VueRouter({ routes });

const app = new Vue({
	router
}).$mount('.body-content');

// bus event
app.bus = bus;