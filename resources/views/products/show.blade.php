@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center align-items-center m-5">
    <div class="card border border-0" style="max-width: 1700px; width: 70%;">
        <div class="row g-0">
            <div class="col-md-5 border-end">
                <img src="{{ $item->image_url ? asset('storage/'.$item->image_url) : asset('storage/images/logo.jpg') }}" alt="Picture" class="img-fluid rounded-start d-flex justify-content-center align-items-center" style="max-width: 100%; height: auto; object-fit: contain;">
            </div>
            <div class="col-md-7 d-flex justify-content-center align-items-start mt-5">
                <div class="card-body p-3">
                    <h1 class="card-title text-center">{{$item -> product_name}}</h1>
                    <h4 class="card-title"><strong>{{$item -> unit_price}}</strong></h4>
                    <p class="card-text">{{$item -> description}}</p>
                    <p class="card-text">Category: <strong class="text-body-secondary">{{$item -> category}}</strong></p>
                </div>
                {{-- <div class="btn btn-primary">
                    <p>ADDDDDDDDDDDDD</p>
                </div>   --}}
            </div>
        </div>
    </div>
</div>

@endsection

