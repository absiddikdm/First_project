@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6">
       <div class="card">
           <div class="card-header">
               <h3>Edit Profile Infomation</h3>
           </div>
          <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
               <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                       <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                  </div>
                   <div class="mb-3">
                       <label for="" class="form-label">Profile Photo</label>
                     <input type="file" name="photo" class="form-control"onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                     <div class="my-2">
                        <img width="200" src="{{asset('uploads/users')}}/{{Auth::user()->photo}}" alt="" id="blah">
                     </div>
                    </div>
                     <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
           </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Update Password</h3>
            </div>
            <div class="body">
                @if (session('pass_update'))
                    <div class="alert alert-success">{{session('pass_update')}}</div>
                @endif
                <form action="{{route('password.update')}}"method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for=""class="form-lavel">Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')
                         <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('wrong'))
                        <strong class="text-danger">{{session('wrong')}}</strong>
                    @endif
                    </div>
                    <div class="mb-3">
                        <label for=""class="form-lavel">New Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                         <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for=""class="form-lavel">Comfirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                         <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
