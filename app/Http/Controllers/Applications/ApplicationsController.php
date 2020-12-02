<?php

namespace App\Http\Controllers\Applications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Application;

class ApplicationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/dashboards/application/index');
    }

    public function create()
    {
        return view('/dashboards/application/create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $storeData = $request->validate([
            'book_name' => 'required',
            'budget' => 'required',
            'file' => 'required',
        ]);

        $storeData['author_id'] = $user->id;
        $storeData['status'] = 'В ожиданий';

        Application::create($storeData);

        return view('/dashboards/application/create');
    }
}
