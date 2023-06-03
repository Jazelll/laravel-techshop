@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex flex-row">
                    <div class="container d-flex justify-content-between align-items-center p-0">
                        <div class="card-title mt-2 p-0">
                            {{ __('Admin Dashboard') }}
                        </div> 

                        <div class="">
                            <x-search-bar route="manage" placeholder="Search product ..." />
                        </div>

                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{"Manage"}}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('create') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('create-form').submit();">
                                    {{ __('Create Product') }}
                                </a>

                                <form id="create-form" action="{{ route('create') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('dashboard-form').submit();">
                                    {{ __('List of Users') }}
                                </a>

                                <form id="dashboard-form" action="{{ route('admin.dashboard') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <strong class="card-title fs-6" style="font-family: Arial;">{{ __('List of Products') }}</strong> 
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col" style="width: 7rem">Unit Price</th>
                                <th scope="col">Category</th> 
                                <th scope="col">Description</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                    
                    @php
                    $counter = 0;
                    @endphp
                    
                    @foreach($products as $item)
                    
                    <tr>
                        <td>{{++$counter}}</td>
                        <td>{{ $item-> product_name }}</td> 
                        <td>{{ $item-> unit_price }}</td>
                        <td>{{ $item-> category }}</td> 
                        <td>{{ $item-> description }}</td> 
                        <td>
                            <div class="container d-flex p-2 justify-content-around" style="width: 8rem">
                                <a href="/product/{{$item->id}}"><i class="bi bi-eye"></i></a>
                                <a href="/products/edit/{{ $item->id }}"><i class="bi bi-pencil"></i></a>
                                <a href="/products/delete/{{ $item->id }}"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr> 
                                       
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection