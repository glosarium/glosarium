<template>
	<ul class="pagination pagination-theme">
		<li v-if="data.prev_page_url">
			<a @click.prevent="prev(data.prev_page_url)" :href="data.prev_page_url">&laquo;</a>
		</li>
		<li v-if="data.next_page_url">
			<a @click.prevent="next(data.next_page_url)" :href="data.next_page_url">&raquo;</a>
		</li>
	</ul>
</template>

<script>
	export default {
		data() {
			return {
				data: []
			}
		},

		mounted() {
			this.$bus.$on('pagination', data => {
				this.data = data;
			});
		},

		methods: {
			next(url) {
				this.$bus.$emit('pagination-next', url);
			},

			prev(url) {
				this.$bus.$emit('pagination-next', url);
			}
		}
	}
</script>