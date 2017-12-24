<template>
  <div class="alert alert-info text-left">
      <h5>Informasi <i v-if="loading" class="fa fa-spin fa-spinner"></i></h5>
      <div v-if="emailed">
          Pos konfirmasi sudah dikirim ulang. Silakan cek kembali kotak masuk pos elektronik kamu.
      </div>
      <div v-else>
          Halo <strong>{{ name }}</strong>, kamu sudah terdaftar sebagai kontributor di Glosarium Indonesia, namun belum mengkonfirmasi alamat pos-el. Jika kamu belum menerima pos untuk konfirmasi, silakan <a @click.prevent="resend" href="/kirim-konfirmasi" class="alert-link"> klik tautan berikut</a> untuk mengirim ulang. Pastikan untuk memeriksa kotak spam di aplikasi pos elektronik kamu.
      </div>
  </div>
</template>

<script>
export default {
  name: 'UserConfirmation',

  props : {
      name: {
          type: String,
          default: ''
      }
  },

  data () {
      return {
          emailed: false,
          loading: false
      }
  },
  
  methods: {
      resend (e) {
          this.loading = true
          axios.post(e.target.href)
            .then(response => {
                this.emailed = response.data.status
                this.loading = false
            })
      }
  }
}
</script>

