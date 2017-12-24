<template>
<form @submit.prevent="subscribe" class="form-subscribe" method="post" action="/nawala/langganan">
    <div class="input-group">
        <input :disabled="loading" v-model="email" type="text" name="email" class="form-control input-lg" placeholder="Alamat pos-el kamu">
        <span class="input-group-btn">
        <button :disabled="loading" class="btn btn-success btn-lg" type="submit">
            <i v-if="loading" class="fa fa-spin fa-spinner"></i>
            Berlangganan
        </button>
        </span>
    </div>
</form>
</template>

<script>
export default {
  name: 'NewsletterSubscribe',

  data () {
      return {
          loading: false,
          email: ''
      }
  },

  methods: {
      subscribe (el) {
          this.loading = true

          axios.post(el.target.action, {
              email: this.email
          })
            .then(response => {
                if (response.data.status) {
                    this.email = ''
                    this.loading = false
                } 
            })
      }
  }
}
</script>
