<?php

namespace App\Http\Services\Repositories;

use App\Http\Services\Repositories\BaseRepository;
use App\Http\Services\Repositories\Contracts\KriteriaContract;
use App\Models\Kriteria;

class KriteriaRepository extends BaseRepository implements KriteriaContract
{
	/**
	 * @var
	 */
	protected $model;

	public function __construct(Kriteria $model)
	{
		$this->model = $model;
	}

	public function paginated(array $criteria)
	{
		$perPage = $criteria['per_page'] ?? 5;
		$field = $criteria['sort_field'] ?? 'id';
		$sortOrder = $criteria['sort_order'] ?? 'asc';
		return $this->model->orderBy($field, $sortOrder)->paginate($perPage);
	}
}
