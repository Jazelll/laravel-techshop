@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center flex-wrap w-100">

    
    <div class="mb-3">
        <x-search-bar route="search" placeholder="Search product..." />
    </div>

    <div class="container d-flex justify-content-center flex-wrap w-100">
    @if (count($products) > 0)
        @foreach ($products as $item)
            <a href="/product/{{$item->id}}">
                
                <div class="card m-1 mb-3 p-2" style="width: 15rem; height: 25rem">
                    <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                        <img src="{{ $item->image_url ? asset('storage/'.$item->image_url) : asset('storage/images/logo.jpg') }}" alt="Picture" class="card-img-top" style="max-height: 100%; max-width: 100%">
                    </div>
                    <div class="card-body flex-column justify-content-start align-items-left">
                        <div class="card-title category-container {{
                            $item->category === 'monitor' ? 'monitor' :
                            ($item->category === 'accessories' ? 'accessories' :
                            ($item->category === 'others' ? 'others' :
                            ($item->category === 'mouse' ? 'mouse' :
                            ($item->category === 'keyboard' ? 'keyboard' : ''))))
                             }}">
                            <span class="tag">{{ $item->category }}</span>
                        </div>
                        <h5 class="card-title" style="height: 5rem">{{ $item->product_name }}</h5>
                        <h6 class="card-title" style="color:blue">{{ $item->unit_price }}</h6>
                    </div>
                </div>
                
            </a>
        @endforeach
    @endif
</div>
</div>

@endsection
