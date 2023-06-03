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

                        <!-- Include the search bar component for admin -->
                        <div class="">
                            <x-search-bar route="admin.search.users" placeholder="Search user ..." />
                        </div>

                        {{-- This is the dropdown on the upper right corner of the admin dash. --}}

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

                                <a class="dropdown-item" href="{{ route('manage') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('manage-form').submit();">
                                    {{ __('List of Products') }}
                                </a>

                                <form id="manage-form" action="{{ route('manage') }}" method="POST" class="d-none">
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

                   <strong class="card-title fs-6" style="font-family: Arial;">{{ __('List of Users') }}</strong> 
                    <table class="table mt-3">
                        @if (count($users) > 0)
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->status }}</td>

                                        {{-- This is to delete and deact users. --}}
                                        
                                        <td class="d-flex">
                                            <form action="{{ route('admin.users.delete', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger me-2">Delete</button>
                                            </form>
                                            @if ($user->status == 'active')
                                                <form action="{{ route('admin.users.deactivate', $user) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-warning me-2">Deactivate</button>
                                                </form>
                                            @else
                                            <form action="{{ route('admin.users.activate', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-success me-2">Activate</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @else 
                            <p class="text-center">No users found.</p>
                    
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
