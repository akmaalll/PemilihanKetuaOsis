<?php

namespace App\Http\Controllers;

use App\Http\Services\Repositories\Contracts\UsersContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    protected $repo;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsersContract $repo)
    {
        // $this->middleware('auth');
        $this->repo = $repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $r)
    {
        try {
            $req = $r->all();
            $userData = [
                'name' => $req['name'],
                'username' => $req['username'],
                'email' => $req['email'],
                'password' => Hash::make($req['password']),
                'id_role' => $req['id_role'],
            ];
            $data = $this->repo->store($userData);

            if ($data) {
                return redirect()->route('admin.login');
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            return view('errors.message', ['message' => $e->getMessage()]);
        }
    }

    public function registerSuccess()
    {
        return view('auth.message');
    }
}
