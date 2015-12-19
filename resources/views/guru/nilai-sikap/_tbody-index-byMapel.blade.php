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
				<?php $observasi = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'observasi', 'type' => 'sikap']) ?>
				{!! rtrim($observasi['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $penilaian_diri = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'penilaian_diri', 'type' => 'sikap']) ?>
				{!! rtrim($penilaian_diri['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $penilaian_sebaya = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'penilaian_sebaya', 'type' => 'sikap']) ?>
				{!! rtrim($penilaian_sebaya['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $jurnal = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'field' => 'jurnal', 'type' => 'sikap']) ?>
				{!! rtrim($jurnal['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php 
					$observasi_akhir = $nilaiFormater->countAverage($observasi['value']); 
					$penilaian_diri_akhir = $nilaiFormater->countAverage($penilaian_diri['value']); 
					$penilaian_sebaya_akhir = $nilaiFormater->countAverage($penilaian_sebaya['value']); 
					$jurnal_akhir = $nilaiFormater->countAverage($jurnal['value']); 

					$nilai_akhir = $nilaiFormater->countAverage([$observasi_akhir, $penilaian_diri_akhir, $penilaian_sebaya_akhir, $jurnal_akhir]);
				?>
				<span class="text-info">{!! $nilaiFormater->transformToSikap(round($nilai_akhir))['html'] !!}</span>
			</td>
			<td><a href="{{ route('guru.mapel.nilai-sikap.edit', [$mapel->id, $kelas->id, $kelas->semester, $siswa->id]) }}"><b class="glyphicon glyphicon-pencil"></b></a></td>
			<td><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
		</tr>
	@endforeach
</tbody>