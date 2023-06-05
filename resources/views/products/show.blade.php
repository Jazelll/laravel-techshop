@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center m-5">
    <div class="card border-0" style="max-width: 1700px; width: 70%;">
        <div class="row g-0">

            <div class="col-md-7 border-end p-3">
                <img src="{{ $item->image_url ? asset('storage/'.$item->image_url) : asset('storage/images/logo.jpg') }}" alt="Picture" class="img-fluid rounded-start d-flex justify-content-center align-items-center" style="max-width: 100%; height: auto; object-fit: contain;">
            </div>

            <div class="col-md-5 d-flex flex-column justify-content-center align-items-start m-0">
                <div class="card-header d-flex align-items-center justify-content-between mt-2 bg-white" style="height: 5em; width:100%">
                    <h3 class="card-title text-center mb-0"><strong>{{ $item->product_name }}</strong></h3>

                    <form action="{{ route('favorites.toggle', ['item' => $item->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn">
                                @if($isLiked)
                                    <i class="bi bi-suit-heart-fill" style="font-size: 1.7em"></i>
                                @else
                                    <i class="bi bi-suit-heart" style="font-size: 1.7em"></i>
                                @endif
                        </button>
                    </form>
                    
                </div>

                <div class="card-body p-3">
                    <h5 class="card-title"><strong>{{$item->unit_price}}</strong></h5>
                    <p class="card-text"><strong class="text-body-secondary">{{ucfirst($item->category)}}</strong></p>
                    <p class="card-text">{{$item->description}}</p>
                    <span id="availableQty"> Available: {{$item->availableQty}}</span>
                    <input type="hidden" id="availableQuantity" value="{{$item->availableQty}}">
                </div>

                @if (Auth::user()->role != 'admin')
                <div style="height: 5em; width: 100%">
                    <form action="{{ route('cart.store', ['item' => $item->id]) }}" method="POST" class="card-footer d-flex align-items-center justify-content-between bg-white">
                        @csrf
                        <div class="quantity">
                            <div class="quantity-content">
                                <span class="minus">-</span>
                                <input type="text" name="quantity" value="1" class="quantity">
                                <span class="plus">+</span>
                            </div>
                        </div>
                    
                        <button type="submit" class="btn" style="border-color: #bcbcbc;">
                            <i class="bi bi-cart3"></i>
                            @if($onCart)
                                Remove from Cart
                            @else
                                Add To Cart
                            @endif
                        </button>
                    </form>
                    
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

<style>
.quantity-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    border: 1px solid #ccc;
    border-radius: 3px;
    width: 8rem;
}

.quantity {
    width: 30px;
    text-align: center;
    border: none;
}

.minus,
.plus {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background-color: #e3e3e3;
    border: 1px solid #ccc;
    cursor: pointer;
}

.minus:hover,
.plus:hover {
    background-color: #232ba2;
}

.minus:active,
.plus:active {
    background-color: #c3c3c3;
}


</style>

<script>
    const availableQuantity = document.getElementById("availableQuantity").value;
    const plusButton = document.querySelector('.quantity-content .plus');
    const minusButton = document.querySelector('.quantity-content .minus');
    const quantity = document.querySelector('.quantity-content .quantity');

    plusButton.addEventListener('click', () =>{
        const currentQuantity = parseInt(quantity.value, 10);
        if (currentQuantity == availableQuantity) {
            plusButton.disabled = true;
        } else {
            quantity.value = currentQuantity + 1;
        }
    });

    minusButton.addEventListener('click', () =>{
        const currentQuantity = parseInt(quantity.value, 10);
        if (currentQuantity > 1) {
            quantity.value = currentQuantity - 1;
        }
        if (currentQuantity === 1) {
            minusButton.disabled = true;
        }
    });
</script>
@endsection
