<!-- form get alert -->
<div class="get_alert">
    <h4>Berlangganan nawala untuk mendapatkan informasi terbaru</span></h4>
    <form action="{{ route('newsletter.subscriber.subscribe') }}" method="post">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label>Alamat Surel</label>
                    <input name="email" class="form-control" placeholder="Masukkan alamat surel yang valid">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="hidden-sm hidden-xs ">&nbsp;</label>
                    <button class="btn btn-theme btn-success btn-block">Berlangganan</button>
                </div>
            </div>
        </div>
        <small>Anda dapat berhenti kapan saja.</small>
    </form>
</div>
<!-- end form get alert -->
