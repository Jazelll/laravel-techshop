@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <div class="container d-flex justify-content-between align-items-center p-0">
                        <div class="card-title mt-2 p-0">
                            {{ __('My Cart') }}
                        </div> 

                        <div class="">
                            <x-search-bar route="favorites" placeholder="Search product ..." />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table mt-3">

                        @if (count($carts) > 0)

                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Ordered Qty</th>
                                    <th scope="col" style="width: 7rem">Unit Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        
                            <tbody>
                        
                                @foreach($carts as $item)
                                    <!-- Update the table row -->
                                    <tr>
                                        <td><img src="{{ $item->product->image_url ? asset('storage/'.$item->product->image_url) : asset('storage/images/logo.jpg') }}" alt="Picture" class="img-fluid rounded-1 d-flex justify-content-center align-items-center" style="width: 2rem; height: auto; object-fit: contain; aspect-ratio: 3/2"></td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->quantity }}</td> <!-- Display the quantity -->
                                        <td>Php {{ $item->product->unit_price }}.00</td>
                                        <td>
                                            <!-- Update the form action and method -->
                                            <form action="{{ route('cart.remove', ['item' => $item->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE') <!-- Add this line to specify the DELETE method -->
                                                <button type="submit" class="btn mt-n2 ms-3 p-0" onclick="return confirm('Are you sure you want to remove this item from the cart?')">
                                                    <i class="bi bi-trash" style="font-size: .8em"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- @foreach($carts as $item)
                                <!-- Update the table row -->
                                    <tr>
                                        <td><img src="{{ $item->product->image_url ? asset('storage/'.$item->product->image_url) : asset('storage/images/logo.jpg') }}" alt="Picture" class="img-fluid rounded-1 d-flex justify-content-center align-items-center" style="width: 2rem; height: auto; object-fit: contain; aspect-ratio: 3/2"></td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Php {{ $item->product->unit_price }}.00</td>
                                        <td>
                                            <!-- Update the form action and method -->
                                            <form action="{{ route('cart.remove', ['item' => $item->id]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE') <!-- Add this line to specify the DELETE method -->
                                                <button type="submit" class="btn mt-n2 ms-3 p-0" onclick="return confirm('Are you sure you want to remove this item from the cart?')">
                                                    <i class="bi bi-trash" style="font-size: .8em"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach --}}
                            </tbody>
                        @else 
                            <p class="text-center">No items in your cart.</p>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
