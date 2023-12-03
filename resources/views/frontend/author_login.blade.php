@extends('frontend.master')
@section('content')

<!--Login-->
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Login</h4>
                    <p></p>
                    <form action="{{route('author.login.confirm')}}"  method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*" name="email" value="">
                            @error('email')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('notexist'))
                            <strong class="text-danger">{{session('notexist')}}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                            @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        @if (session('passerror'))
                            <strong class="text-danger">{{session('passerror')}}</strong>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Login in</button>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="{{ route('author.register') }}" class="btn-link">Create One</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
