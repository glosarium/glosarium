<template>
	<i v-if="show" class="fa fa-spin fa-circle-o-notch"></i>
</template>

<script>
	export default {
		props: {
			show: false
		}
	}
</script>