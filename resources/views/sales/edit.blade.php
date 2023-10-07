
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Purchases</h3>
    </div>
    <!-- /.card-header -->
    <form action="{{route('sales.indexUpdate')}}" method="POST" enctype="multipart/form-data" id="frmPurchases">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id" placeholder="Id" value="{{$salesDetails->id}}">
            </div>
            {{-- <div class="form-group">
                <label>Purchases Number</label>
                <input readonly type="text" class="form-control" id="sales_id" name="sales_id" placeholder="Purchases" value="{{$salesDetails->purchases->number}}">
            </div> --}}
            <div class="form-group">
                <label>Inventory Name</label>
                <input readonly type="text" class="form-control" id="inventory_id" name="inventory_id" placeholder="Inventory" value="{{$salesDetails->inventory->name}}">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{$salesDetails->price}}">
            </div>
            <div class="form-group">
                <label>Qty</label>
                <input type="text" class="form-control" id="qty" name="qty" placeholder="Qty" value="{{$salesDetails->qty}}">
            </div>
            {{-- <div class="form-group">
                <label>Sales Name</label>
                <select class="form-control select3" id="myselect" name="user_id">
                    <option></option>
                    @foreach ($userSales as $item)
                        <option value="{{$item->id}}" {{($item->id == $data->user_id) ? 'selected' : ''}} >{{$item->name}}</option>
                    @endforeach
                  </select>
            </div> --}}
        </div>
        <!-- /.card-body -->
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Data</button>
        </div>
</div>

</form>
@stack('myscript')
    <script>
        $(function() {
            $('#myselect').select2();
    })    
    </script>    
