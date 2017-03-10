@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-9 col-sm-9">
<div class="block-section box-side-account">
    <h3 v-cloak class="no-margin-top">Notifikasi (@{{ notifications.total }})</h3>
    <hr/>
    <div v-if="notifications.data.length >= 1" class="table-responsive">
        <table class="table" v-cloak>
            <thead>
                <tr>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th></th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
            	<tr v-for="(notification, index) in notifications.data">
                    <td>@{{ notification.data.subject }}</td>
                    <td>@{{ notification.data.message }}</td>
                    <td>@{{ notification.updated_diff }}</td>
                    <td class="text-right">
                        <a @click.prevent="readNotification(index, notification.read_url)" :href="notification.read_url" class="btn btn-xs btn-default btn-danger">
                            <i class="fa fa-trash fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else class="alert alert-info" v-cloak>
        Tidak ada notifikasi untuk saat ini.
    </div>

    <ul class="pagination pagination-theme no-margin" v-cloak>
        <li v-if="notifications.prev_page_url">
            <a @click.prevent="unreadNotifications(notifications.prev_page_url)" href="#">@lang('pagination.next')</a>
        </li>
        <li v-if="notifications.next_page_url">
            <a @click.prevent="unreadNotifications(notifications.next_page_url)" href="#">@lang('pagination.next')</a>
        </li>
    </ul>
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
