<template>
	<div v-if="show" :class="['alert', 'alert-' + type]">
		<strong v-if="title">{{ title }}</strong>
		<slot></slot>
	</div>
</template>

<script>
	export default {
		props: ['show', 'type', 'title'],

		data() {
			return {

			};
		},

		mounted() {
			
		}
	}
</script>