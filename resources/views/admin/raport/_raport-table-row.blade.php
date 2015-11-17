<?php

	$nilaiPengetahuan = $mapel->nilaiPengetahuan()->where('siswa_id', '=', $siswa->id)->where('semester', '=', $kelas->semester)->get();
	$nilaiKeterampilan = $mapel->nilaiKeterampilan()->where('siswa_id', '=', $siswa->id)->where('semester', '=', $kelas->semester)->get();
	$nilaiSikap = $mapel->nilaiSikap()->where('siswa_id', '=', $siswa->id)->where('semester', '=', $kelas->semester)->get();

	$nilai = ['pengetahuan' => [], 'keterampilan' => [], 'sikap' => []];
	
	if (count($nilaiPengetahuan) != 0) {
		foreach ($nilaiPengetahuan as $n) {
			$nilai['pengetahuan'][] += ($nilaiFormatter->countAverage([$n->tertulis, $n->observasi, $n->penugasan]));
		}
	}
	if (count($nilaiKeterampilan) != 0) {
		foreach ($nilaiKeterampilan as $n) {
			$nilai['keterampilan'][] += ($nilaiFormatter->countAverage([$n->praktek, $n->project, $n->produk, $n->portofolio, $n->tertulis]));
		}
	}
	if (count($nilaiSikap) != 0) {
		foreach ($nilaiSikap as $n) {
			$nilai['sikap'][] += ($nilaiFormatter->countAverage([$n->observasi, $n->penilaian_sendiri, $n->penilaian_sebaya, $n->jurnal]));
		}
	}
?>

<tr>
	<td class="text-center">{{ $i }}</td>
	<td>{{ $mapel->child->nama_mapel }}</td>
	<td class="text-center">{!! (count($nilai['pengetahuan']) != 0) ? $nilaiFormatter->transformToGrade($nilaiFormatter->countAverage($nilai['pengetahuan']))['html'] : '-' !!}</td>
	<td class="text-center">{!! (count($nilai['keterampilan']) != 0) ? $nilaiFormatter->transformToGrade($nilaiFormatter->countAverage($nilai['keterampilan']))['html'] : '-' !!}</td>
	<td class="text-center">{!! (count($nilai['sikap']) != 0) ? $nilaiFormatter->transformToSikap(round($nilaiFormatter->countAverage($nilai['sikap'])))['html'] : '-' !!}</td>
	<td></td>
</tr>