@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Subscriber List</h3>
            </div>
            <div class="card-body">
                @if (session('send_mail'))
                     <div class="alert alert-success">{{session('send_mail')}}</div>
                @endif
                <table class="table table-border">
                    <tr>
                        <th>SL</th>
                        <th>Email</th>
                        <th>Send</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($subscribers as $sl=> $subscriber )
                    <tr>
                        <td> {{$sl+1}} </td>
                        <td> {{$subscriber->email}} </td>
                        <td><a href=" {{route('send.subscribe.mail', $subscriber->id) }} " class="btn btn-info">Send Email</a></td>
                        <td><a href=" {{route('subs.delete', $subscriber->id) }} " class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
