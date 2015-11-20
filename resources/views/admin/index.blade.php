@extends('admin._layout')

@section('content')
	
	@include('admin._navbar')
	
	<!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">   
                <div class="page-header">
                    <h1>Administrator Dashboard <small>Selamat datang admin!</small></h1>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            Anda login sebagai administrator.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection