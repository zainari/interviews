@extends('layout_frontent.app')

@section('title', 'My Cart')

@section('content')

<h2>Your Cart</h2>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if (!$cart)
    <p>Your cart is empty.</p>
@else
    <table border="1" cellpadding="10">
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th></th>
        </tr>

        @php $grandTotal = 0; @endphp

        @foreach ($cart as $id => $item)
            @php $total = $item['price'] * $item['quantity']; @endphp

            <tr>
                <td>
                    <img src="{{ asset('storage/' . $item['image']) }}" width="60">
                </td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>${{ $total }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button type="submit" style="color:red;">Remove</button>
                    </form>
                </td>
            </tr>

            @php $grandTotal += $total; @endphp
        @endforeach

        <tr>
            <td colspan="4">Grand Total</td>
            <td>${{ $grandTotal }}</td>
        </tr>

    </table>
@endif

@endsection
