@extends('layouts.body')
@section('contentHeader')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Sales Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Menu</a></li>
            <li class="breadcrumb-item active">Sales Page</li>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="table-1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Number</th>
                  <th>Date</th>
                  <th>Sales Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($sales as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    {{-- <td>{{$item->id}}</td> --}}
                    <td>{{$item->number}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>
                      <form action="{{route('admin.salesDestroy',$item->id)}}" method="POST">
                        <div class="margin">
                          <span data-toggle="modal" data-target="#modalEditSales">
                            <a  class="btn btn-warning edit" id="{{$item->id}}">Edit</a>
                        </span>
                        {{-- <button class="btn btn-info">Detail</button> --}}
                        <span>
                            @csrf
                            <button type="submit" class="btn btn-danger delete-confirm">Delete</button>
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
  <div class="modal fade" id="modalEditSales">
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
                        <h3 class="card-title">Sales</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('admin.salesStore')}}" method="POST" enctype="multipart/form-data" id="frmSales">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Number</label>
                                <input type="text" class="form-control" id="number" name="number" placeholder="number">
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                            </div>
                            <div class="form-group">
                                <label>Sales Name</label>
                                <select class="form-control select2" id="myselect" name="user_id">
                                  <option></option>
                                  @foreach ($userSales as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                                </select>
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
    "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"],
               
            }).buttons().container().appendTo('#table-1_wrapper .col-md-6:eq(0)');
   $('.select2').select2({
    placeholder: "Select...",
    allowClear: true,
   });
   $('#table-1').on('click', '.edit', function () {
                var id = $(this).attr('id');
                console.log(id);
                $.ajax({
                    type: 'POST',
                    url: '/admin/sales/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token(); }}",
                        id: id
                    },
                    success: function (respond) {
                        $('#loadeditform').html(respond);
                    }
                });
                $('#modalEditSales').modal('show');
            });
            $(".delete-confirm").click(function (e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title : 'Apakah Anda Yakin Data Ini Mau Di hapus ?'
                    , text : 'Jika ya maka data akan dihapus permanent'
                    , icon : 'warning'
                    , showCancelButton : true
                    , confirmButtonColor : '#3085d6'
                    , cancelButtonColor : '#d33'
                    , confirmButtonText : 'Ya, Hapus !'
                }).then((result) => {
                    if(result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted !' , 'Data Berhasil Dihapus' , 'success');
                    }
                })
            })
 });
</script>
@endpush