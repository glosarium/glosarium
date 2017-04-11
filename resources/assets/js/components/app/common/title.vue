<template>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="text-center logo">
               <a :href="url">
                  <img :src="img" alt="" class="text-center">
               </a>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
   export default {
      name: 'AppTitle',
      props: {
         img: String,
         url: String
      }
   }
</script>