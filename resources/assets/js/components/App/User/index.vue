<template>
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Created</th>
					<th>#</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(user, index) in users.data">
					<td>{{ users.from + index }}</td>
					<td>{{ user.name }}</td>
					<td>{{ user.email }}</td>
					<td>{{ user.created_diff }}</td>
					<td>
						<button-edit url="#"></button-edit>
						<button-delete url="#"></button-delete>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				loading: false,
				users: []
			}
		},

		mounted() {
			axios.get(routes.adminUserPaginate).then(response => {
				this.users = response.data;

				this.$bus.$emit('pagination', this.users);
			});

			this.$bus.$on('search', keyword => {
				const params = {
					keyword: keyword
				}

				this.getUser(routes.adminUserPaginate, params);
			});

			this.$bus.$on('pagination-next', url => {
				this.getUser(url);
			});

			this.$bus.$on('pagination-prev', url => {
				this.getUser(url);
			});
		},

		methods: {

			getUser(url, params = {}) {
				axios.get(url, {params}).then(response => {
					this.users = response.data;

					this.$bus.$on('pagination', this.users);
				});
			}
		}
	}
</script>