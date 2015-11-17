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
				<?php $praktik = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'type' => 'keterampilan', 'field' => 'praktek']) ?>
				{!! rtrim($praktik['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $project = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'type' => 'keterampilan', 'field' => 'project']) ?>
				{!! rtrim($project['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $produk = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'type' => 'keterampilan', 'field' => 'produk']) ?>
				{!! rtrim($produk['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $portofolio = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'type' => 'keterampilan', 'field' => 'portofolio']) ?>
				{!! rtrim($portofolio['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php $tertulis = $nilaiFormater->listingNilaiFromKompetensi($kompetensi_dasar, ['mapel_id' => $mapel->id, 'siswa_id' => $siswa->id, 'type' => 'keterampilan', 'field' => 'tertulis']) ?>
				{!! rtrim($tertulis['text'], ', ') !!}
			</td>
			<td class="text-center">
				<?php 
					$praktik_akhir = $nilaiFormater->countAverage($praktik['value']);; 
					$project_akhir = $nilaiFormater->countAverage($project['value']);; 
					$produk_akhir = $nilaiFormater->countAverage($produk['value']);; 
					$portofolio_akhir = $nilaiFormater->countAverage($portofolio['value']);; 
					$tertulis_akhir = $nilaiFormater->countAverage($tertulis['value']);; 

					$nilai_akhir = $nilaiFormater->countAverage([$praktik_akhir, $project_akhir, $produk_akhir, $portofolio_akhir, $tertulis_akhir]);
				?>
				<span class="text-info">{{ round($nilai_akhir, 2) }}</span>
			</td>
			<td class="text-center">
				{!! $nilaiFormater->transformToGrade($nilai_akhir)['html'] !!}
			</td>
			<td><a href="{{ route('admin.nilai-keterampilan.edit', [$mapel->id, $kelas->id, $kelas->semester, $siswa->id]) }}"><b class="glyphicon glyphicon-pencil"></b></a></td>
			<td><a href="#"><b class="glyphicon glyphicon-trash"></b></a></td>
		</tr>
	@endforeach
</tbody>