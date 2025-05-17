<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Repositories\Contracts\KetosContract;
use App\Http\Services\Repositories\Contracts\NilaiKetosContract;
use Illuminate\Http\Request;

class NilaiKetosController extends Controller
{
    protected $title, $repo, $response, $ketos;

    public function __construct(NilaiKetosContract $repo, KetosContract $ketos)
    {
        $this->title = 'nilai-ketos';
        $this->repo = $repo;
        $this->ketos = $ketos;
    }

    public function index()
    {
        try {
            $title = $this->title;
            return view('admin.' . $title . '.index', compact('title'));
        } catch (\Exception $e) {
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    // public function data(Request $request)
    // {
    //     try {
    //         $title = $this->title;
    //         $data = $this->repo->scopePaginated($request->id);
    //         // dd($data);
    //         $perPage = $request->per_page == '' ? 5 : $request->per_page;
    //         $view = view('admin.' . $title . '.data', compact('data', 'title'))->with('i', ($request->input('page', 1) -
    //             1) * $perPage)->render();
    //         return response()->json([
    //             "html"       => $view,
    //         ]);
    //     } catch (\Exception $e) {
    //         dd($e);
    //         return view('errors.message', ['message' => $e->getMessage()]);
    //     }
    // }

    public function data(Request $request)
    {
        // try {
        //     $title = $this->title;
        //     $perPage = $request->per_page ?? 5;
        //     $data = $this->repo->scopePaginated($request->id, $perPage);

        //     // Transform data untuk memastikan struktur konsisten
        //     $transformedData = $data->map(function ($item) {
        //         return [
        //             'id' => $item->id,
        //             'nama' => $item->calonKetos->nama,
        //             'kriteria' => $item->kriteria->kriteria,
        //             'ket' => $item->ket,
        //             'skor' => $item->skor
        //         ];
        //     });

        //     $view = view('admin.' . $title . '.data', [
        //         'data' => $transformedData,
        //         'title' => $title,
        //         'i' => ($data->currentPage() - 1) * $perPage
        //     ])->render();

        //     return response()->json([
        //         "html" => $view,
        //         "current_page" => $data->currentPage(),
        //         "total" => $data->total()
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         "error" => $e->getMessage()
        //     ], 500);
        // }
    }
    public function create($id)
    {
        try {
            $title = $this->title;
            $data = $this->repo->getCalonWithKriteria($id);
            return view('admin.' . $title . '.form', compact('title', 'data', 'id'));
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $req = $request->all();
            $data = $this->repo->store($req);
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $data = $this->repo->find($id);
    //         return response()->json($data);
    //     } catch (\Exception $e) {
    //         return view('errors.message', ['message' => $e->getMessage()]);
    //     }
    // }


    public function edit($id)
    {
        try {
            $title = $this->title;
            $data = $this->repo->find($id);
            $ketos = $this->ketos->find($data->id_ketos);
            // dd($data);
            return view('admin.' . $title . '.form', compact('title', 'data', 'ketos'));
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $req = $request->all();
            $data = $this->repo->update($req, $request->id);
            return response()->json(['data' => $data, 'success' => true]);
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->repo->delete($id);

            if ($delete) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data deleted successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete data'
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function obser($id)
    {
        try {
            $title = $this->title;
            // dd($id);
            $data = $this->repo->scopePaginated($id);
            // dd($data);

            return view('admin.calon-ketos.obser', compact('title', 'data', 'id'));
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }
}
