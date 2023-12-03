@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>User List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as $sl=>$user)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>
                            @if ($user->photo == null)
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                            @else
                            <img  width="50"src="{{asset('uploads/users')}}/{{$user->photo}}" alt="">
                            @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>

                        <td>
                         <button data-link="{{route('user.delete',$user->id)}}" class="btn btn-danger del_btn">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
       $('.del_btn').click(function(){
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
        var link =$(this).attr('data-link');
        window.location.href = link;
     }
    })
    })
   </script>
    @if (session('delete'))
        <script>
            Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
        </script>
    @endif
     @endsection
