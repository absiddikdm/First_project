@extends('admin.author.main')
@section('content')

<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Become an Author</h3>
            </div>
            <div class="card-body">
                @if (session('sent'))
                    <div class="alert alert-success">{{session('sent')}}</div>
                @endif
                <form action="{{route('author.request.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-lable">Email</label>
                 <input type="email" name="email" class="form-control" value="{{Auth::guard('author')->user()->email}}">
                    </div>
                    <div class="mb-3">
                       <button type="Submit" class="btn btn-primary">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
