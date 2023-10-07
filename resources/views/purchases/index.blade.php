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
                    <a href="{{route('purchases.indexCreate')}}" class="btn btn-success">
                        Create Data
                    </a>
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
    @endsection
    @push('myscript')
    <script>
        $(function () {
            $('#table-1').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
               
            }).buttons().container().appendTo('#table-1_wrapper .col-md-6:eq(0)');
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
