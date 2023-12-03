@extends('admin.author.main')
@section('content')
<div class="row">
   <div class="col-lg-12">
    <div class="card">
        <div class="card-heard d-flex justify-content-between">
            <h3>Post List</h3>
            <a href="{{route('add.post')}}" class="btn btn-primary" style="line-height:24px">Add New Post</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                 <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Thumbnail</th>
                    <th>Status</th>
                    <th>Action</th>
                 </tr>
                 @foreach ($posts as $sl=>$post )
                 <tr>
                    <td> {{ $sl+1 }} </td>
                    <td> {{ $post->title }} </td>
                    <td> {{ $post->rel_to_cat()->first()->category_name }} </td>
                    <td> <img width="100" src="{{asset('uploads/post/thumb')}}/{{$post->thumbnail}}" alt=""></td>

                    <td><a href="{{route('status.change', $post->id)}}" class="btn btn-{{$post->status == 0?'secondary':'success'}}"> {{ $post->status == 0?'Deactive':'Active' }} </a></td>
                    <td>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>
                 </tr>
                 @endforeach
            </table>
        </div>
    </div>
   </div>
</div>
@endsection
