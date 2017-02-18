@extends('layouts.app')

@section('content')

@include('users.partials.sidebar')

<div class="col-md-9 col-sm-9">
<div class="block-section box-side-account">
    <h3 class="no-margin-top">Notifikasi ({{ auth()->user()->unreadNotifications->count() }})</h3>
    <hr/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Subjek</th>
                    <th>Pesan</th>
                    <th></th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
            	@foreach (auth()->user()->unreadNotifications as $notification)
                <tr>
                    <td>{{ $notification->data['subject'] }}</td>
                    <td>{{ $notification->data['message'] }}</td>
                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                    <td class="text-right"><a href="#" class="btn btn-theme btn-xs btn-default">Tandai Sudah Dibaca</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
