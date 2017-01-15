@extends('layouts.app')

@section('content')
<div class="panel panel-md">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <!-- buttons top -->
                <p><a href="#" class="btn btn-primary btn-theme btn-block"><i class="fa fa-facebook pull-left bordered-right"></i> Login with Facebook</a></p>
                <p><a href="#" class="btn btn-danger btn-theme btn-block"><i class="fa fa-google-plus pull-left bordered-right"></i> Login with Google</a></p>
                <!-- end buttons top -->
                <div class="white-space-10"></div>
                <p class="text-center"><span class="span-line">OR</span></p>
                <!-- form login -->
                <form>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Your Password">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="checkbox flat-checkbox">
                                    <label>
                                    <input type="checkbox">
                                    <span class="fa fa-check"></span>
                                    Remember me?
                                    </label>
                                </div>
                            </div>
                            <div class="col-xs-6 text-right">
                                <p class="help-block"><a href="#myModal" data-toggle="modal">Forgot password?</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <button class="btn btn-theme btn-lg btn-t-primary btn-block">Log In</button>
                    </div>
                </form>
                <!-- form login -->
            </div>
        </div>
    </div>
</div>
<div class="white-space-20"></div>
<div class="text-center color-white">Not a member? &nbsp; <a href="#" class="link-white"><strong>Create an account free</strong></a></div>
@endsection

@push('js')
    <script>
        $(function(){
            $('#content').addClass('block-section bg-color4');
        })
    </script>
@endpush
