@extends('layouts.back')

@section('content')
<main class="container bg-white py-3 my-3 shadow-sm rounded-2">
    <div class="row">
      <div class="col-10 mx-auto">
        <h1>Edit Product</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            <form action="{{ route('back.products.update', [$product->id]) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control
                 @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                 @error('name')
                 <span class="invalid-feedback">
                  {{ $message }}
                 </span>
                 @enderror
            </div>
            <div class="mb-3">
              <label for="summary" class="form-label">Summary</label>
              <textarea name="summary" id="summary" class="form-control editor
               @error('summary') is-invalid @enderror" required>{{ old('summary', $product->summary) }}</textarea>
               @error('summary')
               <span class="invalid-feedback">
                {{ $message }}
               </span>
               @enderror
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control editor
             @error('description') is-invalid @enderror" required>{{ old('description', $product->description) }}</textarea>
             @error('description')
             <span class="invalid-feedback">
              {{ $message }}
             </span>
             @enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" name="price" id="price" class="form-control
           @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
           @error('price')
           <span class="invalid-feedback">
            {{ $message }}
           </span>
           @enderror
      </div>
      <div class="mb-3">
        <label for="discounted_price" class="form-label">Discounted Price</label>
        <input type="number" name="discounted_price" id="discounted_price" class="form-control
         @error('discounted_price') is-invalid @enderror" value="{{ old('discounted_price', $product->discounted_price) }}">
         @error('discounted_price')
         <span class="invalid-feedback">
          {{ $message }}
         </span>
         @enderror
    </div>
    <div class="mb-3">
      <label for="pics" class="form-label">Images</label>
      <input type="file" name="pics[]" id="pics" class="form-control
       @error('pics') is-invalid @enderror" accept="image/*" multiple>
       @error('pics')
       <span class="invalid-feedback">
        {{ $message }}
       </span>
       @enderror
       <div class="row" id="img-container"></div>
       <div class="row">
        @foreach ($product->images as $image)
        <div class="col-3 mt-3 text-center">
            <img src="{{ url("public/images/{$image}") }}" class="img-fluid">
            <br>
            <a href="{{ route('back.products.image', [$product->id, $image]) }}" class="btn btn-danger btn-sm mt-3">
                <i class="fa-solid fa-times me-2"></i>Delete
            </a>
        </div>
        @endforeach
       </div>
  </div>
  <div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select name="category_id" id="category_id" class="form-select @error('status') is-invalid @enderror">
      @foreach ($categories as $category)
      <option value="{{$category->id}}" @selected(old('category_id', $product->category_id) == $category->id)>{{$category->name}}</option>
      @endforeach
    </select>
    @error('category_id')
           <span class="invalid-feedback">
            {{ $message }}
           </span>
           @enderror
  </div>
  <div class="mb-3">
    <label for="brand_id" class="form-label">Brand</label>
    <select name="brand_id" id="brand_id" class="form-select @error('status') is-invalid @enderror">
      @foreach ($brands as $brand)
      <option value="{{$brand->id}}" @selected(old('brand_id', $product->brand_id) == $brand->id)>{{$brand->name}}</option>
      @endforeach
    </select>
    @error('brand_id')
           <span class="invalid-feedback">
            {{ $message }}
           </span>
           @enderror
  </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Active" @selected(old('status', $product->status) == 'Active')>Active</option>
            <option value="Inactive" @selected(old('status', $product->status) == 'Inactive')>Inactive</option>
          </select>
          @error('status')
                 <span class="invalid-feedback">
                  {{ $message }}
                 </span>
                 @enderror
        </div>
        <div class="mb-3">
          <label for="featured" class="form-label">Featured</label>
          <select name="featured" id="featured" class="form-select @error('featured') is-invalid @enderror">
            <option value="No" @selected(old('featured', $product->featured) == 'No')>No</option>
            <option value="Yes" @selected(old('featured', $product->featured) == 'Yes')>Yes</option>
          </select>
          @error('featured')
                 <span class="invalid-feedback">
                  {{ $message }}
                 </span>
                 @enderror
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">
           <i class="fa-solid fa-save me-2"></i> Save
          </button>
        </div>
            </form>
        </div>
    </div>
  </main>
@endsection