@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <div class="container d-flex justify-content-between align-items-center p-0">
                        <div class="card-title mt-2 p-0">
                            {{ __('Favorites') }}
                        </div> 

                        <div class="">
                            <x-search-bar route="favorites" placeholder="Search product ..." />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table mt-3">

                        @if (count($favorites) > 0)

                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col" style="width: 7rem">Unit Price</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                        
                            <tbody>
                        
                                @foreach($favorites as $item)
                                <tr onclick="window.location='/product/{{$item->product->id}}';" style="cursor: pointer;">
                                    <td><img src="{{ $item->image_url ? asset('storage/'.$item->image_url) : asset('storage/images/logo.jpg') }}" alt="Picture" class="img-fluid rounded-1 d-flex justify-content-center align-items-center" style="width: 2rem; height: auto; object-fit: contain; aspect-ratio: 3/2"></td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->product->unit_price }}</td>
                                    <td>
                                        <a href="{{ route('favorites.toggle', ['item' => $item->product_id]) }}" class="btn mt-n2 ms-3 p-0">
                                            <i class="bi bi-suit-heart-fill mt-n2" style="font-size: .8em"></i>
                                        </a>
                                    </td>
                                    
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        @else 
                            <p class="text-center">No favorites.</p>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
