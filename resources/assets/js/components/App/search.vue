<template>
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <!-- form search -->
	            <form @submit.prevent="search" :id="id" :action="url" :class="className" method="post">
	                <div class="row">
	                    <div class="col-sm-10 col-xs-12">
	                        <div class="form-group">
	                            <label class="color-white">Cari kata</label>
	                            <input v-model="forms.keyword" id="keyword" value="" v-bind:disabled="inputs.keyword.disabled" v-bind:class="['form-control', inputs.keyword.class]" placeholder="Temukan dalam {{ number_format($totalWord, 0, ',', '.') }} pangkalan data..." autocomplete="off">
	                        </div>
	                    </div>
	                    <div class="col-sm-2 col-xs-12 ">
	                        <div class="form-group">
	                            <label class="hidden-xs">&nbsp;</label>
	                            <button>@{{ button }}</button>
	                        </div>
	                    </div>
	                </div>
	                <p class="text-right"><a href="#modal-advanced" data-toggle="modal" class="link-white">Pencarian lanjut</a></p>
	            </form>
	            <!-- form search -->
	        </div>
	    </div>
	</div>
	<!-- end form search area-->
</template>

<script>
	export default {
		data() {
			return {
				keyword: null
			}
		},

		methods: {

			search: {
				this.$emit('search');
			}
		}
	}
</script>