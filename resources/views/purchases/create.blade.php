@extends('layouts.body')
@section('contentHeader')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Purchases Page</h1>
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
            <form action="{{route('purchases.indexStore')}}" method="POST">
                @csrf
            <div class="card">
                <div class="card-header">
                   
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>

                        @endif
                        {{-- <h3 class="card-title">DataTable with minimal features & hover style</h3> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered" id="dynamicTable">
                        <tr>
                            <th>Inventory Name</th>
                            <th>Purchases Number</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control select" id="myselect" name="inventory_id[]"  >
                                    <option value="">Pilih Data</option>
                                    @foreach ($inventory as $item)
                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                    @endforeach
                                  </select>
                            </td>
                            <td>
                                <select class="form-control select" id="myselect2" name="purchases_id[]">
                                    <option value="">Pilih Data</option>
                                    @foreach ($purchases as $i)
                                        <option value="{{$i->id}}" >{{$i->number}}</option>
                                    @endforeach
                                  </select>
                            </td>
                            <td><input type="text" name="qty[]" placeholder="Enter your Qty" class="form-control" /></td>
                            <td><input type="text" name="price[]" placeholder="Enter your Price" class="form-control" /></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-success">Save</button>
                   
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </form>
        </div>
    </div>
</div>

{{-- / edit --}}
@endsection
@push('myscript')
<script>
    $(function () {
        var i = 0;
        $("#add").click(function () {
            ++i;
            $("#dynamicTable").append('<tr><td><select class="form-control select3" id="myselect3'+ i +'" name="inventory_id[]" placeholder="Enter name inventory"><option value="">Pilih Data</option>@foreach ($inventory as $item)<option value="{{$item->id}}" >{{$item->name}}</option>@endforeach</select></td><td><select class="form-control select" id="myselect4'+ 
                i +'" name="purchases_id[]"><option value="">Pilih Data</option>@foreach ($purchases as $i)<option value="{{$i->id}}" >{{$i->number}}</option>@endforeach</select></td><td><input type="text" name="qty[]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="price[]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
            $('#myselect3'+ i ).select2();
            $('#myselect4'+ i).select2();
        });
        $(document).on('click', '.remove-tr', function () {
            $(this).parents('tr').remove();
        });
        $('#myselect').select2();
        $('#myselect2').select2();
        
    });

</script>
@endpush
