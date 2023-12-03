@extends('admin.author.main')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-hearder d-flex justify-content-between ">
                <h3>Add New Post</h3>
                <a href="{{route('post.list')}}" class="btn btn-primary" style="line-height:24px">Post List</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success"> {{session('success')}} </div>
                @endif
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                               <label for="" class="form-label">Category</label>
                               <select name="category_id" class="form-control" id="">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                               </select>
                               @error('category_id')
                                  <strong class="text-danger">{{ $message }}</strong>
                               @enderror
                            </div>
                        </div>
                           <div class="col-lg-8">
                            <div class="mb-3">
                               <label for="" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control">
                                @error('title')
                                  <strong class="text-danger">{{ $message }}</strong>
                               @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                        <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                           <textarea id="summernote" name="desp" cols="30" rows="10" class="form-control"></textarea>
                           @error('desp')
                                  <strong class="text-danger">{{ $message }}</strong>
                               @enderror
                         </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="" class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control">
                            @error('thumbnail')
                            <strong class="text-danger">{{ $message }}</strong>
                         @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                           <label for="" class="form-label">Cover Image</label>
                            <input type="file" name="cover_image" class="form-control">
                            @error('cover_image')
                            <strong class="text-danger">{{ $message }}</strong>
                         @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                         <label for="" class="form-label">Tags</label>
                          <select id="tag" name="tags[]" multiple ="multiple" class="form-control">
                            <optgroup>
                            @foreach ($tags as $tag )
                           <option value="{{ $tag->id }}"> {{ $tag->tag_name }}</option>
                            @endforeach
                            </optgroup>
                        </select>
                        @error('tags')
                        <strong class="text-danger">{{ $message }}</strong>
                         @enderror
                         </div>
                    </div>
                    <div class="col-lg-3 m-auto">
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary w-100"> Add Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
    $('#summernote').summernote();
    // $('#select-gear').selectize({ sortField: 'text' })
    });
</script>

<script>
    $(document).ready(function() {
        $('#tag').select2();
    });
</script>
@endsection
