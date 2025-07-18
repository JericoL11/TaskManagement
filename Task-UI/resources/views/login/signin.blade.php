@extends('layout.app-login')

@section('content')


  <div class="row justify-content-center mt-5">
      <div class="col-md-4 mt-5">
        <div class="card shadow-md border-2">
          <div class="card-body">
            <form id="registerForm">
                <div class="text-center">
                <p class="text-center fw-bold fs-2">Sign-in</p>
                <small class="fw-bold">VFI TASK MANAGEMENT</small>
                </div>
               
            <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" id="username" required>
              </div>

            <div class="col-md-12 col-sm-12">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" id="password" required>
              </div>

              <div class="d-grid mt-4">
                <button type="submit" id="signIn-btn" class="btn btn-primary">Login</button>
              </div>
                </div>
            </form>
          </div>
        </div>
@endsection