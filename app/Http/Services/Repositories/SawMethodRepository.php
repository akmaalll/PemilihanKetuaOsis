<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\SawMethodContract;
use App\Models\Ketos;
use App\Models\Kriteria;
use App\Models\NilaiKetos;
use App\Models\SawMethod;

class SawMethodRepository extends BaseRepository implements SawMethodContract
{
	/**
	 * @var
	 */
	protected $kriteria;
	protected $ketos;
	protected $nilaiKetos;

	public function __construct()
	{
		$this->kriteria = new Kriteria();
		$this->ketos = new Ketos();
		$this->nilaiKetos = new NilaiKetos();
	}

	public function calculateSawResults()
	{
		$data = $this->kriteria->orderBy('poin', 'DESC')->get();
		$ketos = $this->ketos->orderBy('nama', 'ASC')->get();

		// Inisialisasi variabel
		$table = [];
		$rowna = [];
		$rowMax = [];
		$kali = [];
		$hasil = [];
		$infoMatrix = [];
		$info = [];
		$xnama = [];

		// Membuat matriks awal
		foreach ($ketos as $i => $ix) {
			$xnama[$i] = $ix->nama;
			foreach ($data as $j => $an) {
				$skor = $this->nilaiKetos
					->where('id_ketos', $ix->id)
					->where('id_kriteria', $an->id)
					->first();

				$table[$i][$j] = $skor ? $skor->skor : 0;
			}
		}


		// Transpose matriks untuk mencari nilai max
		foreach ($data as $i => $ix) {
			foreach ($ketos as $j => $an) {
				$rowna[$i][$j] = $table[$j][$i];
			}
			$rowMax[$i] = max($rowna[$i]);
		}

		// Normalisasi matriks
		foreach ($ketos as $x => $it) {
			for ($m = 0; $m < count($data); $m++) {
				if ($rowMax[$m] == 0 || $table[$x][$m] == 0) {
					$kali[$x][$m] = 0;
					$infoMatrix[$x][$m] = ' - ';
				} else {
					$kali[$x][$m] = $table[$x][$m] / $rowMax[$m];
					$infoMatrix[$x][$m] = $table[$x][$m] . ' / ' . $rowMax[$m];
				}
			}
		}

		// Perhitungan hasil akhir
		foreach ($ketos as $x => $it) {
			$tempx = 0;
			foreach ($data as $m => $itemp) {
				$tempx += ($kali[$x][$m] * $itemp->poin);
				$info[$x][$m] = '(' . $kali[$x][$m] . ' * ' . ($itemp->poin / 100) . ')';
			}
			$hasil[$x] = $tempx / 100;
		}

		// Sorting hasil
		$n = count($hasil);
		for ($i = 0; $i < $n - 1; $i++) {
			for ($j = 0; $j < $n - $i - 1; $j++) {
				if ($hasil[$j] > $hasil[$j + 1]) {
					// Swap hasil
					$temp = $hasil[$j];
					$hasil[$j] = $hasil[$j + 1];
					$hasil[$j + 1] = $temp;

					// Swap nama
					$tempNama = $xnama[$j];
					$xnama[$j] = $xnama[$j + 1];
					$xnama[$j + 1] = $tempNama;
				}
			}
		}


		return [
			'data' => $data,
			'table' => $table,
			'ketos' => $ketos,
			'rowMax' => $rowMax,
			'kali' => $kali,
			'hasil' => $hasil,
			'info' => $info,
			'infoMatrix' => $infoMatrix,
			'ranking' => [
				'nama' => $xnama,
				'hasil' => $hasil
			]
		];
	}

	public function getNormalizedMatrix()
	{
		$results = $this->calculateSawResults();
		return [
			'matrix' => $results['table'],
			'normalized' => $results['kali'],
			'infoMatrix' => $results['infoMatrix']
		];
	}

	public function getFinalResults()
	{
		$results = $this->calculateSawResults();
		return [
			'ranking' => $results['ranking'],
			'details' => $results['info']
		];
	}
}
