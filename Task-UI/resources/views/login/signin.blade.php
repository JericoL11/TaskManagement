@extends('layout.app-login')

@section('content')


  <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-8 mt-5">
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
                <input type="password" class="form-control" id="password_signin" required>
              </div>

              <div class="d-grid mt-4">
                <button type="button" id="signIn-btn" class="btn btn-primary">Login</button>
              </div>
          
                <small class="text-center mt-2">or</small>

              <div class="d-flex justify-content-center mt-2">
              <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#verifyEmailModal">
                  forgot password?
              </button>

              </div>
             
              </div>
          
            </form>
          </div>
        </div>
@endsection<!-- Button trigger modal -->


{{-- send code --}}
<div class="modal fade" id="verifyEmailModal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" data-bs-backdrop="static" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Forgot Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="col-lg-12 col-md-6 col-sm-12">
            <label class="control-label">Email addresss</label>
            <input type="text" class="form-control" id="emailAddress" placeholder="Enter email address.."/>
          </div>
        </div>
      <div class="modal-footer">
        <button id="btn-forgotPass-email" class="btn btn-primary">Verify</button>
      </div>
    </div>
  </div>
</div>

{{-- reset password --}}
<div class="modal fade" id="resetPasswordModal" aria-hidden="true" data-bs-backdrop="static" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Change Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

         <input type="hidden" id="verifiedEmail"/>

          <div class="col-lg-12 col-md-6 col-sm-12">
            <label class="control-label">Code</label>
            <input type="text" class="form-control" id="code" placeholder="Enter email address.."/>
          </div>

           <div class="col-lg-12 col-md-6 col-sm-12">
            <label class="control-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter email address.."/>
          </div>

           <div class="col-lg-12 col-md-6 col-sm-12">
            <label class="control-label">Confirmed Password</label>
            <input type="password" class="form-control" id="password_confirmation" placeholder="Enter email address.."/>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="btn-forgotPass-newPass">Save Changes</button>
      </div>
    </div>
  </div>
</div>
