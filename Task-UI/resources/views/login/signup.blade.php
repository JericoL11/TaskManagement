@extends('layout.app-login')

@section('content')

  <div class="row justify-content-center">
      <div class="col-md-6">

        <div class="card shadow-md border-0">
          <div class="card-body">
            <form id="registerForm">

                 <div class="text-center mb-2">
                    <p class="text-center fw-bold fs-2">Sign-in</p>
                    <small class="fw-bold">VFI TASK MANAGEMENT</small>
                </div>
               
                <div class="row">
          
                 <div class="col-md-6 col-sm-12">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
              </div>

                 <div class="col-md-6 col-sm-12">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
              </div>

                 <div class="col-md-6 col-sm-12">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middleName" name="middleName">
              </div>

                 <div class="col-md-6 col-sm-12">
                <label class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birthDate" name="birthDate" required>
              </div>

            <div class="col-md-6 col-sm-12">
                <label class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contactNo" name="contactNo" required>
              </div>

                 <div class="col-md-12 col-sm-12">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
              </div>

                <div class="col-md-12 col-sm-12">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>

              <div class="col-md-12 col-sm-12">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

                <div class="col-md-12 col-sm-12">
                <label class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
              </div>

              <div class="d-grid mt-4">
                <button type="button" id="btn-register" class="btn btn-primary">Register</button>
              </div>
                </div>
             
            </form>
          </div>
        </div>
@endsection