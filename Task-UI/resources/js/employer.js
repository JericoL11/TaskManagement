console.log("Employer js");



$(document).ready(function() {

    //add 






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
                      <button class="btn btn-primary">View</button>
                    `;
                }
            }
         ],
         columnDefs : [ 
            { targets: [1, 2,3], className: 'text-center' }, // Center align all rows
        ]
    });
});