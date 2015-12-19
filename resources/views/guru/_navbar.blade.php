<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="{{ route('guru') }}" class="navbar-brand">Halaman Guru</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-navbar-collapse">
			
			<ul class="nav navbar-nav">

				@if (Auth::user()->hasRole('Wali Kelas'))
					<li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Kelas <b class="caret"></b></a>
			          	<ul class="dropdown-menu">
							<li><a href="{{ route('guru.kelas.index') }}">Informasi Kelas</a></li>
							<li><a href="{{ route('guru.kelas.siswa.index') }}">Daftar Siswa Kelas</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('guru.kelas.mapel.index') }}">Daftar Mata Pelajaran</a></li>
						</ul>
					</li>
				@endif

				@if (Auth::user()->hasRole('Guru'))
					<li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Input Nilai <b class="caret"></b></a>
			          	<ul class="dropdown-menu">
							<li><a href="{{ route('guru.mapel.nilai-pengetahuan.index') }}">Pengetahuan</a></li>
							<li><a href="{{ route('guru.mapel.nilai-keterampilan') }}">Keterampilan</a></li>
							<li><a href="{{ route('guru.mapel.nilai-sikap') }}">Sikap</a></li>
						</ul>
					</li>
				@endif

			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
					<li><a>Anda login sebagai {{ Auth::user()->owner->nama }}</a></li>
			        <li>
			        	<a href="{{ route('auth.logout') }}">
			        		Logout <b class="glyphicon glyphicon-log-out"></b>
			        	</a>
			        </li>
			    @endif
		   	</ul>
		   	
		</div>
	</div>
</nav>