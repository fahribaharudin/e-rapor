<?php

/*
 |----------------------------------------------------------------
 | AJAX Request Routes
 |----------------------------------------------------------------
 |
 | Pada file ini terdapat semua routes yang digunakan untuk feed
 | sebuah ajax request misal dropdown, dll.
 |
 */


Route::get('/admin/mapel/select-box-feed/bidang', [
	'as' => 'admin.mapel.select-box-feed.bidang', 
	'uses' => 'Admin\MapelController@selectBoxFeedBidang'
]);
Route::get('/admin/mapel/select-box-feed/program/{bidang_id}', [
	'as' => 'admin.mapel.select-box-feed.program', 
	'uses' => 'Admin\MapelController@selectBoxFeedProgram'
]);
Route::get('/admin/mapel/select-box-feed/paket/{program_id}', [
	'as' => 'admin.mapel.select-box-feed.paket',  
	'uses' => 'Admin\MapelController@selectBoxFeedPaket'
]);
Route::get('/admin/kompetensi-dasar/select-box-feed/mapel/{paket_id}', [
	'as' => 'admin.kompetensi-dasar.select-box-feed.mapel', 
	'uses' => 'Admin\MapelController@selectBoxFeedMapel'
]);

Route::get('/admin/nilai-pengetahuan/dropdown/kelas', [
	'as' => 'admin.nilai-pengetahuan.dropdown.kelas', 
	'uses' => 'Admin\NilaiPengetahuanController@kelasDropDown'
]);
Route::get('/admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester', [
	'as' => 'admin.nilai-pengetahuan.dropdown.semester', 
	'uses' => 'Admin\NilaiPengetahuanController@semesterFromKelasDropDown'
]);
Route::get('/admin/nilai-pengetahuan/dropdown/kelas/{kelas_id}/semester/{semester}/mapel', [
	'as' => 'admin.nilai-pengetahuan.dropdown.semester.mapel', 
	'uses' => 'Admin\NilaiPengetahuanController@mapelFromSemesterFromKelas'
]);

Route::get('/guru/nilai-pengetahuan/dropdown/mapel', function() {
	$mapels = [];
	foreach(Auth::user()->owner->mapel as $mapel) {
		$mapels[] = [
			'id' => $mapel->id,
			'paket_id' => $mapel->paket_id,
			'paket_nama' => $mapel->paketKeahlian->nama,
			'semester' => $mapel->pivot->semester,
			'nama' => $mapel->child->nama_mapel
		];
	}

	return $mapels;
});

Route::get('/guru/nilai-pengetahuan/dropdown/mapel/{mapel_id}/semester/{semester}', function($mapel_id, $semester, App\Repositories\KelasRepository $kelasRepo, App\Repositories\MapelRepository $mapelRepo) {
	$mapel = $mapelRepo->mapel->find($mapel_id);
	$kelas = $kelasRepo->kelas->where('paket_id', '=', $mapel->paket_id)->get();

	$kelas = $kelas->filter(function($kelas) use ($mapel, $semester) {
		if ($semester == 1) {
			if ($kelas->tingkat_kelas == 1) {
				return $kelas;
			}
		} elseif ($semester == 2) {
			if ($kelas->tingkat_kelas == 1) {
				return $kelas;
			}
		} elseif ($semester == 3) {
			if ($kelas->tingkat_kelas == 2) {
				return $kelas;
			}
		} elseif ($semester == 4) {
			if ($kelas->tingkat_kelas == 2) {
				return $kelas;
			}
		} elseif ($semester == 5) {
			if ($kelas->tingkat_kelas == 3) {
				return $kelas;
			}
		} elseif ($semester == 6) {
			if ($kelas->tingkat_kelas == 3) {
				return $kelas;
			}
		}
	});

	$kelass = [];
	foreach ($kelas as $k) {
		$kelass[] = $k;
	}
	
	return $kelass;
});