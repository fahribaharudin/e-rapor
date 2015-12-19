@extends('guru._layout')

@section('content')
	
	@include('guru._navbar')

	<div class="container">
		
		@if (Auth::user()->hasRole('Wali Kelas'))
			<div class="jumbotron">
				<h1>Selamat datang di kelas {{ Auth::user()->owner->kelas[0]->nama_kelas }}</h1>
				<hr>
				<p class="lead">
					Ini adalah kelas milik anda. Anda bisa mengolah data kelas sesuai dengan kebutuhan wali kelas
					dengan mengakses menu yang ada. Terimakasih! :)
				</p>
			</div>
		@elseif (Auth::user()->hasRole('Guru'))
			<div class="jumbotron">
				<h1>Selamat datang Guru</h1>
				<hr>
				<p class="lead">
					Anda bisa mengolah data nilai semua siswa yang mengikuti mata pelajaran anda, silahkan
					gunakan menu yang ada di atas. Terimakasih! :)
				</p>
			</div>
		@endif

	</div>

@endsection