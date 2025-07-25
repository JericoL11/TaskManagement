import { getDateOnly, setMaxToday, attachLongDateFormatter,  resetFormattedDateInput} from './dates';
import {numericInput, disableManualDatetimeInput} from './custom';
import { getToken } from './auth-check';
import axios from 'axios';

$(document).ready(function() {

getToken(); 
disableManualDatetimeInput('#birthDate');
setMaxToday('#birthDate');
numericInput('#contactNo');
initEmployersDatatable();

    $('.action-btn').on('click', function (e){

        e.preventDefault();

        const action = $(this).data('action');
        const empid = parseInt($(this).data('empid')) || 0;

        console.log(empid);
        //array of data
       const data = 
       {
            firstName: $('#firstName').val(),
            middleName: $('#middleName').val(),
            lastName: $('#lastName').val(),
            birthDate: $('#birthDateHidden').val(),
            address: $('#address').val(),
            contactNo: $('#contactNo').val(),
            user_id: $('#userid').val(),
            dept_id: $('#department_lookup').val()
       };
            

        if(empid === 0){
            addEmployee(data);
        }

        else if( action === 'update'){
             console.log(empid);
            updateEmployee(empid,data);
        }
       
        else if( action === 'delete'){
            deleteEmployee(empid);
        }
    });


    
//modify modal
$('#modifyEmployeeModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const emp_id = parseInt(button.data('empid')) || 0;
    const firstName = button.data('firstname');
    const middleName = button.data('middlename');
    const lastName = button.data('lastname');
    const address = button.data('address');
    const contactNo = button.data('contactno');
    const birthDate = button.data('birthdate');
    const dept_id = button.data('deptid');
    const dept_name = button.data('deptname');
    

    const submitBtn = $('#submit-btn'); //action btn
    const deleteBtn = $('#del-btn-employee');


//department selec2
const $selectDepartment = $('#department_lookup');
    if (!$selectDepartment.hasClass('select2-initialized')) {
        $selectDepartment.select2({
            dropdownParent: $('#modifyEmployeeModal'),
            placeholder: 'Select department',
            allowClear: true,
            minimumResultsForSearch: 0,
            ajax: {
                url: 'getAllDepartments',
                dataType: 'json',
                delay: 250,
                  headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
                        'Accept': 'application/json'
                    },
                data: function (params) {

                    return {
                        key: params.term || '' // 👈 send the search key to controller
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.response.map(dept => ({
                            id: dept.dept_id,
                          text: `${dept.dept_name}`

                        }))
                    };
                },
                cache: true
            }
        }).addClass('select2-initialized');
    }



    // Set selected department manually (pre-selected) / EDIT purposes
    if (dept_id && dept_name) {
        const selectedOption = new Option(dept_name, dept_id, true, true);
        $selectDepartment.append(selectedOption).trigger('change');
    } else {
        $selectDepartment.val(null).trigger('change');
    }

    //add a userID to an input field
    getUserId();

    
    resetFormattedDateInput('#birthDate', '#birthDateHidden');
    console.log(button.data())

 if (emp_id === 0) {
        $('#del-btn-employee').hide();
        submitBtn.text('Save');
        submitBtn.attr('data-action', 'save');
        submitBtn.attr('data-id', `${emp_id}`);
        attachLongDateFormatter('#birthDate', '#birthDateHidden');

    } else {
        //mapping / assigning inmput fields 
        $('#firstName').val(firstName);
        $('#middleName').val(middleName);
        $('#lastName').val(lastName);
        $('#birthDate').val(getDateOnly(birthDate));
        $('#address').val(address);
        $('#contactNo').val(contactNo);


        attachLongDateFormatter('#birthDate', '#birthDateHidden');

        $('#del-btn-employee').show();
        submitBtn.text('Update');
        submitBtn.attr('data-action', 'update');
        submitBtn.attr('data-empid', `${emp_id}`);
        deleteBtn.attr('data-empid', `${emp_id}`);
        
    }
});

