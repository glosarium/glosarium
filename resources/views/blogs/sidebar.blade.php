<div class="col-md-4 col-lg-3">
    <div class="widget">
        <h6 class="widget-title">Cari Pos</h6>
        <div class="widget-body">
            <form method="get" target="{{ route('blog.index') }}">
                <input class="form-control" type="text" name="s" placeholder="Masukkan kata kunci...">
            </form>
        </div>
    </div>
    <div class="widget widget_categories">
        <h6 class="widget-title">Semua Kategori</h6>
        <ul class="widget-body">
            @foreach($categories as $category)
                <li class="cat-item"><a href="{{ route('blog.index', ['kategori' => $category->slug]) }}" title="Pos dalam kategori {{ $category->name }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="widget widget_tag_cloud">
        <h6 class="widget-title">Tag</h6>
        <div class="widget-body">
            @foreach($tags as $tag)
                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" title="Pos dengan tag {{ $tag->name }}">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>