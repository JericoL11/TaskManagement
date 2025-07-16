

<!-- Modal -->
<div class="modal fade" id="modifyEmployeeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Personal Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="POST" id="employeeForm">
                @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" placeholder="" value=""/>
                        </div>

                         <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Middle Name</label>
                            <input type="text" id="middleName"  name="middleName" class="form-control" placeholder="" value=""/>
                        </div>
                    
                         <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Last Name</label>
                            <input type="text" id="lastName"  name="lastName" class="form-control" placeholder="" value=""/>
                        </div>

                        <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Birth date</label>
                            <input type="date" id="birthDate" class="form-control" placeholder="" value=""/>
                            <input type="hidden" id="birthDateHidden"  class="form-control" placeholder="" value=""/>
                        </div>

                          <div class="col-12 form-group">
                            <label class="control-label">Home Address</label>
                            <input type="text" id="address"  name="address" class="form-control" placeholder="" value=""/>
                        </div>
                        
                         <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Contact #</label>
                            <input type="text" id="contactNo" name="contactNo"  class="form-control" placeholder="" value=""/>
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" id="del-btn-employee" data-action="delete" class="btn btn-danger action-btn">Delete</button>
        <button type="button" id="submit-btn" class="btn btn-primary action-btn"></button>
      </div>
    </div>
  </div>
</div>