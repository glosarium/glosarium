<template>
	<div>
		<form :action="action">
			
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="name" class="form-control">
			</div>
			
		</form>
	</div>
</template>

<script>
	export default {
		props: {
			action: String
		},

		data() {
			return {
				state: {
					name: ''
				}
			}
		},

		mounted() {

		}
	}
</script>