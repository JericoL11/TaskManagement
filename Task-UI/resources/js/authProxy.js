import axios from "axios";


$(document).ready(function (){


    $('#signIn-btn').on('click', function (){

        const username_input =  $('#username').val();
        const password_input = $('#password').val();

        const data = {
            username: username_input,
            password: password_input
        };     

      if (username_input && password_input) {
            Submit_signIn(data);
        }
        else{
             Swal.fire({
                    title: "Error",
                    html: 'Fill-up the form completely.',
                    icon: "info"
                })
        }
    });


    $('#logout-btn').on('click', function () {

        console.log('logout clicked')
        logoutUser();
    });

    $('#btn-register').on('click', function() {
      
        const username_in =  $('#username').val();
        const password = $('#password').val();
        const confirm_password = $('#password_confirmation').val();
        const firstname_in = $('#firstName').val();
        const lastName_in = $('#lastName').val();
        const middleName_in = $('#middleName').val();
        const birthDate_in = $('#birthDate').val();
        const address_in = $('#address').val();
        const contactNo_in = $('#contactNo').val();

        const data = {
            username: username_in,
            password: password,
            password_confirmation: confirm_password, 
            firstName: firstname_in,
            lastName: lastName_in,
            middleName: middleName_in,
            birthDate: birthDate_in,
            address: address_in,
            contactNo: contactNo_in
        };   

        Submit_Signup(data);
    });

});



function logoutUser() {
   //const token = localStorage.getItem('auth_token');

    axios.post('/auth/logout', {}, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    })
    .then(response => {
        console.log(response.data);
        localStorage.removeItem('auth_token');
        window.location.href = '/'; 
    })
    .catch(error => {
        console.error("Logout failed", error);
    });
}


//functions
function Submit_signIn(data) {
    
    axios.post('/auth/login', data)
        .then(response => {
            console.log(response.data.errors);
            if (response.data.token) {
                localStorage.setItem('auth_token', response.data.token);
                window.location.href = '/dashboard';
            } else {

                   const errorMsg = Array.isArray(response.data.errors)
                ? response.data.errors.join('<br>')
                : response.data.errors || "Uknown error";

                Swal.fire({
                    title: "Error",
                    html: errorMsg,
                    icon: "info"
                })
            }
        })
        .catch(error => {
            console.error(error);
            alert("Something went wrong.");
        });
   }

function Submit_Signup(data){
            axios.post('/auth/register', data)
            .then(response => {
                console.log(data);

                if(response.data.success){
                            Swal.fire({
                    text: `${response.data.message}`,
                    icon: "success"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/';
                    }
                });

                }
                else{
                  const errorMsg = Array.isArray(response.data.errors)
                  ? response.data.errors.join('<br>')
                  : response.data.errors || "Unknown Error";

                    Swal.fire({
                    title: "Warning",
                    html: errorMsg,
                    icon: "info"
                })
                }
            })
            .catch(errors => {

                 Swal.fire({    
                    title: "Error",
                    text: errors,
                    icon: "error"
                 });
          });
    }
