@extends('layouts.app')

@section('heading')
    @include('glosariums.partials.search', ['totalWord' => $totalWord])
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- box listing -->
        <div class="block-section-sm box-list-area">

            <alert :show="alerts.message" :title="alerts.title" :type="alerts.type">
                @{{ alerts.message }}
            </alert>

            <!-- desc top -->
            <div class="row hidden-xs">
                <div class="col-sm-6  ">
                    @if (request('keyword'))
                    <p><strong class="color-black">Hasil pencarian untuk "{{ request('keyword') }}"</strong></p>
                    @endif
                </div>
                <div class="col-sm-6">
                    <p class="text-right">
                        Halaman {{ $words->currentPage() }} menampilkan {{ $words->perPage() }} dari {{ number_format($words->total(), 0, ',', '.') }} kata
                    </p>
                </div>
            </div>
            <!-- end desc top -->

            <!-- item list -->
            <div class="box-list">
                @foreach ($words as $word)
                <div class="item">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="no-margin-top">
                                <a href="{{ route('glosarium.word.show', [$word->category->slug, $word->slug]) }}" class="">{{ $word->origin }}</a>
                            </h3>
                            <h4><span class="color-black">{{ $word->locale }}</span> - <span class="color-white-mute"><a href="{{ $word->category->url }}">{{ $word->category->name }}</a></span></h4>
                            <div>
                                <span class="color-white-mute">{{ $word->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- pagination -->
            <nav >
                {{ $words->appends(['keyword' => request('keyword')])->links() }}
            </nav>
            <!-- pagination -->

        </div>
        <!-- end box listing -->
    </div>
    <div class="col-md-3">
        <div class="block-section-sm side-right">
            <div class="result-filter">
                <h5 class="no-margin-top font-bold margin-b-20 " >
                    <a href="#category" data-toggle="collapse" >
                        Kategori <loader :show="loading"></loader> <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i>
                    </a>
                </h5>

                <div v-if="categories" class="collapse in" id="category">
                    <div class="list-area">
                        <ul class="list-unstyled">
                            <li v-for="category in categories">
                                <a :href="category.url">@{{ category.name }} (@{{ category.words_count.toLocaleString('id-Id') }})</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
    <script>
        $(() => {
            $('li.glosarium').addClass('active');

            $('ul.pagination').addClass('pagination-theme no-margin');

            $('div.alert').hide();

            $('.editable').blur(function(){
                var data = {
                    '_token': Laravel.csrfToken,
                    'id': $(this).attr('data-id'),
                    'text': $(this).text(),
                    'field': $(this).attr('data-field')
                };

                var url = '{{ route('user.glosarium.category.updateField') }}';

                $.ajax({
                    url: url,
                    data: data,
                    type: 'PUT',
                    success: function(response) {
                        console.log(response.message);
                    }
                });
            });
        });

        new Vue({
            el: '#content',
            data: {
                loading: false,
                categories: null,
                alerts: {
                    type: 'default',
                    title: null,
                    message: null
                }
            },

            mounted() {
                this.getCategory();
            },

            methods: {

                getCategory() {
                    let url = '{{ route('glosarium.category.all') }}';

                    this.loading = true;

                    this.$http.get(url).then(response => {

                        this.categories = response.body.categories;

                        this.loading = false;

                    }, response => {
                        this.alerts = {
                            type: 'danger',
                            message: 'Kesalahan Server Internal.'
                        }

                        this.loading = false;
                    });
                }

            }
        })
    </script>
@endpush
