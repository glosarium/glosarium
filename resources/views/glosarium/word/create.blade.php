@extends('layouts.app')

@push('metadata')
<meta name="author" content="{{ config('app.name') }}">
<meta name="description" content="@lang('glosarium.contribute')">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="@lang('glosarium.word.contribute')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $imagePath }}">
@endpush

@section('heading')
@include('partials.title', compact('title'))
@endsection

@section('content')
<div class="row" style="margin-top: 20px" v-cloak>
   <div class="col-md-12">
      <div class="text-center">@include('partials.ads.leaderboard')</div>
   </div>
   <div class="col-md-6 col-md-offset-3">
      <hr>
      <alert :show="alerts.message" :title="alerts.title" :type="alerts.type">
         <p>@{{ alerts.message }}</p>
      </alert>

      @if (!auth()->check())
      <div class="alert alert-info">
         <strong>@lang('global.hello'),</strong>
         <p>@lang('glosarium.word.loginFirst', [
            'login' => url('login'),
            'register' => url('register')
            ])
         </p>
      </div>
      @endif
      <!-- form post a job -->
      <form @submit.prevent="create" action="{{ route('glosarium.word.store') }}" method="post">
         <div :class="['form-group', errors && errors.category ? 'has-error' : '']">
            <label>@lang('glosarium.word.field.category')</label>
            <select :disabled="loading" v-model="forms.category" name="category" class="form-control">
               <option value="">@lang('glosarium.category.select')</option>
               <option v-for="category in categories" :value="category.id">
                  @{{ category.name }} (@{{ category.words_count.toLocaleString('id-ID') }})
               </option>
            </select>
            <span v-if="errors && errors.category" class="label label-danger">
            @{{ _.head(errors.category) }}
            </span>
         </div>
         <div :class="['form-group', errors && errors.origin ? 'has-error' : '']">
            <label>@lang('glosarium.word.field.origin', ['variable' => 'replacement'])</label>
            <input :disabled="loading" v-model="forms.origin" type="text" class="form-control">
            <span v-if="errors && errors.origin" class="label label-danger">
            @{{ _.head(errors.origin) }}
            </span>
         </div>
         <div :class="['form-group', errors && errors.locale ? 'has-error' : '']">
            <label>@lang('glosarium.word.field.locale')</label>
            <div class="color-white-mute"><small>@lang('glosarium.word.inLocale')</small></div>
            <input :disabled="loading" v-model="forms.locale" type="text" class="form-control">
            <span v-if="errors && errors.locale" class="label label-danger">
            @{{ _.head(errors.locale) }}
            </span>
         </div>
         <div :class="['form-group', errors && errors.description ? 'has-error' : '']">
            <label>@lang('glosarium.word.field.description')</label>
            <div class="color-white-mute"><small>@lang('glosarium.word.descriptionHelp')</small></div>
            <textarea :disabled="loading" v-model="forms.description" class="form-control" rows="6"></textarea>
            <span v-if="errors && errors.description" class="label label-danger">
            @{{ _.head(errors.description) }}
            </span>
         </div>
         @if (auth()->check())
         <p>@lang('glosarium.word.forward', ['email' => auth()->user()->email])</p>
         @endif
         <div class="form-group ">
            <button :disabled="loading || ! auth" class="btn btn-t-primary btn-theme">
            @lang('glosarium.word.btn.propose') <i v-if="loading" class="fa fa-spinner fa-spin"></i>
            </button>
         </div>
      </form>
      <!-- end form post a job -->
   </div>
</div>
@endsection

@push('js')
<script>
   window.words = {!! json_encode($js) !!};
</script>

<script src="{{ asset('js/glosarium/word.create.js') }}"></script>
@endpush
