<!doctype html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" loader="disable">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="vexel – Laravel Bootstrap 5  Admin & Dashboard Template">
        <meta name="author" content="Spruko Technologies Private Limited">
        <meta name="keywords" content="admin panel template, admin dashboard template, admin panel, bootstrap admin template, dashboard, laravel, bootstrap dashboard, admin dashboard, admin panel laravel template, laravel framework, admin laravel, laravel admin panel.">

		<!-- TITLE -->
        <title>{{ env("APP_NAME") }}</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ url('/') }}/build/assets/images/brand/favicon.ico" type="image/x-icon">

        <!-- ICONS CSS -->
        <link href="{{ url('/') }}/build/assets/iconfonts/icons.css" rel="stylesheet">

        <!-- Main Theme Js -->
        <script src="{{ url('/') }}/build/assets/main.js"></script>

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{ url('/') }}/build/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Choices JS -->
        <script src="{{ url('/') }}/build/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

        <!-- Simplebar Css -->
        <link href="{{ url('/') }}/build/assets/libs/simplebar/simplebar.min.css" rel="stylesheet">

        <!-- Color Picker Css -->
        <link rel="stylesheet" href="{{ url('/') }}/build/assets/libs/flatpickr/flatpickr.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/build/assets/libs/%40simonwep/pickr/themes/nano.min.css">

        <!-- Choices Css -->
        <link rel="stylesheet" href="{{ url('/') }}/build/assets/libs/choices.js/public/assets/styles/choices.min.css">
        <!-- APP CSS & APP SCSS -->
        <link rel="preload" as="style" href="{{ url('/') }}/build/assets/app-e29e56ca.css" /><link rel="stylesheet" href="{{ url('/') }}/build/assets/app-e29e56ca.css" />    
        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
        
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">

<!-- DataTables Buttons CSS -->
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>
    <style>
        .loader-button {
    position: relative;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    overflow: hidden;
    transition: background-color 0.3s ease;
}

.loader {
    position: absolute;
    top: 50%;
    left: 50%;
    display: none;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 20px;
    border: 2px solid #fff;
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }

    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

.loader-button:hover {
    background-color: #0056b3;
}
    </style>