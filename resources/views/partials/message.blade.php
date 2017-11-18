@if(session('success'))
<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Sukses!</strong><br> {{ session('success') }}
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Peringatan!</strong><br> {{ session('warning') }}
</div>
@endif

@if(session('danger'))
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Peringatan!</strong><br> {{ session('danger') }}
</div>
@endif

@if(session('info'))
<div class="alert alert-info">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Peringatan!</strong><br> {{ session('info') }}
</div>
@endif