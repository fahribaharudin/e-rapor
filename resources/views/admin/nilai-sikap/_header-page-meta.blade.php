<table class="table">
	<tbody>
		<tr class="active">
			<td colspan="2"><h4>INFORMASI NILAI PENGETAHUAN</h4></td>
		</tr>
		<tr class=""> 
	        <td class="col-sm-3"><b>Nama Siswa </b></td> 
	        <td>
	        	<b class="col-sm-6">
	        		<input type="text" value="{{ $siswa->nama }}" readonly class="form-control">
	        	</b>
	        </td>
		</tr>
		<tr class=""> 
	        <td class="col-sm-3"><b>Mata Pelajaran </b></td> 
	        <td>
	        	<b class="col-sm-6">
	        		<input type="text" value="{{ $mapel->child->nama_mapel }}" readonly class="form-control">
	        	</b>
	        </td>
		</tr>
		<tr class=""> 
	        <td class="col-sm-3"><b>Kelas </b></td> 
	        <td>
	        	<b class="col-sm-3">
	        		<input type="text" value="{{ $siswa->kelas->nama_kelas }} (tingkat: {{ $siswa->kelas->tingkat_kelas }})" readonly class="form-control">
	        	</b>
	        </td>
		</tr>
		<tr class=""> 
	        <td class="col-sm-3"><b>Semester </b></td> 
	        <td>
	        	<b class="col-sm-3">
	        		<input type="text" value="{{ $siswa->semester }}" readonly class="form-control">
	        	</b>
	        </td>
		</tr>
	</tbody>
</table>