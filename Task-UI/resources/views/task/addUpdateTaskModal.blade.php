<!-- Modal -->
<div class="modal fade" id="modifyTaskModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-md">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Task Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="" method="POST" id="taskForm">
                @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Task</label>
                            <input type="text" id="name" class="form-control" placeholder="" value=""/>
                        </div>


                           <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Due Date</label>
                            <input type="date" id="dueDate" class="form-control" placeholder="" value=""/>
                        </div>
                    
                         <div class="col-lg-12 col-md-12 form-group">
                            <label class="control-label">Description</label>
                            <textarea type="text" id="description" class="form-control" placeholder="" value=""></textarea>
                        </div>

                        <div class="col-lg-6 col-md-12 form-group statusFormGroup">
                            <label class="control-label">Status</label>
                            <select id="status" class="form-control" style="width:100%">
                                <option value="" selected> Select Status</option>
                                <option value="Pending"> Pending</option>
                                <option value="Complete"> Complete</option>
                            </select>

                        </div>

                        <div class="col-lg-6 col-md-12 form-group">
                            <label class="control-label">Assigned employee</label>
                            <select id="employeeid" class="form-control" style="width: 100%">
                             {{-- display via jquery --}}
                            </select>
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <button type="button" id="del-btn-task" data-action="delete" class="btn btn-danger action-btn-task">Delete</button>
        <button type="button" id="submit-btn-task" class="btn btn-primary action-btn-task"></button>
      </div>
    </div>
  </div>
</div>