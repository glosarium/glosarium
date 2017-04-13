<template>
   <div class="panel panel-default">
      <div class="panel-heading">Selamat datang!</div>
      <div class="panel-body">
         <p>Halo, <br> Terima kasih telah bergabung dengan Glosarium Indonesia. Pada halaman kontributor, Anda dapat berkontribusi dengan menambahkan kata baru dengan mengklik <a href="/word/propose">tautan ini</a>. Kontribusi Anda sangat membantu dalam perkembangan aplikasi Glosarium Indonesia.</p>

         <p>Anda juga dapat mnegubah <router-link :to="{ name: 'user.password' }">sandi lewat</router-link> dan membaca <router-link :to="{ name: 'user.notification' }">notifikasi</router-link> yang masuk pada akun Anda.</p>

         <p>Jika Anda menemukan kesalahan aplikasi, ada pertanyaan, saran maupun kritik, jangan sungkan untuk menyampaikannya melalui <a href="/contact">formulir kontak</a>.</p>

         <p>Hormat kami.</p>
      </div>
   </div>
</template>