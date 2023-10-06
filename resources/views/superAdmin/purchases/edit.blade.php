
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Sales</h3>
    </div>
    <!-- /.card-header -->
    <form action="/admin/purchases/update" method="POST" enctype="multipart/form-data" id="frmSales">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id" placeholder="Id" value="{{$data->id}}">
            </div>
            <div class="form-group">
                <label>Number</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Number" value="{{$data->number}}">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" id="date" name="date" placeholder="date" value="{{$data->date}}">
            </div>
            <div class="form-group">
                <label>Purchases Name</label>
                <select class="form-control select3" id="myselect" name="user_id">
                    <option></option>
                    @foreach ($userPurchases as $item)
                        <option value="{{$item->id}}" {{($item->id == $data->user_id) ? 'selected' : ''}} >{{$item->name}}</option>
                    @endforeach
                  </select>
            </div>
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
