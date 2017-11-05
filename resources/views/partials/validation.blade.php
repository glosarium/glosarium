@if(!$errors->isEmpty())
<div class="alert alert-warning">
    <ul class="text-left">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif