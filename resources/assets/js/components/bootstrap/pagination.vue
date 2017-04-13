<template>
	<ul class="pagination pagination-theme">
		<li v-if="data.prev_page_url">
			<a @click.prevent="paginate(data.prev_page_url)" :href="data.prev_page_url">&laquo; Sebelumnya</a>
		</li>
		<li v-if="data.next_page_url">
			<a @click.prevent="paginate(data.next_page_url)" :href="data.next_page_url">Berikutnya &raquo;</a>
		</li>
	</ul>
</template>

<script>
	export default {
		props: ['data'],

		methods: {
			paginate(url) {
				this.$bus.$emit('pagination', url);
			}
		}
	}
</script>