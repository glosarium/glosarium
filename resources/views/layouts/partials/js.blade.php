<script>
    window.Laravel = {!! json_encode([
        'locale' => config('app.locale'),
        'csrfToken' => csrf_token(),
        'url' => env('APP_URL'),
        'auth' => auth()->check(),
        'user' => [
            'email' => auth()->check() ? auth()->user()->email : null,
            'name' => auth()->check() ? auth()->user()->name : null,
        ]
    ]) !!}
</script>
