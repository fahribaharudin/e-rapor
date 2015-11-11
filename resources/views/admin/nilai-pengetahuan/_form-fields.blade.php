
<hr>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Kompetensi Dasar</th>
				<th colspan="3">Teknik Penilaian</th>
			</tr>
			<tr>
				<th>Tertulis</th>
				<th>Observasi</th>
				<th>Penugasan</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1 ?>
			@if (count($mapel->kompetensi_dasar) != 0)
				@foreach ($mapel->kompetensi_dasar as $kompetensi_dasar)
					<?php 
						$nilai = $mapel->nilaiPengetahuan()->where('mapel_id', '=', $mapel->id)
							->where('siswa_id', '=', $siswa->id)
							->where('kompetensi_id', '=', $kompetensi_dasar->id)
							->first();
					?>
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $kompetensi_dasar->nama_kompetensi }}</td>
						<td class="col-sm-1">
							<select name="nilai_tertulis_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->tertulis == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->tertulis == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->tertulis == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->tertulis == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->tertulis == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_observasi_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->observasi == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->observasi == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->observasi == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->observasi == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->observasi == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_penugasan_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->penugasan == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->penugasan == 4) ? 'selected' : ''}}>A</option>
								<option value="3" {{ ($nilai != null && $nilai->penugasan == 3) ? 'selected' : ''}}>B</option>
								<option value="2" {{ ($nilai != null && $nilai->penugasan == 2) ? 'selected' : ''}}>C</option>
								<option value="1" {{ ($nilai != null && $nilai->penugasan == 1) ? 'selected' : ''}}>D</option>
							</select>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5">
						<div class="alert alert-danger">
							<p><strong>Maaf</strong>, Sepertinya kompetensi dasar untuk mata pelajaran ini masih kosong, silahkan buat terlebih dahulu :)</p>
						</div>
					</td>
				</tr>
			@endif
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5">
					<span class="pull-right">
						<button type="submit" class="btn btn-primary">SIMPAN</button>
						<button class="btn btn-warning">BATAL</button>
					</span>
				</td>
			</tr>
		</tfoot>
	</table>
</div>