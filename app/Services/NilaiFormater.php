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
		$ave = $ave / count($nilai);

		return round($ave, 2);
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

}