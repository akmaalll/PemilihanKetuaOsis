<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\KetosContract;
use App\Models\Ketos;

class KetosRepository extends BaseRepository implements KetosContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(Ketos $model)
	{
		$this->model = $model;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'desc';
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
	}
public function scopePaginated($query, $id = null)
{
    return $query->with(['calonKetos', 'kriteria'])
        ->when($id, function($q) use ($id) {
            $q->where('id_ketos', $id);
        })
        ->orderBy('calonKetos.nama', 'asc')
        ->get()
        ->map(function($item) {
            return [
                'id' => $item->id,
                'nama' => $item->calonKetos->nama,
                'kriteria' => $item->kriteria->kriteria,
                'ket' => $item->kriteria->ket,
                'skor' => $item->skor
            ];
        });
}
}