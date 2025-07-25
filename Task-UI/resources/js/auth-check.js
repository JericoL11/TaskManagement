// $(document).ready(function () {
    
//     const token = localStorage.getItem('auth_token');
//     const publicPaths = ['/', '/signup-page'];

//     const currentPath = window.location.pathname;

//     if (!token && !publicPaths.includes(currentPath)) {
//         // User not logged in and trying to access a protected page
//         window.location.href = '/'; // redirect to login
//     }

//     if (token && publicPaths.includes(currentPath)) {
//         // Logged-in user trying to access login or signup page
//         window.location.href = '/dashboard'; // or your default protected page
//     }
// });


//token setter to axios headers
export function getToken() {

  const token = localStorage.getItem('auth_token');

    if (token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        axios.defaults.headers.common['Accept'] = 'application/json';
    }
}

