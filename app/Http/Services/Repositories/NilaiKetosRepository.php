<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\NilaiKetosContract;
use App\Models\Ketos;
use App\Models\Kriteria;
use App\Models\NilaiKetos;

class NilaiKetosRepository extends BaseRepository implements NilaiKetosContract
{
	/**
	 * @var
	 */
	protected $model;
	protected $kriteria;
	protected $calonKetos;

	public function __construct(NilaiKetos $model, Kriteria $kriteria,  Ketos $calonKetos)
	{
		$this->model = $model;
		// dd($this->model);
		$this->kriteria = $kriteria;
		$this->calonKetos = $calonKetos;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
	}


	public function scopePaginated($id = null)
	{
		return $this->model
			->with(['calonKetos', 'kriteria'])
			->when($id, function ($q) use ($id) {
				$q->where('id_ketos', $id);
			})
			->get()
			->sortBy(function ($item) {
				return $item->calonKetos->nama;
			})
			->map(function ($item) {
				return [
					'id' => $item->id,
					'nama' => $item->calonKetos->nama,
					'kriteria' => $item->kriteria->kriteria,
					'ket' => $item->kriteria->ket,
					'skor' => $item->skor
				];
			});
	}

	// public function scopePaginated($id = null, $perPage = 5)
	// {
	// 	$query = $this->model
	// 		->with(['calonKetos', 'kriteria'])
	// 		->whereHas('calonKetos', function ($q) use ($id) {
	// 			if ($id) {
	// 				$q->where('id', $id);
	// 			}
	// 		})
	// 		->join('calon_ketos', 'calon_ketos.id', '=', 'nilai_ketos.id_ketos')
	// 		->select('nilai_ketos.*')
	// 		->orderBy('calon_ketos.nama');

	// 	return $query->paginate($perPage);
	// }

	public function getCalonWithKriteria($id)
	{
		$calon = $this->calonKetos->with(['nilaiKetos.kriteria'])->find($id);
		$kriteria = $this->kriteria->all();

		return [
			'calon' => $calon,
			'kriteria' => $kriteria,
			'nilai' => $calon->nilaiKetos ?? []
		];
	}
}
