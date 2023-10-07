@extends('layouts.body')
@section('contentHeader')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manager Sales Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item active">Manager Sales Page</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('mainContent')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Inventory Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesData as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->inventory->name}}</td>
                                <td>Rp. {{$item->price}} ,-</td>
                                <td>{{$item->qty}}</td> 
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
{{-- modal edit --}}

    {{-- / edit --}}
    @endsection
    @push('myscript')
    <script>
        $(function () {
            $('#table-1').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
               
            }).buttons().container().appendTo('#table-1_wrapper .col-md-6:eq(0)');
        });

    </script>
    @endpush
