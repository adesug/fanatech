
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Sales</h3>
    </div>
    <!-- /.card-header -->
    <form action="/admin/sales/update" method="POST" enctype="multipart/form-data" id="frmSales">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id" placeholder="Id" value="{{$data->id}}">
            </div>
            <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control" id="code" name="code" placeholder="Code" value="{{$data->number}}">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$data->date}}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="">
            </div>
        </div>
        <!-- /.card-body -->
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Data</button>
        </div>
</div>

</form>