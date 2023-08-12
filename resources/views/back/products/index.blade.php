@extends('layouts.back')

@section('content')
<main class="container bg-white py-3 my-3 shadow-sm rounded-2">
    <div class="row">
      <div class="col">
        <h1>Products</h1>
      </div>
      <div class="col-auto">
        <a href="{{ route('back.products.create') }}" class="btn btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Product
      </a>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        @if($products->isNotEmpty())
            <table class="table table-striped table-hover table-bordered table-sm">
              <thead class="table-dark">
                <tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Featured</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ $product->brand->name }}</td>
                      <td><img src="{{ url("public/images/{$product->thumbnail}") }}" class="img-small"></td>
                      <td>
                        @empty($product->discounted_price)
                        Rs. {{ number_format($product->price) }}
                        @else
                        Rs. {{ number_format($product->discounted_price) }}
                        <br>
                        <small class="text-muted text-decoration-line-through">Rs. {{ number_format($product->price) }}</small>
                        @endempty
                      </td>
                      <td>{{ $product->status }}</td>
                      <td>{{ $product->featured }}</td>
                      <td>{{ $product->created_at->format('j M Y h:i A') }}</td>
                      <td>{{ $product->updated_at->format('j M Y h:i A') }}</td>
                      <td>
                        <form method="post" action="{{ route('back.products.destroy', [$product->id]) }}">
                          @method('DELETE')
                          @CSRF
                        <a href="{{ route('back.products.edit', [$product->id]) }}" class="btn btn-primary btn-sm me-2" title="Edit">
                        <i class="fa-solid fa-edit"></i>
                        </a>
                        <button type="submit" class="btn btn-danger btn-sm delete" title="Delete">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            {{ $products->links() }}
            @else
                <h4 class="text-muted fst-italic">No data found.</h4>
        @endif
      </div>
    </div>
  </main>
@endsection