<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ketos;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $ketos = Ketos::all()->count();
        $kriteria = Kriteria::all()->count();
        return view('admin.dashboard', compact('ketos', 'kriteria'));
    }
}
