@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Social Media List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Stutas</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($socials as $sl=>$social)
                    <tr>
                        <td> {{ $sl+1 }} </td>
                        <td> <i class="{{ $social->icon_class }}" style="font-family: fontawesome;font-style:normal; font-size:30px "></i> </td>
                        <td> <a target="_blank" href="{{ $social->social_link }}">{{ $social->social_name }}</a> </td>
                        
                        <td><a href=" {{ route('social.status.change', $social->id)}} " class="btn btn-{{$social->status==1?'success':'secondary'}}"> {{$social->status==1?'Active':'Deactive'}} </a></td>

                        <td><a href=" {{ route('social.delete', $social->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Social media</h3>
            </div>
            <div class="card-body">
                <form action=" {{route('social.store')}} " method="POST">
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
                        <label for="">Social Media Name</label>
                        <input type="text" name="social_name" class="form-control">
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
