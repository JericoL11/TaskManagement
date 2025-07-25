<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VFI Task Management</title>


    <script>
        const token = localStorage.getItem('auth_token');
        const currentPath = window.location.pathname;

        // If logged in, don't allow login or register page
        if (token && (currentPath === '/login' || currentPath === '/register')) {
            window.location.href = '/dashboard';
        }
    </script>


        {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{--Select 2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{--Bootstrap ICON--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


 {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Animation css -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>
    <!-- As a link -->
    <nav class="navbar bg-body-tertiary shadow ">
            <div class="container-fluid fs-1 d-flex justify-content-end">
                <a class="navbar-brand" href="/" title="Login">Login</a>
                <a class="navbar-brand" href="/signup-page" title="Register">Register</a>
            </div>
    </nav>

       

    <div class="d-flex justify-content-center fw-bold fs-2 my-3">
        @yield('title')
        
    </div>
    <main class="container">
        @yield('content')
    </main>
    


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    {{-- jQuery (needed by DataTables) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  {{-- SELECT 2--}}
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

       {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- animatiopn js -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
</body>
</html>