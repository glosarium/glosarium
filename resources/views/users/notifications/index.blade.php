@extends('layouts.app')
@section('content')
@include('users.partials.sidebar')
<div class="col-md-9 col-sm-9">
<div class="block-section box-side-account">
   <div class="panel panel-default">
      <div class="panel-heading">
          <span v-if="notifications.total >= 1">@{{ notifications.total }} Notifikasi</span>
          <span v-else>Tidak ada notifikasi</span>
      </div>
      <div class="panel-body">
         <div class="qa-message-list" id="wallmessages">
            <div v-for="(notification, index) in notifications.data" class="message-item">
               <div class="message-inner">
                  <div class="message-head clearfix">
                     <div class="avatar pull-left">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                        </a>
                     </div>
                     <div class="user-detail">
                        <h5 class="handle">@{{ notification.data.subject }}</h5>
                        <div class="post-meta">
                           <div class="asker-meta">
                              <span class="qa-message-what"></span>
                              <span class="qa-message-when">
                              <span class="qa-message-when-data">@{{ notification.updated_diff }}</span>
                              </span>
                              <span class="qa-message-who">
                              <span class="qa-message-who-pad hidden">oleh </span>
                              <span class="qa-message-who-data hidden"><a href="./index.php?qa=user&qa_1=Oleg+Kolesnichenko">Oleg Kolesnichenko</a></span>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="qa-message-content">
                     @{{ notification.data.message }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <button class="btn btn-block btn-theme btn-t-primary">Muat lebih banyak...</button>
</div>
@endsection
@push('js')
<script>
   const notification = {!! json_encode([
       'paginate' => route('user.notification.paginate')
   ]) !!}
</script>
<script>
   new Vue({
       el: '#app',
       data: {
           notifications: []
       },

       mounted() {
           this.unreadNotifications(notification.paginate);
       },

       methods: {

           unreadNotifications(url) {
               this.$http.get(url).then(response => {
                   this.notifications = response.body;
               });
           },

           readNotification(index, url) {
               this.$http.get(url).then(response => {
                   if (response.body.success) {
                       this.notifications.data.splice(index, 1);
                       this.notifications.total--;
                   }
               });
           }
       }
   });
</script>
@endpush
