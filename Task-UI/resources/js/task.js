import axios from 'axios';
import { getDateOnly, setMinToday, formatToLongDate, attachLongDateFormatter,resetFormattedDateInput} from './dates';
import { getToken } from './auth-check';
import { disableManualDatetimeInput } from './custom';


$(document).ready(function() {
    getToken();
    initTaskDatatable();
    disableManualDatetimeInput('#dueDate');

    $('.action-btn-task').on('click', function(e) {
        e.preventDefault();

        const action = $(this).data('action');
        const task_id = $(this).data('id') || 0;
        const emp_id = $(this).data('empid') || 0;
    
      
        const data = {
            'name': $('#name').val(),
            'dueDate': $('#dueDateHidden').val(),
            'description': $('#description').val(),
            'status': $('#status').val(),
            'emp_id': $('#employeeid').val()
        };


        if(task_id === 0) {
            addTask(data);
        }
        else if(action === 'update')
        {
            updateTask(task_id, data);
        }
        else if(action === 'delete'){

            deleteTask(task_id);
        }

    });


    //functions
    function addTask(data)
    {
        axios.post('save/task/0', data)
        .then( response => {

            console.log(response);
           if(response.data.success){
                Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifyTaskModal').modal('hide');
                $('#task-table').DataTable().ajax.reload();
            }
            else{

                
                 const errorMsg = Array.isArray(response.data.error)
                ? response.data.error.join('<br>')
                : response.data.message;

                Swal.fire({
                    title: "Error",
                    html: errorMsg,
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


    function updateTask(id,data){
        axios.post(`save/task/${id}`, data)
            .then(response => {

            console.log(response);
           if(response.data.success){
                Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifyTaskModal').modal('hide');
                $('#task-table').DataTable().ajax.reload();
            }
            else{

                console.log(data);
                 const errorMsg = Array.isArray(response.data.error)
                ? response.data.error.join('<br>')
                : response.data.error || "Uknown error";

                Swal.fire({
                    title: "Error",
                    html: errorMsg,
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


    function deleteTask(id){

        axios.delete(`task/${id}`)
        .then(response => {
            console.log(response.data);
        if(response.data.success){
                Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                });

                $('#modifyTaskModal').modal('hide');
                $('#task-table').DataTable().ajax.reload();
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

//modal show
$('#modifyTaskModal').on('show.bs.modal', function (event) {

    //fetched from button VIEW
    const button = $(event.relatedTarget);
    const task_id = parseInt(button.data('taskid')) || 0;
    const taskName = button.data('name');
    const emp_id = button.data('empid')||0;
    const dueDate = button.data('duedate');
    const description = button.data('description');
    const status = button.data('status');
    const emp_name = button.data('fullname');

    //get input field Ids
    const submitBtn = $('#submit-btn-task');
    const deleteBtn = $('#del-btn-task');
    const statusElement = $('#status');
    const statusFormGroup = $('.statusFormGroup')



    //Init Select2 only once
    const $select = $('#employeeid');
    if (!$select.hasClass('select2-initialized')) {
        $select.select2({
            dropdownParent: $('#modifyTaskModal'),
            placeholder: 'Select an employer',
            allowClear: true,
            minimumResultsForSearch: 0,
            ajax: {
                url: 'getAllEmployers',
                dataType: 'json',
                delay: 250,
                  headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
                        'Accept': 'application/json'
                    },
                data: function (params) {
                    return {
                        key: params.term || '' // 👈 send the search key to Laravel
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.response.map(emp => ({
                            id: emp.emp_id,
                          text: `${emp.firstName} ${emp.middleName ?? ''} ${emp.lastName}`

                        }))
                    };
                },
                cache: true
            }
        }).addClass('select2-initialized');
    }

    // Set selected employee manually (pre-selected) / EDIT purposes
    if (emp_id && emp_name) {
        const selectedOption = new Option(emp_name, emp_id, true, true);
        $select.append(selectedOption).trigger('change');
    } else {
        $select.val(null).trigger('change');
    }



    resetFormattedDateInput('#dueDate', '#dueDateHidden');

    // Show/hide delete button
    if (task_id === 0) {
        deleteBtn.hide();
        submitBtn.text('Save');
        submitBtn.attr('data-action', `save`);
        statusElement.val("in-progress");
        statusFormGroup.hide();



    const rawDate = $('#dueDateHidden').val();
    if (rawDate) {
        $('#dueDate')
            .attr('type', 'text')
            .val(formatToLongDate(rawDate));
    }
        setMinToday('#dueDate');

        
        attachLongDateFormatter('#dueDate', '#dueDateHidden')

    } else {
        deleteBtn.show();
        deleteBtn.attr('data-id', `${task_id}`);
         statusFormGroup.show();
        //mapping
    
        $('#description').val(description);
        $('#dueDate').val(dueDate);
        $('#status').val(status);
        $('#name').val(taskName);

        attachLongDateFormatter('#dueDate', '#dueDateHidden') 
        submitBtn.text('Update');
        submitBtn.attr('data-action', 'update');
        submitBtn.attr('data-id', task_id);

    }
});

//resetter
$('#modifyTaskModal').on('hidden.bs.modal', function () {
    $('#taskForm')[0].reset();
    const $submitBtn = $('#submit-btn-task');
    
    // Remove attributes + jQuery cache
    $submitBtn.removeAttr('data-action').removeData('action');
    $submitBtn.removeAttr('data-id').removeData('id');

    $('#dueDateHidden').val('');

});

    //table - ajax
    function initTaskDatatable(){
         $('#task-table').DataTable({
        processing: true,
        serverSide: false, // set to true only if backend supports pagination
        ajax: {
            url: 'getAllTask',
             beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            dataSrc: function (json) {
                return json.response; // assumes your API returns { success, response: [...] }
            },

        },
        columns: [
            { data: 'task_id', visible: false }, // hidden ID
            { data: 'name' }, 
            { data: 'description' }, 
            { data: 'full_name' }, 
           {
            data: 'dueDate',
            render: function (data) {
                return formatToLongDate(data);
            }
            },
            { data: 'status' },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return `
              <button type="button"
                class="btn btn-primary my-2" 
                data-bs-toggle="modal" 
                data-taskid="${row.task_id}"
                data-empid="${row.emp_id}"
                data-name="${row.name}"
                data-description="${row.description}"
                data-duedate="${getDateOnly(row.dueDate)}"
                data-status="${row.status}"
                data-fullname="${row.full_name}"
                data-bs-target="#modifyTaskModal"
                >
                <i class="bi bi-pencil" ></i> View
              </button>
                  `;
                }
            }
         ],
         columnDefs : [ 
            { targets: [1, 2, 3, 4], className: 'text-center' }, // Center align all rows
        ]
    });
    }
    
});