//resetter
    $('#modifyEmployeeModal').on('hidden.bs.modal', function () {
        $('#employeeForm')[0].reset();
        $('#submit-btn').attr('data-action', ''); 
        $('#birthDateHidden').val('');
        $('#del-btn-employee').removeAttr('data-empid').removeData('empid');
    });

});


function getUserId(){
    axios.get('getUserId')
    .then(response => {
        $('#userid').val(response.data.user_id);
    })
    .catch(error => {
        console.log(error);
    })
}


 function deleteEmployee(empid){

        axios.delete(`employee/${empid}`)
        .then(response => {

            console.log(response)
           if(response.data.success){
                Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifyEmployeeModal').modal('hide');
                $('#employers-table').DataTable().ajax.reload();
            }
            else{

          
                Swal.fire({
                    title: "Error",
                    text: `${response.data.message}`,
                    icon: "info"
                })
            }
        });
    }

    function addEmployee(data){
        axios.post(`/save/employee/0`, data)
        .then(response => {

            console.log(response);
            if(response.data.success){
                Swal.fire({
                    title: `${response.data.message}`,
                    icon: "success"
                });


                $('#modifyEmployeeModal').modal('hide');
                $('#employers-table').DataTable().ajax.reload();
            }
            else{
                const errorMsg = Array.isArray(response.data.error)
                ? response.data.error.join('<br>')
                : response.data.message || "Uknown error";

                Swal.fire({
                    title: "Error",
                    html: errorMsg,
                    icon: "info"
                })
            }
        });
    }

    function updateEmployee(id,data){
  
        axios.post(`/save/employee/${id}`, data)
        
            .then(response => {

            console.log('Payload response:', response.data);   
              
            if (response.data.success) {
                Swal.fire({
                    title: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifyEmployeeModal').modal('hide');
                $('#employers-table').DataTable().ajax.reload();

            } else {
                const errorMsg = Array.isArray(response.data.error)
                    ? response.data.error.join('<br>')
                    : response.data.message || "Unknown error";

                Swal.fire({
                    title: "Error",
                    html: errorMsg,
                    icon: "info"
                });
            }


        })
      .catch(err => {
            console.error("Error response", err);

            const errorArray = err.response?.data?.error || ['Unexpected error occurred.'];
            const errorMsg = Array.isArray(errorArray) ? errorArray.join('<br>') : errorArray;

            Swal.fire({
                title: "Error",
                html: errorMsg,
                icon: "error"
            });
        });

    }


function initEmployersDatatable(){


    // const token = localStorage.getItem('auth_token');

     $('#employers-table').DataTable({
        processing: true,
        serverSide: false, // set to true only if backend supports pagination
        ajax: {
            url: 'getAllEmployers',
             type: 'GET',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            dataSrc: function (json) {

                console.log(json.response);
                return json.response; // assumes your API returns { success, response: [...] }
            },
        },
        columns: [
            { data: 'emp_id', visible: false }, // hidden ID
            { data: null,  //full name
                
            render: function (data, type, row) {
                return `${row.firstName} ${row.middleName ? row.middleName + ' ' : ''}${row.lastName}`;
                } 
            },
            { data: 'address' }, 
            { data: 'contactNo' }, 
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return `
              <button type="button"
                class="btn btn-primary my-2" 
                data-bs-toggle="modal" 
                data-firstname="${row.firstName}"
                data-middlename="${row.middleName}"
                data-lastname="${row.lastName}"
                data-address="${row.address}"
                data-contactno="${row.contactNo}"
                data-birthdate="${row.birthDate}"
                data-empid="${row.emp_id}"
                data-deptid="${row.dept_id}"
                data-deptname="${row.dept_name}"
                data-bs-target="#modifyEmployeeModal"
                >
                <i class="bi bi-pencil" ></i> View
              </button>
                  `;
                }
            }
         ],
         columnDefs : [ 
            { targets: [1, 2, 3, 4], className: 'text-center vertical-align-middle' }, // Center align all rows
        ]
    });
}
   