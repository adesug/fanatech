@extends('layouts.body')
@section('contentHeader')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Purchases Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item active">Purchases Page</li>
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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                        Create Data
                    </button>
                    {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Purhases Number</th>
                                <th>Inventory Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseDetails as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->purchases->number}}</td>
                                <td>{{$item->inventory->name}}</td>
                                <td>Rp. {{$item->price}} ,-</td>
                                <td>{{$item->qty}}</td>
                                <td>
                                    <form action="{{route('purchases.indexDestroy',$item->id)}}" method="POST">
                                        <div class="margin">
                                            <span data-toggle="modal" data-target="#modalEditPurchases">
                                                <a  class="btn btn-warning edit" id="{{$item->id}}">Edit</a>
                                            </span>
                                            {{-- <button class="btn btn-info">Detail</button> --}}
                                            <span>
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </span>

                                        </div>
                                    </form>
                                </td>
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
<div class="modal fade" id="modalEditPurchases">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="loadeditform">
               
            </div>

            <!-- /.modal-content -->
        </div>
    </div>
</div>
    {{-- / edit --}}
    {{-- modal create --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Inventory</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.inventoryStore')}}" method="POST" enctype="multipart/form-data"
                            id="frmInventory">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Code">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="Price">
                                </div>
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        placeholder="Stock">
                                </div>

                            </div>
                            <!-- /.card-body -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endsection
    @push('myscript')
    <script>
        $(function () {
            $('#table-1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#table-1').on('click', '.edit', function () {
                var id = $(this).attr('id');
                console.log(id);
                $.ajax({
                    type: 'POST',
                    url: '/purchases/index/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token(); }}",
                        id: id
                    },
                    success: function (respond) {
                        $('#loadeditform').html(respond);
                    }
                });
                $('#modalEditPurchases').modal('show');
            });
        });

    </script>
    @endpush
