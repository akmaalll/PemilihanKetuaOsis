<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\SawMethodContract;
use App\Models\Ketos;
use App\Models\Kriteria;
use App\Models\NilaiKetos;
use Illuminate\Http\Request;

class SawMethodController extends Controller
{
    protected $sawRepo;

    public function __construct(SawMethodContract $sawRepo)
    {
        $this->sawRepo = $sawRepo;
    }

    public function index()
    {
        $results = $this->sawRepo->calculateSawResults();
        return view('admin.saw.index', [
            'title' => 'perhitungan-saw',
            'results' => $results
        ]);
    }
}
