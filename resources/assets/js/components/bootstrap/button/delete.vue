<template>
	<a @click.prevent="setConfirm" v-if="!confirm" href="#" class="btn btn-xs btn-danger">
		<i class="fa fa-trash fa-fw"></i>
	</a>
	<a v-else :href="url" class="btn btn-xs btn-warning">
		<i class="fa fa-question fa-fw"></i>
	</a>
</template>

<script>
	export default {
		props: {
			url: String
		},

		data() {
			return {
				confirm: false
			}
		},

		methods: {
			setConfirm() {
				this.confirm = true;
			}
		}
	}
</script>