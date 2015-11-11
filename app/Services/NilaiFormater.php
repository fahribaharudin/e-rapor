<?php 

namespace App\Services;

class NilaiFormater
{

	/**
	 * Counting the average of the given $nilai in array
	 * 
	 * @param  array  $nilai 
	 * @return float        
	 */
	public function countAverage(array $nilai)
	{
		$ave = 0;
		foreach ($nilai as $n) {
			$ave += $n;
		}
		$ave = $ave / (count($nilai));

		return round($ave, 2);
	}


	/**
	 * Listing all nilai from kompetensi dasar
	 * @param  Eloquent $kompetensi_dasar 
	 * @param  array  $data             
	 * @return array                   
	 */
	public function listingNilaiFromKompetensi($kompetensi_dasar, array $data)
	{
		$nilai_output = ['text' => '', 'value' => []];
		foreach ($kompetensi_dasar as $kompetensi) {
			if ($data['type'] == 'pengetahuan') {
				$nilai = $kompetensi->nilaiPengetahuan()
					->where('mapel_id', '=', $data['mapel_id'])
					->where('siswa_id', '=', $data['siswa_id'])
					->where('kompetensi_id', '=', $kompetensi->id)
					->first();
			} elseif ($data['type'] == 'keterampilan') {
				$nilai = $kompetensi->nilaiKeterampilan()
					->where('mapel_id', '=', $data['mapel_id'])
					->where('siswa_id', '=', $data['siswa_id'])
					->where('kompetensi_id', '=', $kompetensi->id)
					->first();
			} elseif ($data['type'] == 'sikap') {
				$nilai = $kompetensi->nilaiSikap()
					->where('mapel_id', '=', $data['mapel_id'])
					->where('siswa_id', '=', $data['siswa_id'])
					->where('kompetensi_id', '=', $kompetensi->id)
					->first();
			}

			if ($nilai != NULL) {
				$nilai_output['text'] .= '<span class="badge">' . $nilai->$data['field'] . '</span> ';
				$nilai_output['value'][] = $nilai->$data['field'];
			}
			else {
				$nilai_output['text'] .= '-, ';
				$nilai_output['value'][] = 0;
			}
		}

		return $nilai_output;
	}


	/**
	 * Transforming float $nilai to string Grade of that $nilai
	 * 
	 * @param  float $nilai 
	 * @return string
	 */
	public function transformToGrade($nilai)
	{
		$grade = [];

		if ($nilai >= 1 && $nilai <= 1.17) {
			$grade['plain'] = 'D'; 
			$grade['html'] = '<span class="label-danger label">D</span>';
		} elseif ($nilai >= 1.18 && $nilai <= 1.5) {
			$grade['plain'] = 'D+'; 
			$grade['html'] = '<span class="label-danger label">D+</span>';
		} elseif ($nilai >= 1.51 && $nilai <= 1.84) {
			$grade['plain'] = 'C-'; 
			$grade['html'] = '<span class="label-warning label">C-</span>';
		} elseif ($nilai >= 1.85 && $nilai <= 2.17) {
			$grade['plain'] = 'C'; 
			$grade['html'] = '<span class="label-warning label">C</span>';
		} elseif ($nilai >= 2.18 && $nilai <= 2.50) {
			$grade['plain'] = 'C+'; 
			$grade['html'] = '<span class="label-warning label">C+</span>';
		} elseif ($nilai >= 2.51 && $nilai <= 2.84) {
			$grade['plain'] = 'B-'; 
			$grade['html'] = '<span class="label-primary label">B-</span>';
		} elseif ($nilai >= 2.85 && $nilai <= 3.17) {
			$grade['plain'] = 'B'; 
			$grade['html'] = '<span class="label-primary label">B</span>';
		} elseif ($nilai >= 3.18 && $nilai <= 3.50) {
			$grade['plain'] = 'B+'; 
			$grade['html'] = '<span class="label-primary label">B+</span>';
		} elseif ($nilai >= 3.51 && $nilai <= 3.84) {
			$grade['plain'] = 'A-'; 
			$grade['html'] = '<span class="label-success label">A-</span>';
		} elseif ($nilai >= 3.85 && $nilai <= 4.00) {
			$grade['plain'] = 'A'; 
			$grade['html'] = '<span class="label-success label">A</span>';
		} else {
			$grade['plain'] = '-';
			$grade['html'] = '-';
		}

		return $grade;
	}


	/**
	 * Transforming float $nilai to string Sikap of that $nilai
	 * 
	 * @param  float $nilai 
	 * @return string
	 */
	public function transformToSikap($nilai)
	{
		$sikap = [];

		if ($nilai >= 1 && $nilai <= 1.99) {
			$sikap['plain'] = 'Kurang'; 
			$sikap['html'] = '<span class="label-danger label">Kurang</span>';
		} elseif ($nilai >= 2.00 && $nilai <= 2.99) {
			$sikap['plain'] = 'Cukup'; 
			$sikap['html'] = '<span class="label-warning label">Cukup</span>';
		} elseif ($nilai >= 3.00 && $nilai <= 3.99) {
			$sikap['plain'] = 'Baik'; 
			$sikap['html'] = '<span class="label-primary label">Baik</span>';
		} elseif ($nilai >= 4 && $nilai <= 4) {
			$sikap['plain'] = 'Baik Sekali'; 
			$sikap['html'] = '<span class="label-success label">Baik Sekali</span>';
		} else {
			$sikap['plain'] = '-';
			$sikap['html'] = '-';
		}

		return $sikap;		
	}

}