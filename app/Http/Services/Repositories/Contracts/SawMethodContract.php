<?php

namespace App\Http\Services\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SawMethodContract
{
	/**
	 * params string $search
	 * @return Collection
	 */

	public function calculateSawResults();
	public function getNormalizedMatrix();
	public function getFinalResults();
}
