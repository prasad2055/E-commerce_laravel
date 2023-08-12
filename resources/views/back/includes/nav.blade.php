<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @if(auth('cms')->user()->type == 'Admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('back.staffs.index') }}"><i class="fa-solid fa-users me-2"></i>Staffs</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('back.categories.index') }}"><i class="fa-solid fa-list me-2"></i>Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('back.brands.index') }}"><i class="fa-solid fa fa-star me-2"></i>Brands</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('back.products.index') }}"><i class="fa-solid fa fa-gifts me-2"></i>Products</a>
          </li>
        </ul>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-circle me-2"></i>{{ auth('cms')->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('back.profile.edit') }}"><i class="fa-solid fa-user-edit me-2"></i>Edit Profile</a></li>
              <li><a class="dropdown-item" href="{{ route('back.password.edit') }}"><i class="fa-solid fa-asterisk me-2"></i>Change Password</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="{{ route('back.logout') }}" method="post">
                @csrf
                <button class="btn btn-link rounded-0 dropdown-item" type="submit"><i class="fa-solid fa-sign-out me-2"></i>Logout
                </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>