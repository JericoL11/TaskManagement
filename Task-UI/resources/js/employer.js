import { getDateOnly, setMinToday, setMaxToday} from './dates';
import {numericInput} from './custom';
 
$(document).ready(function() {

setMaxToday('#birthDate');
numericInput('#contactNo');
    
    initEmployersDatatable();
    $('.action-btn').on('click', function (e){

        e.preventDefault();

        const action = $(this).data('action');
        const id = $(this).data('id');  
        const empid = $(this).data('empid');

        //array of data
       const data = 
       {
            firstName: $('#firstName').val(),
            middleName: $('#middleName').val(),
            lastName: $('#lastName').val(),
            birthDate: $('#birthDate').val(),
            address: $('#address').val(),
            contactNo: $('#contactNo').val()
       };
            

        if(id === 0){
            addEmployee(data);
        }

        else if( action === 'update'){
            updateEmployee(id,data);
        }
       
        else if( action === 'delete'){
            deleteEmployee(empid);
        }
    });

    function deleteEmployee(empid){
        axios.delete(`employee/${empid}`)
        .then(response => {
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
                : response.data.error || "Uknown error";

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


            console.log('Updating ID:', id);
            console.log('Payload data:', data);

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
                    : response.data.error || "Unknown error";

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

//modify modal
$('#modifyEmployeeModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const emp_id = parseInt(button.data('empid')) || 0;
    const personid = parseInt(button.data('personid')) || 0;
    const firstName = button.data('firstname');
    const middleName = button.data('middlename');
    const lastName = button.data('lastname');
    const address = button.data('address');
    const contactNo = button.data('contactno');
    const birthDate = button.data('birthdate');

    const submitBtn = $('#submit-btn'); //action btn
    const deleteBtn = $('#del-btn-employee');


    console.log(button.data())

 if (personid === 0) {
        $('#del-btn-employee').hide();
        submitBtn.text('Save');
        submitBtn.attr('data-action', 'save');
        submitBtn.attr('data-id', `${personid}`);

    } else {
        //mapping / assigning inmput fields 
        $('#firstName').val(firstName);
        $('#middleName').val(middleName);
        $('#lastName').val(lastName);
        $('#birthDate').val(getDateOnly(birthDate));
        $('#address').val(address);
        $('#contactNo').val(contactNo);

        $('#del-btn-employee').show();
        submitBtn.text('Update');
        submitBtn.attr('data-action', 'update');
        submitBtn.attr('data-id', `${personid}`);
        deleteBtn.attr('data-empid', `${emp_id}`);
        
    }
});

//resetter
$('#modifyEmployeeModal').on('hidden.bs.modal', function () {
    $('#employeeForm')[0].reset();
    $('#submit-btn').attr('data-action', ''); 
});

function initEmployersDatatable(){
 //table - ajax
     $('#employers-table').DataTable({
        processing: true,
        serverSide: false, // set to true only if backend supports pagination
        ajax: {
            url: 'getAllEmployers',
            dataSrc: function (json) {
                return json.response; // assumes your API returns { success, response: [...] }
            }
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
                data-personid="${row.person_id}"
                data-firstname="${row.firstName}"
                data-middlename="${row.middleName}"
                data-lastname="${row.lastName}"
                data-address="${row.address}"
                data-contactno="${row.contactNo}"
                data-birthdate="${row.birthDate}"
                data-empid="${row.emp_id}"
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
   
});