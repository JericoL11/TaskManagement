import axios from "axios";
import  { formatToLongDate, attachLongDateFormatter } from "./dates"
import { getToken } from "./auth-check";

$(document).ready(function () {

    $(function () {
        // Declare shared variables
        let startDate = moment().subtract(7, 'days');
        let endDate = moment();

        // Initialize the input visually
        $('#daterange').val(startDate.format('MM/DD/YYYY') + ' - ' + endDate.format('MM/DD/YYYY'));

        // Apply the daterangepicker
        $('#daterange').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            opens: 'center'
        }, function (start, end, label) {
            // Update variables when user selects new dates
            startDate = start;
            endDate =  end;
            console.log("New range selected:", start.format('YYYY-MM-DD'), "to", end.format('YYYY-MM-DD'));
        });

        // Button click event
        $('#filter-btn').on('click', function () {
            console.log('Button clicked');
            console.log('start:', startDate.format('YYYY-MM-DD'), 'end:', endDate.format('YYYY-MM-DD'));
            initCompletedTask(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
        });
    });


    getToken();
    taskCount(); 

    // Attach formatters
    // attachLongDateFormatter('#startDate', '#startDateHidden');
    // attachLongDateFormatter('#endDate', '#endDateHidden');


});

function initCompletedTask(startDate, endDate) {
     //const token = localStorage.getItem('auth_token');

    $('#completed-tasks-table').DataTable({
        processing: true,
        serverSide: false, // Set to true only if backend supports server-side pagination
        destroy: true, // Allow re-initialization with new parameters
        ajax: {
            url: '/getTaskReport',
            type: 'GET',
              beforeSend: function (xhr) {
             xhr.setRequestHeader('Authorization', 'Bearer ' + token);
             },
            data: {
                startDate: startDate,
                endDate: endDate
            },
              
            dataSrc: function (json) {
                console.log(json);

                if (json.success) {
                    return json.response; // DataTable will use this data
                } else {
                    const errorMsg = Array.isArray(json.errors)
                        ? json.errors.join('<br>')
                        : json.message;

                    Swal.fire({
                        title: "Error",
                        html: errorMsg,
                        icon: "info"
                    });

                    return []; // return empty data to DataTable
                }
            }
        },
        columns: [
            { data: 'task_id', visible: false }, // hidden ID
            { data: 'full_name'},
            { data: 'name' }, // task name
            { data: 'created_At',  
                render: function (data) {
                  return formatToLongDate(data);
                 } 
            },
            { data: 'completed_At',
                render: function (data) {
                    return formatToLongDate(data);
                }
             },
            { data: 'status' }
        ],
        columnDefs: [
            { targets: [1, 2, 3, 4, 5], className: 'text-center' }
        ]
    });
}

function taskCount(){
    const $spinner_dueDate = $('#dueDate-taskLoader');
    const $text_dueDate = $('#dueDate-taskCountText');

    const $spinner_complete = $('#complete-taskLoader');
    const $text_complete = $('#complete-taskCountText');

    const $spinner_pending = $('#pending-taskLoader');
    const $text_pending = $('#pending-taskCountText');


//show spinner
    $spinner_complete.removeClass('d-none'); 
    $spinner_dueDate.removeClass('d-none'); 
    $spinner_pending.removeClass('d-none'); 

//empty text
    $text_dueDate.text('');
    $text_pending.text('');
    $text_complete.text('');

    axios.get('getAllTaskSummary')
    .then(response => {
        console.log("Pending count: ", response.data)
        $text_dueDate.text(response.data.dueToday);
        $text_pending.text(response.data.allPending);
        $text_complete.text(response.data.completedToday);
    })
    .catch(error => {
        console.error(error);
        $text.text('Error');
    })
    .finally(() => {
        $spinner_complete.addClass('d-none'); //hide spinner
        $spinner_dueDate.addClass('d-none'); 
        $spinner_pending.addClass('d-none'); 
    })
}
