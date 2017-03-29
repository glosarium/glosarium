<template>
	<!-- form search -->
	 <form @submit.prevent="search" class="form-search-list" method="post" :action="action">
	    <div class="row">
	       <div class="col-sm-10 col-xs-12 ">
	          <div class="form-group">
	             <input class="form-control" v-model="state.keyword" name="keyword" :placeholder="placeholder" >
	          </div>
	       </div>
	       <div class="col-sm-2 col-xs-12 ">
	          <div class="form-group">
	             <button class="btn btn-block btn-theme  btn-default">
	             <i class="fa fa-search fa-fw"></i>
	             </button>
	          </div>
	       </div>
	    </div>
	 </form>
	 <!-- form search -->
</template>

<script>
	export default {
		props: {
			action: String,
			placeholder: String 
		},

		data() {
			return {
				state: {
					keyword: ''
				}
			}
		},

		methods: {
			search() {
				this.$bus.$emit('search', this.state.keyword);
			}
		}
	}
</script>