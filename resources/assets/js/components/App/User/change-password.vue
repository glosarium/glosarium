<template>
   <div class="panel panel-default">
      <div class="panel-heading">Ubah Sandi Lewat</div>
      <div class="panel-body">
         <form @submit.prevent="update" action="/password/update" method="post">

            <div v-if="alerts.message" class="['alert', alert.type]">
               {{ alert.message }}
            </div>

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
      </div>
   </div>
</template>

<script>
   export default {
      data() {
         return {
            loading: false,
            errors: [],
            alerts: {
               type: 'info',
               message: ''
            },
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
               else {
                  this.alerts = {
                     type: 'danger',
                     'message': 'Kesalahan internal server.'
                  }
               }

               this.loading = false;
            });
         }
      }
   }
</script>