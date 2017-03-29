<template>
	<a :href="url" class="btn btn-xs btn-info">
		<i class="fa fa-edit fa-fw"></i>
	</a>
</template>

<script>
	export default {
		props: {
			url: String
		}
	}
</script>