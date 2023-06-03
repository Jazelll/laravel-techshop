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

                      <div class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{"Manage"}}
                          </a>

                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('dashboard-form').submit();">
                                  {{ __('List of Users') }}
                              </a>

                              <form id="dashboard-form" action="{{ route('admin.dashboard') }}" method="POST" class="d-none">
                                  @csrf
                              </form>

                              <a class="dropdown-item" href="{{ route('manage') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('manage-form').submit();">
                                  {{ __('Manage Products') }}
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

                 <strong class="card-title fs-6" style="font-family: Arial;">{{ __('Create Products') }}</strong> 
                 <form action="/product" method="POST" class="container-md d-flex flex-column" enctype="multipart/form-data">
                  
                  {{-- include --}}
                  @csrf
                
                  <div class="mb-3 row">
                      <label for="product_name" class="col-sm-2 col-form-label">Product Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="product_name" class="form-control" value = {{ old('product_name') }}>
                        @error("product_name")
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                      </div>
                  </div>
                
                  <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea type="text" name="description" class="form-control">{{ old('description') }}</textarea>
                        @error("description")
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                      </div>
                  </div>
                
                  <div class="mb-3 row">
                    <label for="unit_price" class="col-sm-2 col-form-label">Unit Price</label>
                    <div class="col-sm-10">
                      <input type="text" name="unit_price" class="form-control" value = {{ old('unit_price') }}>
                      @error("unit_price")
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>
                
                  <div class="mb-3 row">
                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select name="category" class="form-control">
                            <option value="" selected disabled hidden>Choose here</option>
                            <option value="monitor" {{ old('category') == 'monitor' ? 'selected' : '' }}>Monitor</option>
                            <option value="keyboard" {{ old('category') == 'keyboard' ? 'selected' : '' }}>Keyboard</option>
                            <option value="mouse" {{ old('category') == 'mouse' ? 'selected' : '' }}>Mouse</option>
                            <option value="case" {{ old('category') == 'case' ? 'selected' : '' }}>Computer PC Case</option>
                            <option value="power Supply PSU" {{ old('category') == 'psu' ? 'selected' : '' }}>Power Supply PSU</option>
                            <option value="accessories" {{ old('category') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="others" {{ old('category') == 'others' ? 'selected' : '' }}>Others</option>
                        </select>
                        @error('category')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                  </div>
                
                  <div class="mb-3 row">
                    <label for="image_url" class="col-sm-2 col-form-label">Image Url</label>
                    <div class="col-sm-10">
                      <input type="file" name="image_url" class="form-control" value = {{ old('image_url') }}>
                      @error("image_url")
                          <p class="text-danger">{{$message}}</p>
                      @enderror
                    </div>
                  </div>  
                
                  <button type="submit" class="btn btn-success">Save</button>
                </form>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

