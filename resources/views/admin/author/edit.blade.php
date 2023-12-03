@extends('admin.author.main')
@section('content')

<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-hearder">
                <h3>Edit Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{route('author.profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">UserName</label>
                        <input type="text" name="username" class="form-control" value="{{Auth::guard('author')->user()->username}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="Password" name="Password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img width="200" src="" id="blah" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Social media</h3>
            </div>
            <div class="card-body">
                <form action=" {{route('author.social.store')}} " method="POST">
                    @csrf
                    <div class="mb-3">
                        <?php
                        $fonts = array (
                            'fa-facebook-official',
                            'fa-instagram',
                            'fa-twitter',
                            'fa-linkedin',
                            'fa-linkedin-square',
                            'fa-youtube',
                        );

                        ?>
                        @foreach ($fonts as $icon )
                            <i class=" {{$icon}} icon" data-class="{{ $icon}}" style="font-family: fontawesome; font-size:40px; font-style:normal; padding:5px; cursor: pointer"></i>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="">Icon</label>
                        <input id="icon_class" type="text" name="icon_class" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Social Link</label>
                        <input type="text" name="social_link" class="form-control">
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary">Add Social</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
   <script>
    $('.icon').click(function(){
        var icon_class = $(this).attr('data-class');
        $('#icon_class').attr('value',icon_class);
    });
   </script>
@endsection
