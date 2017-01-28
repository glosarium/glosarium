<template>
	<i v-if="show" class="fa fa-spin fa-spinner"></i>
</template>

<script>
	export default {
		props: ['show']
	}
</script>