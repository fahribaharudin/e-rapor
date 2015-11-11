<tbody>
	<?php $i = 1; ?>
	@foreach ($kelas->siswa_kelas as $siswa)
		<?php $kompetensi_dasar = $mapel->kompetensiDasar()->where('semester', '=', $kelas->semester)->get(); ?>
		<tr>
			<td>{{ $i++ }}</td>
			<td>{{ $siswa->nis }}</td>
			<td><span class="text-info">{{ $siswa->nama }}</span></td>
			<td class="text-center">
				{{ $kelas->nama_kelas }} 
				<small class="text-muted">(Tingkat: {{ $kelas->tingkat_kelas }})</small>
			</td>
			<td class="text-center">{{ $kelas->semester }}</td>
			<td class="text-center">
				<?php $nilai_tertulis = ['text' => '', 'value' => [0]] ?>
				@foreach ($kompetensi_dasar as $kompetensi) 
					<?php
						$nilai_pengetahuan = $kompetensi->nilaiPengetahuan()
							->where('mapel_id', '=', $mapel->id)
							->where('siswa_id', '=', $siswa->id)
							->where('kompetensi_id', '=', $kompetensi->id)
							->first();

						if ($nilai_pengetahuan != NULL) {
							$nilai_tertulis['text'] .= '<span class="badge">' . $nilai_pengetahuan->tertulis . '</span> ';
							$nilai_tertulis['value'][] = $nilai_pengetahuan->tertulis;
						}
						else {
							$nilai_tertulis['text'] .= '-, ';
							$nilai_tertulis['value'][] = 0;
						}
					?>
				@endforeach

				{!! rtrim($nilai_tertulis['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $nilai_observasi = ['text' => '', 'value' => [0]] ?>
				@foreach ($kompetensi_dasar as $kompetensi) 
					<?php
						$nilai_pengetahuan = $kompetensi->nilaiPengetahuan()
							->where('mapel_id', '=', $mapel->id)
							->where('siswa_id', '=', $siswa->id)
							->where('kompetensi_id', '=', $kompetensi->id)
							->first();

						if ($nilai_pengetahuan != NULL) {
							$nilai_observasi['text'] .= '<span class="badge">' . $nilai_pengetahuan->observasi . '</span> ';
							$nilai_observasi['value'][] = $nilai_pengetahuan->observasi;
						}
						else {
							$nilai_observasi['text'] .= '-, ';
							$nilai_observasi['value'][] = 0;
						}
					?>
				@endforeach

				{!! rtrim($nilai_observasi['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $nilai_penugasan = ['text' => '', 'value' => [0]] ?>
				@foreach ($kompetensi_dasar as $kompetensi) 
					<?php
						$nilai_pengetahuan = $kompetensi->nilaiPengetahuan()
							->where('mapel_id', '=', $mapel->id)
							->where('siswa_id', '=', $siswa->id)
							->where('kompetensi_id', '=', $kompetensi->id)
							->first();

						if ($nilai_pengetahuan != NULL) {
							$nilai_penugasan['text'] .= '<span class="badge">' . $nilai_pengetahuan->penugasan . '</span> ';
							$nilai_penugasan['value'][] = $nilai_pengetahuan->penugasan;
						}
						else {
							$nilai_penugasan['text'] .= '-, ';
							$nilai_penugasan['value'][] = 0;
						}
					?>
				@endforeach

				{!! rtrim($nilai_penugasan['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php 
					$tertulis_akhir = $nilaiFormater->countAverage($nilai_tertulis['value']);; 
					$observasi_akhir = $nilaiFormater->countAverage($nilai_observasi['value']);; 
					$penugasan_akhir = $nilaiFormater->countAverage($nilai_penugasan['value']);; 

					$nilai_akhir = $nilaiFormater->countAverage([$tertulis_akhir, $observasi_akhir, $penugasan_akhir]);
				?>
				<span class="text-info">{{ round($nilai_akhir, 2) }}</span>
			</td>
			<td class="text-center">
				{!! $nilaiFormater->transformToGrade($nilai_akhir)['html'] !!}
			</td>
			<td><a href="{{ route('admin.nilai-pengetahuan.edit', [$mapel->id, $kelas->id, $kelas->semester, $siswa->id]) }}"><b class="glyphicon glyphicon-pencil"></b></a></td>
			<td><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
		</tr>
	@endforeach
</tbody>