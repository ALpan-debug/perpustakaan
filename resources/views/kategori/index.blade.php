@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Kategori') }}</div>

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
                    
                    <a href="{{Route('kategori.create')}}" class="btn btn-success btn-md m-4"><i class="fa fa-plus"></i>Tambah kategori</a>
                    <table class="table table-strip table-bordered">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                    </tr>                        
                    </thead>

                    <tbody>
                    @foreach($kategori as $kats)
                    <tr> 
                        <td>{{$loop->iteration}}</td>
                        <td>{{$kats->nama_kategori}}</td>
                        <td>{{$kats->deskripsi}}</td>
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
                                    <a href="{{route('kategori.edit',$kats->id)}}" class="btn btn-sm btn-secondary mx-1 shadow" title="Edit"><i  class="fa fa-lg fa-fw fa-pen"></i></a>
                            </div>
                            <form method="POST" action="{{ route('kategori.destroy',$kats->id) }}">
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
                    {{$kategori->links()}}
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