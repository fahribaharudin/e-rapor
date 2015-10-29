@extends('_layout')

@section('content')
	
	@include('admin._navbar')

	<div class="container-wide">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h2>DATA MATA PELAJARAN</h2>
				</div>
				<ol class="breadcrumb">
					<li><a href="{{ route('admin') }}">Administrator Dashboard</a></li>
					<li class="active">Data Mata Pelajaran</li>
				</ol>
				<p>COMING SOON! :)</p>
			</div>	
		</div>
	</div>

@endsection

@section('script')
	{{-- TODO: script --}}
@endsection