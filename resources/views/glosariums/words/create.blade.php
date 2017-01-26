@extends('layouts.app')

@section('heading')
	@include('glosariums.partials.title', compact('title'))
@endsection

@section('content')
<div class="row" style="margin-top: 20px">
    <div class="col-md-6 col-md-offset-3">

    	<alert :show="alerts.message" :title="alerts.title" :type="alerts.type">
    		@{{ alerts.message }}
    	</alert>

        <!-- form post a job -->
        <form @submit.prevent="create" action="{{ route('glosarium.word.store') }}" method="post">

        	<div :class="['form-group', errors && errors.category ? 'has-error' : '']">
        		<label>@lang('glosarium.form.category')</label>
        		<select :disabled="loading" v-model="forms.category" name="category" class="form-control">
        			<option value="null">@lang('glosarium.selectCategory')</option>
        			<option v-for="category in categories" :value="category.id">
        				@{{ category.name }} (@{{ category.words_count }})
        			</option>
        		</select>

        		<span v-if="errors && errors.category" class="label label-danger">
        			@{{ _.head(errors.category) }}
        		</span>
        	</div>

            <div :class="['form-group', errors && errors.origin ? 'has-error' : '']">
                <label>@lang('glosarium.form.origin', ['variable' => 'replacement'])</label>
                <input :disabled="loading" v-model="forms.origin" type="text" class="form-control">

                <span v-if="errors && errors.origin" class="label label-danger">
                	@{{ _.head(errors.origin) }}
                </span>
            </div>

            <div :class="['form-group', errors && errors.locale ? 'has-error' : '']">
                <label>@lang('glosarium.form.locale')</label>
                <div class="color-white-mute"><small>@lang('glosarium.inLocale')</small></div>
                <input :disabled="loading" v-model="forms.locale" type="text" class="form-control">

                <span v-if="errors && errors.locale" class="label label-danger">
                	@{{ _.head(errors.locale) }}
                </span>
            </div>

            <div :class="['form-group', errors && errors.description ? 'has-error' : '']">
                <label>@lang('glosarium.form.description')</label>
                <div class="color-white-mute"><small>Tulisa rincian, gagasan, atau referensi kata.</small></div>
                <textarea :disabled="loading" v-model="forms.description" class="form-control" rows="6"></textarea>

                <span v-if="errors && errors.description" class="label label-danger">
                	@{{ _.head(errors.description) }}
                </span>
            </div>

            @if (auth()->check())
            	<p>@lang('glosarium.forward', ['email' => auth()->user()->email])</p>
            @endif

            <div class="form-group ">
                <button :disabled="loading" class="btn btn-t-primary btn-theme">
                	@lang('glosarium.btn.create') <i v-if="loading" class="fa fa-spinner fa-spin"></i>
                </button>
            </div>
        </form>
        <!-- end form post a job -->
    </div>
</div>
@stop

@push('js')
	<script>
		$(() => {
			$('#content').removeClass('bg-color2')
				.addClass('bg-color1');
		});

		new Vue({
			el: '#content',
			data: {
				loading: false,
				categories: null,
				alerts: {
					type: null,
					title: null,
					message: null
				},
				errors: {
					category: null,
					origin: null,
					locale: null,
					description: null
				},
				forms: {
					category: null,
					origin: null,
					locale: null,
					description: null
				}
			},

			mounted() {
				this.category();
			},

			methods: {

				pre() {
					this.loading = true;

					this.alerts = {
						type: null,
						title: null,
						message: null
					};
				},

				post() {
					this.loading = false;
				},

				error() {
					this.alerts = {
						type: 'danger',
						title: 'Ups!',
						message: 'Terjadi kesalahan internal'
					};
				},

				category() {
					let url = '{{ route('glosarium.category.all') }}';

					this.$http.get(url).then(response => {
						this.categories = response.body.categories;

					}, response => {
						this.error();
					});
				},

				create(e) {
					this.pre();

					this.$http.post(e.target.action, this.forms).then(response => {

						this.alerts = response.body.alerts;

						this.forms = {
							category: null,
							origin: null,
							locale: null,
							description: null
						};

						this.errors = {
							category: null,
							origin: null,
							locale: null,
							description: null
						};

						this.post();

					}, response => {
						if (response.status == 422) {
							this.errors = response.body;
						}
						else {
							this.error();
						}

						this.post();
					});
				}

			}
		});
	</script>
@endpush
