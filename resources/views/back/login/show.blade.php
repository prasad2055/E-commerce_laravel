@extends('layouts.back')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto bg-white py-3 my-5 shadow-sm">
                <div class="col-12 text-center">
                    <h1>Login</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('back.login.login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-lable">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-sign-in me-2"></i>Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection