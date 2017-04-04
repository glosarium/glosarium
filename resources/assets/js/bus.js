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

window.app = new Vue({
	el: '#app',
	data: {
		bus: bus // Here we bind our event bus to our $root Vue model.
	}
});