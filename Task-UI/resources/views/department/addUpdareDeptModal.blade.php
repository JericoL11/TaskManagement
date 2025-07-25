<!-- Modal -->
<div class="modal fade" id="modifydepartmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Department Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="POST" id="departmentForm">
                @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label class="control-label">Department Name</label>
                            <input type="text" id="dept_name" class="form-control" placeholder="" value=""/>
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         {{-- <button type="button" id="del-btn-task" data-action="delete" class="btn btn-danger action-btn-task">Delete</button> --}}
        <button type="button" id="submit-department-btn" class="btn btn-primary"></button>
      </div>
    </div>
  </div>
</div>