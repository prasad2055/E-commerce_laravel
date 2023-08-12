@extends('layouts.back')

@section('content')
<main class="container bg-white py-3 my-3 shadow-sm rounded-2">
    <div class="row">
      <div class="col">
        <h1>Brands</h1>
      </div>
      <div class="col-auto">
        <a href="{{ route('back.brands.create') }}" class="btn btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Brand
      </a>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        @if($brands->isNotEmpty())
            <table class="table table-striped table-hover table-bordered table-sm">
              <thead class="table-dark">
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($brands as $brand)
                    <tr>
                      <td>{{ $brand->name }}</td>
                      <td>{{ $brand->status }}</td>
                      <td>{{ $brand->created_at->format('j M Y h:i A') }}</td>
                      <td>{{ $brand->updated_at->format('j M Y h:i A') }}</td>
                      <td>
                        <form method="post" action="{{ route('back.brands.destroy', [$brand->id]) }}">
                          @method('DELETE')
                          @CSRF
                        <a href="{{ route('back.brands.edit', [$brand->id]) }}" class="btn btn-primary btn-sm me-2" title="Edit">
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
            {{ $brands->links() }}
            @else
                <h4 class="text-muted fst-italic">No data found.</h4>
        @endif
      </div>
    </div>
  </main>
@endsection