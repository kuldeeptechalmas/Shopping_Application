<form action="/updateorderadmin" method="post" style="padding:10px 20px;">

    @csrf

    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" value="{{$order->name}}" readonly class="form-control">
        <input type="text" value="{{$order->id}}" name="orderid" readonly class="form-control" hidden>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" value="{{$order->email}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" value="{{$order->phone}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" value="{{$order->product->name}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="text" value="{{$order->product->price}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Order Date</label>
        <input type="date" value="{{$order->order_date}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Delivered Data</label>
        <input type="date" value="{{$order->delivery_date}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status" aria-label="Default select example">
            <option value="Pending" {{$order->status == "Pending" ? 'selected' : ''}}>Pending</option>
            <option value="Processing" {{$order->status == "Processing" ? 'selected' : ''}}>Processing</option>
            <option value="Shipped" {{$order->status == "Shipped" ? 'selected' : ''}}>Shipped</option>
            <option value="Delivered" {{$order->status == "Delivered" ? 'selected' : ''}}>Delivered</option>
        </select>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>