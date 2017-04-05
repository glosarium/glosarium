<template>
   <form @submit.prevent="update" :action="action" method="post">

      <div :class="['form-group', errors.currentPassword ? 'has-error' : '']">
         <label class="control-label">Sandi Lewat Lama</label>
         <input :disabled="loading" v-model="state.currentPassword" type="password" class="form-control">
         <span v-if="errors.currentPassword" class="label label-danger">{{ errors.currentPassword[0] }}</span>
      </div>

      <div :class="['form-group', errors.password ? 'has-error' : '']">
         <label class="control-label">Sandi Lewat</label>
         <input :disabled="loading" v-model="state.password" type="password" class="form-control">
         <span v-if="errors.password" class="label label-danger">{{ errors.password[0] }}</span>
      </div>

      <div :class="['form-group', errors.confirmPassword ? 'has-error' : '']">
         <label class="control-label">Konfirmasi Sandi Lewat</label>
         <input :disabled="loading" v-model="state.confirmPassword" type="password" class="form-control">
         <span v-if="errors.confirmPassword" class="label label-danger">{{ errors.confirmPassword[0] }}</span>
      </div>

      <button :disabled="loading" type="submit" class="btn btn-theme btn-t-primary">
         Ubah Sandi Lewat
         <loader :show="loading"></loader>
      </button>

   </form>
</template>

<script>
   export default {
      props: {
         action: String
      },

      data() {
         return {
            loading: false,
            errors: [],
            state: {
               currentPassword: '',
               password: '',
               confirmPassword: ''
            }
         }
      },

      methods: {
         update(e) {
            this.errors = [];
            this.loading = true;

            axios.put(e.target.action, this.state).then(response => {
               if (response.data.status) {
                  this.state = {
                     currentPassword: '',
                     password: '',
                     confirmPassword: ''
                  }
               }

               this.loading = false;
            }).catch(error => {
               if (! _.isEmpty(error)) {
                  if (error.response.status == 422) {
                     this.errors = error.response.data;
                  }
               }

               this.loading = false;
            });
         }
      }
   }
</script>