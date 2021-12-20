@php
$setting = App\Model\Setting::find(1);
@endphp
<!DOCTYPE html>
<html>

<head>
    <base href="{{ url('/') }}">
    <title>Admin | {{ $title }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Pankaj Choudhary">
    <link rel="icon" href="{{ url('imgs/favicon/'.$setting->favicon) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="baseurl" content="{{ url('/') }}">
    <!--- add style sheet ----->

    {{ HTML::style('assets/vendor/fontawesome-free/css/all.min.css') }}
    {{ HTML::style('assets/css/bootstrap-select.min.css') }}
    {{ HTML::style('datatables/dataTables.bootstrap4.min.css') }}
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    {{ HTML::style('assets/css/sb-admin-2.min.css') }}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>




</head>

<body class="">
<!-- <body class="sidebar-toggled"> -->