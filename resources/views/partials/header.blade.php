<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>TransactionRetail@gmail.com
                    &nbsp;&nbsp;
                    <strong>Support: </strong>+6289026547877
                </div>

            </div>
        </div>
    </header>
    <!-- HEADER END-->
    <div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- <a class="navbar-brand" href="index.html">
                </a> --}}

            </div>

        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a class="" href="{{ route('Dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('DataCustomer') }}">Data Customer</a></li>
                            <li><a href="{{ route('DataProduct') }}">Data Product</a></li>
                            <li><a href="{{ route('Transaction') }}">Transaction</a></li>
                            <li><a href="{{ route('ListTransaction') }}">List Transaction</a></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
