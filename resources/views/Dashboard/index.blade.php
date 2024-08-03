@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Dashboard</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        Welcome To Transaction Retail
                    </div>
                </div>

            </div>
            <div class="row">
                <a href="{{route('DataCustomer')}}">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="dashboard-div-wrapper bk-clr-one">
                            <i class="fa fa-venus dashboard-div-icon"></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                </div>

                            </div>
                                <h5>Customer </h5>
                        </div>
                    </div>
                </a>
                <a href="{{route('DataProduct')}}">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="dashboard-div-wrapper bk-clr-two">
                            <i class="fa fa-edit dashboard-div-icon"></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                </div>

                            </div>
                            <h5>Product </h5>
                        </div>
                    </div>
                </a>
                <a href="{{route('ListTransaction')}}">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <div class="dashboard-div-wrapper bk-clr-three">
                            <i class="fa fa-cogs dashboard-div-icon"></i>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                </div>

                            </div>
                            <h5>Transaction </h5>
                        </div>
                    </div>
                </a>
                 

            </div>

        </div>
    </div>
    @endsection
    <!-- CONTENT-WRAPPER SECTION END-->
