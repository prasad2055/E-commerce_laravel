@extends('layouts.back')

@section('content')
<main class="container bg-white py-3 my-3 shadow-sm rounded-2">
    <div class="row">
      <div class="col-5 mx-auto">
        <h1>Add Category</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-5 mx-auto">
            <form action="{{ route('back.categories.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control
                 @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                 @error('name')
                 <span class="invalid-feedback">
                  {{ $message }}
                 </span>
                 @enderror
            </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Active" @selected(old('status') == 'Active')>Active</option>
            <option value="Inactive" @selected(old('status') == 'Inactive')>Inactive</option>
          </select>
          @error('status')
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