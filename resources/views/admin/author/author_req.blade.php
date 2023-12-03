@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Author Request List</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Email</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($lists as $sl=>$list )
                    <tr>
                        <td> {{ $sl+1 }} </td>
                        <td>{{ $list->email }}</td>
                        <td><a href="{{ route('req.accept', $list->id)}}" class="btn btn-info">Pending</a></td>
                        <td><a href="{{ route('req.delete', $list->id)}}" class="btn btn-danger">Delete</a></td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
