import axios from "axios";

$(document).ready(function (){

    console.log("Token:", localStorage.getItem("auth_token"));

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

    });


    $('#logout-btn').on('click', function () {

        console.log('logout clicked')
        logoutUser();
    });




});


function logoutUser() {
    const token = localStorage.getItem('auth_token');

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
            console.log(response.data);
            if (response.data.token) {
                localStorage.setItem('auth_token', response.data.token);
                window.location.href = '/dashboard';
            } else {
                alert("Invalid login.");
            }
        })
        .catch(error => {
            console.error(error);
            alert("Something went wrong.");
        });
}
