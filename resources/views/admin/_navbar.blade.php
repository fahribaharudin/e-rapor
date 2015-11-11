<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home') }}">E-Rapor</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data User <b class="caret"></b></a>
		          	<ul class="dropdown-menu">
		            	<li><a href="{{ route('admin.users.index') }}">Data User</a></li>
		          	</ul>
		        </li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data Sekolah <b class="caret"></b></a>
		          	<ul class="dropdown-menu">
		            	<li><a href="{{ route('admin.profile-sekolah.index') }}">Data Profile Sekolah</a></li>
		            	<li><a href="{{ route('admin.paket-keahlian.index') }}">Data Paket Keahlian</a></li>
		            	<li class="divider"></li>
		            	<li><a href="{{ route('admin.guru.index') }}">Data Guru</a></li>
		            	<li><a href="{{ route('admin.siswa.index') }}">Data Siswa</a></li>
		            	<li><a href="{{ route('admin.kelas.index') }}">Data Kelas</a></li>
		            	<li><a href="{{ route('admin.siswa-kelas.index') }}">Data Siswa Perkelas</a></li>
		            	<li class="divider"></li>
		            	<li><a href="{{ route('admin.mapel.index') }}">Data Mata Pelajaran</a></li>
		            	<li><a href="{{ route('admin.kompetensi-dasar.index') }}">Data Kompetensi Dasar</a></li>
		            	<li class="divider"></li>
		            	<li><a href="{{ route('admin.nilai-pengetahuan.index') }}">Nilai Pengetahuan</a></li>
		            	<li><a href="{{ route('admin.nilai-keterampilan.index') }}">Nilai Keterampilan</a></li>
		            	<li><a href="{{ route('admin.nilai-sikap.index') }}">Nilai Sikap</a></li>
		          	</ul>
		        </li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rapor <b class="caret"></b></a>
		          	<ul class="dropdown-menu">
		            	<li><a href="#">Lihat Rapor</a></li>
		            	<li><a href="#">Cetak Rapor</a></li>
		          	</ul>
		        </li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
					<li><a>Anda login sebagai {{ Auth::user()->owner->nama }}</a></li>
			        <li><a href="{{ route('auth.logout') }}">Logout <b class="glyphicon glyphicon-log-out"></b></a></li>
			    @endif
		   	</ul>
		</div>
	</div>
</nav>