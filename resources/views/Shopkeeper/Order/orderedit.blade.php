@extends('Shopkeeper.index')

@section('content')
<div class="d-flex justify-content-center" style="height: 62px;text-align: center;margin-top: 16px;">
    <h3 style="width: 225px;border: solid;border-radius: 27px;align-items: center;display: flex;justify-content: center;">
        View Order</h3>
</div>
<form action="{{ route('shopkeeper.Order.List') }}" method="post" style="padding: 10px 169px;">

    @csrf
    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" value="{{$orderData->name}}" readonly class="form-control">
        <input type="text" value="{{$orderData->id}}" name="id" readonly class="form-control" hidden>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="text" value="{{$orderData->email}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" value="{{$orderData->phone}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" value="{{$orderData->product->name}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="text" value="{{$orderData->product->price}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">orderData Date</label>
        {{-- <input type="date" value="{{$orderData->orderData_date}}" readonly class="form-control"> --}}
        <input type="date" value="{{$orderData->order_date}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Delivered Data</label>
        <input type="date" value="{{$orderData->delivery_date}}" readonly class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status" aria-label="Default select example">
            <option value="">Select</option>
            <option value="Pending" {{$orderData->status == "Pending" ? 'selected' : ''}}>Pending</option>
            <option value="Processing" {{$orderData->status == "Processing" ? 'selected' : ''}}>Processing</option>
            <option value="Shipping" {{$orderData->status == "Shipping" ? 'selected' : ''}}>Shipping</option>
            <option value="Delivered" {{$orderData->status == "Delivered" ? 'selected' : ''}}>Delivered</option>
        </select>

        @if (isset($validator))
        @if (isset($validator->errors()->messages()['status'][0]))
        <div class="alert alert-danger">{{ $validator->errors()->messages()['status'][0] }}</div>
        @endif
        @endif
    </div>

    <div class="modal-footer" style="padding: 10px 20px 29px;">
        <a href="{{ route('shopkeeper.Order.List') }}">
            <button type="button" class="btn btn-secondary" style="margin-right: 32px;">back</button>
        </a>

        <input type="text" name="action" value="editOrder" hidden>
        <button type="submit" class="btn btn-primary">Save chang</button>
    </div>

    @if (isset($your_field))
    {{ $your_field }}
    @endif
</form>
@endsection
