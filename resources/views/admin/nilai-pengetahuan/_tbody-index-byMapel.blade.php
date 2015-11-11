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
				<?php $tertulis = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'tertulis', 'type' => 'pengetahuan']) ?>
				{!! rtrim($tertulis['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $observasi = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'observasi', 'type' => 'pengetahuan']) ?>
				{!! rtrim($observasi['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $penugasan = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'penugasan', 'type' => 'pengetahuan']) ?>
				{!! rtrim($penugasan['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php 
					$tertulis_akhir = $nilaiFormater->countAverage($tertulis['value']);; 
					$observasi_akhir = $nilaiFormater->countAverage($observasi['value']);; 
					$penugasan_akhir = $nilaiFormater->countAverage($penugasan['value']);; 

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