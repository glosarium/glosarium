<template>
   <!-- form search -->
   <form @submit.prevent="search" class="form-search-list">
      <div class="row">
         <div class="col-md-12">
            <div id="custom-search-input">
               <div class="input-group col-md-12">
                  <input :disabled="loading" v-model="state.keyword" type="text" class="form-control" :placeholder="placeholder" />
                  <span class="input-group-btn">
                     <button :disabled="loading" class="btn btn-info btn-lg" type="button">
                        <i class="glyphicon glyphicon-search"></i>
                     </button>
                  </span>
               </div>
            </div>
         </div>
      </div>
   </form>
   <!-- form search -->
</template>

<script>
   export default {
      name: 'AppSearch',
      props: {
         loading: false,
         placeholder: String
      },

      data() {
         return {
            state: {
               keyword: null
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

<style type="text/css" scoped>
   #custom-search-input{
      padding: 3px;
      border: solid 1px #E4E4E4;
      border-radius: 3px;
      background-color: #fff;
      margin-bottom: 20px;
   }

   #custom-search-input input{
      border: 0;
      box-shadow: none;
   }

   #custom-search-input button{
      margin: 2px 0 0 0;
      background: none;
      box-shadow: none;
      border: 0;
      color: #666666;
      padding: 0 8px 0 10px;
      border-left: solid 1px #ccc;
   }

   #custom-search-input button:hover{
      border: 0;
      box-shadow: none;
      border-left: solid 1px #ccc;
   }

   #custom-search-input .glyphicon-search{
      font-size: 23px;
   }
</style>