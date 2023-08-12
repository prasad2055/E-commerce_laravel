@extends('layouts.back')

@section('content')
<main class="container bg-white py-3 my-3 shadow-sm rounded-2">
    <div class="row">
      <div class="col">
        <h1>Staffs</h1>
      </div>
      <div class="col-auto">
        <a href="{{ route('back.staffs.create') }}" class="btn btn btn-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Staff
      </a>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        @if($staffs->isNotEmpty())
            <table class="table table-striped table-hover table-bordered table-sm">
              <thead class="table-dark">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Status</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($staffs as $staff)
                    <tr>
                      <td>{{ $staff->name }}</td>
                      <td>{{ $staff->email }}</td>
                      <td>{{ $staff->phone }}</td>
                      <td>{{ $staff->address }}</td>
                      <td>{{ $staff->status }}</td>
                      <td>{{ $staff->created_at->format('j M Y h:i A') }}</td>
                      <td>{{ $staff->updated_at->format('j M Y h:i A') }}</td>
                      <td>
                        <form method="post" action="{{ route('back.staffs.destroy', [$staff->id]) }}">
                          @method('DELETE')
                          @CSRF
                        <a href="{{ route('back.staffs.edit', [$staff->id]) }}" class="btn btn-primary btn-sm me-2" title="Edit">
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
            {{ $staffs->links() }}
            @else
                <h4 class="text-muted fst-italic">No data found.</h4>
        @endif
      </div>
    </div>
  </main>
@endsection