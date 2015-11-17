<hr>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Kompetensi Dasar</th>
				<th colspan="4">Teknik Penilaian</th>
			</tr>
			<tr>
				<th>Observasi</th>
				<th>Penilaian Sendiri</th>
				<th>Penilaian Sebaya</th>
				<th>Jurnal</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1 ?>
			@if (count($mapel->kompetensi_dasar) != 0)
				@foreach ($mapel->kompetensi_dasar as $kompetensi_dasar)
					<?php 
						$nilai = $mapel->nilaiSikap()->where('mapel_id', '=', $mapel->id)
							->where('siswa_id', '=', $siswa->id)
							->where('kompetensi_id', '=', $kompetensi_dasar->id)
							->first();
					?>
					<tr>
						<td>{{ $i++ }}</td>
						<td>{{ $kompetensi_dasar->nama_kompetensi }}</td>
						<td class="col-sm-1">
							<select name="nilai_observasi_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->observasi == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->observasi == 4) ? 'selected' : ''}}>Baik Sekali</option>
								<option value="3" {{ ($nilai != null && $nilai->observasi == 3) ? 'selected' : ''}}>Baik</option>
								<option value="2" {{ ($nilai != null && $nilai->observasi == 2) ? 'selected' : ''}}>Cukup</option>
								<option value="1" {{ ($nilai != null && $nilai->observasi == 1) ? 'selected' : ''}}>Kurang</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_penilaian_diri_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->penilaian_diri == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->penilaian_diri == 4) ? 'selected' : ''}}>Baik Sekali</option>
								<option value="3" {{ ($nilai != null && $nilai->penilaian_diri == 3) ? 'selected' : ''}}>Baik</option>
								<option value="2" {{ ($nilai != null && $nilai->penilaian_diri == 2) ? 'selected' : ''}}>Cukup</option>
								<option value="1" {{ ($nilai != null && $nilai->penilaian_diri == 1) ? 'selected' : ''}}>Kurang</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_penilaian_sebaya_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->penilaian_sebaya == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->penilaian_sebaya == 4) ? 'selected' : ''}}>Baik Sekali</option>
								<option value="3" {{ ($nilai != null && $nilai->penilaian_sebaya == 3) ? 'selected' : ''}}>Baik</option>
								<option value="2" {{ ($nilai != null && $nilai->penilaian_sebaya == 2) ? 'selected' : ''}}>Cukup</option>
								<option value="1" {{ ($nilai != null && $nilai->penilaian_sebaya == 1) ? 'selected' : ''}}>Kurang</option>
							</select>
						</td>
						<td class="col-sm-1">
							<select name="nilai_jurnal_kd_{{ $i - 1 }}" class="form-control input-sm">
								<option value="0" {{ ($nilai != null && $nilai->jurnal == 0) ? 'selected' : ''}}>-</option>
								<option value="4" {{ ($nilai != null && $nilai->jurnal == 4) ? 'selected' : ''}}>Baik Sekali</option>
								<option value="3" {{ ($nilai != null && $nilai->jurnal == 3) ? 'selected' : ''}}>Baik</option>
								<option value="2" {{ ($nilai != null && $nilai->jurnal == 2) ? 'selected' : ''}}>Cukup</option>
								<option value="1" {{ ($nilai != null && $nilai->jurnal == 1) ? 'selected' : ''}}>Kurang</option>
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
				<td colspan="6">
					<span class="pull-right">
						<button type="submit" class="btn btn-primary">SIMPAN</button>
						<a class="btn btn-warning" href="{{ route('admin.nilai-sikap.index-byMapel', [$mapel->id, $siswa->kelas->id, $siswa->semester]) }}">BATAL</a>
					</span>
				</td>
			</tr>
		</tfoot>
	</table>
</div>