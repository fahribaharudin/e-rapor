<hr>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Kompetensi Dasar</th>
				<th colspan="5">Teknik Penilaian</th>
			</tr>
			<tr>
				<th>Praktek</th>
				<th>Projek</th>
				<th>Produk</th>
				<th>Porto Folio</th>
				<th>Tertulis</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1 ?>
			@if (count($mapel->kompetensi_dasar) != 0)
				@foreach ($mapel->kompetensi_dasar as $kompetensi_dasar)
					{{ var_dump($kompetensi_dasar->id) }}
					<?php 
						$nilai = $mapel->nilaiKeterampilan()->where('mapel_id', '=', $mapel->id)
							->where('siswa_id', '=', $siswa->id)
							->where('kompetensi_id', '=', $kompetensi_dasar->id)
							->first();
					?>
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $kompetensi_dasar->nama_kompetensi }}</td>
						<td class="col-sm-1">
							<select name="nilai_praktek_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->praktek == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->praktek == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->praktek == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->praktek == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->praktek == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_project_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->project == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->project == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->project == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->project == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->project == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_produk_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->produk == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->produk == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->produk == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->produk == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->produk == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_portofolio_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->portofolio == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->portofolio == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->portofolio == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->portofolio == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->portofolio == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_tertulis_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->tertulis == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->tertulis == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->tertulis == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->tertulis == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->tertulis == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="7">
						<div class="alert alert-danger">
							<p><strong>Maaf</strong>, Sepertinya kompetensi dasar untuk mata pelajaran ini masih kosong, silahkan buat terlebih dahulu :)</p>
						</div>
					</td>
				</tr>
			@endif
		</tbody>
		<tfoot>
			<tr>
				<td colspan="7">
					<span class="pull-right">
						<button type="submit" class="btn btn-primary">SIMPAN</button>
						<a class="btn btn-warning" href="{{ route('admin.nilai-keterampilan.index-byMapel', [$mapel->id, $siswa->kelas->id, $siswa->semester]) }}">BATAL</a>
					</span>
				</td>
			</tr>
		</tfoot>
	</table>
</div>