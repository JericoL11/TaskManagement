import axios, { Axios } from "axios";
import { getToken } from "./auth-check";

$(document).ready(function() {
getToken();
 initDepartmentDatatable();


 $('#submit-department-btn').on('click', function (e) {
    e.preventDefault();


    //get from on show.modal
   const action = $(this).data('action');
   const dept_id = $(this).data('id') ?? 0;  
 
   console.log('action name : ' + action);

   const data = {
        'dept_name': $('#dept_name').val()
     };
        
   
    if(action === 'save'){
        AddDepartment(data);
    }
    else if(action === 'update'){
        UpdateDepartment(dept_id, data);
    }

 });

//modify modal
$('#modifydepartmentModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const dept_id = parseInt(button.data('deptid')) ?? 0; //get from datatable view btn
    const dept_name = button.data('deptname'); //get from datatable view btn
 
    // input fields and button
    const submitBtn = $('#submit-department-btn');
    const dept_name_Input = $('#dept_name');
    //adding button data based on ID
    if(dept_id === 0){
        submitBtn.text('Save');
        submitBtn.attr('data-action', 'save');
    }
    else{

        submitBtn.text('Update')
        submitBtn.attr('data-action', 'update');
        submitBtn.attr('data-id', dept_id);
        dept_name_Input.val(dept_name);
    }
    
});

    //resetter
    $('#modifydepartmentModal').on('hidden.bs.modal', function () {

        const $submitBtn = $('#submit-department-btn');
        
        // Remove attributes + jQuery cache
        $submitBtn.removeAttr('data-action').removeData('action');
        $submitBtn.removeAttr('data-id').removeData('id');
    });


});



function AddDepartment(data){
    axios.post("save/department/0", data)
    .then(response => {
        console.log(response);

        if(response.data.success){
            Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifydepartmentModal').modal('hide');
                $('#department-table').DataTable().ajax.reload();
        }
        else{
            Swal.fire({
                title: "Warning",
                text: `${response.data.message}`,
                icon: "info"
            })
        }

        
    })
     .catch(error => {
                   console.log(error);
                    Swal.fire({
                    title: "Error",
                    html: "Cannot connect to the server",
                    icon: "error"
                })
            });
}

function UpdateDepartment(id,data){
   axios.post(`save/department/${id}`, data)
   .then(response =>{

    console.log(response);
       if(response.data.success){
            Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifydepartmentModal').modal('hide');
                $('#department-table').DataTable().ajax.reload();
        }
        else{
            Swal.fire({
                title: "Warning",
                text: `${response.data.message}`,
                icon: "info"
            })
        }

        
    })
     .catch(error => {
                   console.log(error);
                    Swal.fire({
                    title: "Error",
                    html: "Cannot connect to the server",
                    icon: "error"
                })
            });
}


function initDepartmentDatatable() {

    $('#department-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: 'getDepartments',
            type: 'GET',
              beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            dataSrc: function (json) {
                console.log(json);
                return json.response;
            }
        },
        columns: [
            { data: 'dept_id', visible: false },
            { data: 'dept_name' }, // Display department name
            { data: 'employee_count'},
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return `
                        <button type="button"
                            class="btn btn-primary my-2"
                            data-bs-toggle="modal"
                            data-deptid="${row.dept_id}"
                            data-deptname="${row.dept_name}"
                            data-bs-target="#modifyDepartmentModal">
                            <i class="bi bi-pencil"></i> View
                        </button>
                    `;
                }
            }
        ],
        columnDefs: [
            { targets: [1, 2,3], className: 'text-center align-middle' }
        ]
    });
}
