@extends('layouts.app')

@section('heading')
    @include('partials.glosariums.title', [
        'title' => $title
    ])
@endsection

@section('content')

<h2 class="text-center">Bantu kami berkembang!<br/>
    <small>Sampaikan salam, kritik dan saran untuk kemajuan</small>
</h2>
<div class="white-space-20"></div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        @include('partials.message')

        <div v-if="alerts.message" v-bind:class="['alert', 'alert-' + alerts.type]">
            @{{ alerts.message }}
        </div>

        <!-- form contact -->
        <form v-on:submit.prevent="send" action="{{ route('contact.post') }}" method="post">
            {{ csrf_field() }}

            <div v-bind:class="['form-group', errors.email ? 'has-error' : '']">
                <label>Surel</label>
                @if (auth()->check())
                    <input disabled="" type="email" name="email" class="form-control disabled" value="{{ auth()->user()->email }}">
                @else
                    <input v-model="forms.email" v-bind:disabled="inputDisabled" name="email" type="email" class="form-control" value="{{ old('email') }}">
                @endif

                <span v-if="errors.email" class="label label-danger">@{{ errors.email[0] }}</span>
            </div>

            <div v-bind:class="['form-group', errors.subject ? 'has-error' : '']">
                <label>Subjek</label>
                <input v-model="forms.subject" v-bind:disabled="inputDisabled" name="subject" type="text" class="form-control" value="{{ old('subject') }}">

                <span v-if="errors.subject" class="label label-danger">@{{ errors.subject[0] }}</span>
            </div>

            <div v-bind:class="['form-group', errors.message ? 'has-error' : '']">
                <label>Pesan</label>
                <textarea v-model="forms.message" v-bind:disabled="inputDisabled" name="message" class="form-control" rows="6" value="{{ old('message') }}"></textarea>

                <span v-if="errors.message" class="label label-danger">@{{ errors.message[0] }}</span>
            </div>

            <div class="form-group text-center">
                <div class="white-space-10"></div>
                <button v-bind:disabled="inputDisabled" type="submit" class="btn btn-theme btn-lg btn-long btn-t-primary btn-pill">Kirim Pesan</button>
            </div>
        </form>
        <!-- end form contact -->
    </div>
</div>
@endsection

@push('js')
    <script>
        $(function(){
            $('li.contact').addClass('active');
        });

        var app = new Vue({
            el: '#content',
            data: {
                inputDisabled: false,
                alerts: {
                    type: null,
                    message: null
                },
                forms: {
                    _token: Laravel.csrfToken,
                    email: null,
                    subject: null,
                    message: null
                },
                errors: {
                    email: null,
                    subject: null,
                    message: null
                }
            },

            methods: {

                send: function(el) {
                    this.inputDisabled = true;

                    this.alerts = {
                        message: null
                    };

                    this.errors = {
                        email: null,
                        subject: null,
                        message: null
                    };

                    this.$http.post(el.target.action, this.forms).then(function(response){
                        this.alerts = response.body;

                        this.forms = {
                            _token: Laravel.csrfToken,
                            email: null,
                            subject: null,
                            message: null
                        };

                        this.errors = {
                            email: null,
                            subject: null,
                            message: null
                        };

                        this.inputDisabled = false;

                    }, function(response){
                        this.errors = response.body;
                        this.inputDisabled = false;
                    });
                }

            }
        })
    </script>
@endpush
