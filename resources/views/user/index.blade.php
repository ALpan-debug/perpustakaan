@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('profile') }}</div>

                <div class="card-body">
                    @if($message =Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{$message}}</strong>
                    </div>
                    @endif
                    @if($message =Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                    </div>
                    @endif
                    
                    <a href="{{Route('user.create')}}" class="btn btn-success btn-md m-4"><i class="fa fa-plus"></i>Tambah User</a>
                    <table class="table table-strip table-bordered">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>                        
                    </thead>

                    <tbody>
                    @foreach($user as $users)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$users->name}}</td>
                        <td>{{$users->nama_lengkap}}</td>
                        <td>{{$users->email}}</td>
                        <td>{{ucfirst($users->hasRole()->value('role'))}}</td>
                        <td>
                            @if(!Auth::user()->isAdmin() && $users->hasRole()->value('role')=='user')
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <a href="{{route('user.edit',$users->id)}}" class="btn btn-sm btn-secondary mx-1 shadow" title="Edit"><i  class="fa fa-lg fa-fw fa-pen"></i></a>
                            </div>
                            <form method="POST" action="{{ route('user.destroy',$users->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete"> <i class="fa fa-lg  fa-fw fa-trash"></i></button>
                            </form>
                            </div>
                            @else
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <a href="{{route('user.edit',$users->id)}}" class="btn btn-sm btn-secondary mx-1 shadow" title="Edit"><i  class="fa fa-lg fa-fw fa-pen"></i></a>
                            </div>
                            <form method="POST" action="{{ route('user.destroy',$users->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete"> <i class="fa fa-lg  fa-fw fa-trash"></i></button>
                            </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                    {{$user->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(".btn-delete").click(function(e){
    e.preventDefault();
    var form = $(this).parents("form");
    Swal.fire({
        title: "Konfirmasi Hapus User",
        text: "Apakah Anda Yakin Akan Menghapus User ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>
@endsection