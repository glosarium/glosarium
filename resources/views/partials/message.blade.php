<div class="col-xs-12 ">
    @if(session('success'))
    <div class="alert alert-success">
        <strong>Sukses!</strong><br> {{ session('success') }}
    </div>
    @endif @if(session('warning'))
    <div class="alert alert-warning">
        <strong>Peringatan!</strong><br> {{ session('warning') }}
    </div>
    @endif
</div>