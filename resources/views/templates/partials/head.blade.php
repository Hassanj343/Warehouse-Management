<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = trim($__env->yieldContent('page-title')); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="PC Vision">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ? $pageTitle . ' | Warehouse Management' : 'Warehouse Management' }}</title>

    <script type="text/javascript" src="{{ asset('assets/js/vue.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/vue-resource.js') }}"></script>
    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/icomoon/icomoon.css')  }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.min.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/jquery-confirm-master/dist/jquery-confirm.min.css')  }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css')  }}">


    <!-- Favicon -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

