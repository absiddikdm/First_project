@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-8 m-auto">
        <form action="{{route('trash.checked')}}" method="POST">
            @csrf
        <div class="card">
            <div class="card-header">
                <h3>Trashed Category</h3>
            </div>
            <div class="card-body">
                    <div class="my-2 text-right delll-btn d-none">
                    <button name="btn_action"  value="1" class="btn btn-danger" type="submit">Delete All</button>
                    <button name="btn_action" value="2"  class="btn btn-success" type="submit">Restore All</button>
                    </div>
                     <table class="table table-borderd">
                    <tr>
                        <th>SL</th>
                        <th>
                            <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" id="checkAll"class="form-check-input checkAll">
                             Checked All
                             <i class="input-frame"></i></label>
                            </div>
                        </th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($Categories as $sl=> $category)
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
                         <a class="btn btn-success" title="Restore" href="{{route('category.restore',$category->id)}}">
                            <i data-feather="corner-left-up"></i>
                         </a>
                         <a class="btn btn-danger "title="Delete"  href="{{route('category.pdelete',$category->id)}}">
                        <i data-feather="trash"></i>
                         </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4"class="text-center text-danger">No  Trash catagore found</td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$(".checkAll").click(function(){
        $('.delll-btn').removeClass('d-none');
});
</script>
@endsection
