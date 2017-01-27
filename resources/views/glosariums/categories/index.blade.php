@extends('layouts.app')

@section('heading')
    @include('glosariums.partials.search', ['totalWord' => $totalWord])
@endsection

@section('content')
<div class="row">
    <div class="col-md-9">
        <!-- box listing -->
        <div class="block-section-sm box-list-area">
            <!-- desc top -->
            <div class="row hidden-xs">
                <div class="col-sm-6  ">
                    @if (request('keyword'))
                    <p><strong class="color-black">Hasil pencarian untuk "{{ request('keyword') }}"</strong></p>
                    @endif
                </div>
                <div class="col-sm-6">
                    <p class="text-right">
                        Halaman {{ $categories->currentPage() }} menampilkan {{ $categories->perPage() }} dari {{ number_format($categories->total(), 0, ',', '.') }} kata
                    </p>
                </div>
            </div>
            <!-- end desc top -->
            <!-- item list -->
            <div class="box-list">
                @foreach ($categories as $category)
                <div class="item">
                    <div class="row">
                        <div class="col-md-1 hidden-sm hidden-xs">
                            <div class="img-item"><h2><i class="fa fa-globe"></i></h2></div>
                        </div>
                        <div class="col-md-11">
                            <h3 class="no-margin-top">
                                <a href="{{ route('glosarium.word.index', ['category' => $category->slug]) }}" class="">{{ $category->name }}</a>
                            </h3>
                            <h5><span class="color-black">{{ number_format($category->words_count, 0, ',', '.') }} kata</span></h5>
                            @if (auth()->check() and auth()->user()->type == 'admin')
                                <p class="editable text-truncate" contenteditable="true" data-id="{{ $category->id }}" data-field="description">{{ !empty($category->description) ? $category->description : 'Klik di sini untuk memperbarui deskripsi.' }}</p>
                            @else
                                <p class="text-truncate">{{ $category->description }}</p>
                            @endif
                            <div>
                                <span class="color-white-mute">{{ $category->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @include('newsletters.partials.subscribe')

            <!-- pagination -->
            <nav >
                {{ $categories->appends(['keyword' => request('keyword')])->links() }}
            </nav>
            <!-- pagination -->
        </div>
        <!-- end box listing -->
    </div>
    <div class="col-md-3">
        <div class="block-section-sm side-right">
            <div class="result-filter">
                <h5 class="no-margin-top font-bold margin-b-20 " ><a href="#s_collapse_1" data-toggle="collapse" >Kata Paling Baru <i class="fa ic-arrow-toogle fa-angle-right pull-right"></i> </a></h5>
                <div class="collapse in" id="s_collapse_1">
                    <div class="list-area">
                        <ul class="list-unstyled">
                            @foreach ($latestWords as $word)
                                <li><a href="{{ route('glosarium.word.show', [$word->category->slug, $word->slug] ) }}">{{ $word->locale }} ({{ $word->origin }})</a></li>
                            @endforeach
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
        $(function(){
            $('li.glosarium').addClass('active');

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
        })
    </script>
@endpush
