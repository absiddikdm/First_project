@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <form action="{{route('delete.checked')}}" method="POST">
            @csrf
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
            <div class="card-body">
                <div class="my-2 text-right delll-btn d-none">
                <button class="btn btn-danger" type="submit">Delete All</button>
                </div>
                <table class="table table-borderd">
                    <tr>
                        <th>SL</th>
                        <Th>
                            <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" id="checkAll"class="form-check-input checkAll">
                            Checked All
                            <i class="input-frame"></i></label>
                            </div>
                        </Th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($Categories as $sl=> $category)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="checkbox" name="catagory_id[]" value="{{$category->id}}"class="form-check-input checkAll">
                                <i class="input-frame"></i></label>
                            </div>
                        </td>
                        <td><img width="64" src="{{ asset('uploads/category')}}/{{$category->category_image}}" alt=""></td>
                        <td>{{$category->category_name}}</td>
                        <td>
                            <button type="button" class="btn btn-danger btn-icon" data-link="{{route('category.delete',$category->id)}}">
                            <i data-feather="trash"></i>
                              </button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </form>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add New Category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('category.store')}}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" name="category_image" class="form-control">
                        @error('category_image')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
@if (session('success'))
    <script>
        Swal.fire({
   position: 'Bottom-end',
   icon: 'success',
   title: '{{session('success')}}',
   showConfirmButton: false,
   timer: 1500
})
    </script>
@endif
<script>
    $('.btn-icon').click(function(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    var link = $(this).attr('data-link');
    window.location.href=link;
  }
})
    })
</script>
@if (session('del_success'))
<script>
    Swal.fire(
      'Deleted!',
      '{{session('del_success')}}',
      'success'
    )
</script>

@endif
<script>
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$(".checkAll").click(function(){
        $('.delll-btn').removeClass('d-none');
});
</script>
@endsection




