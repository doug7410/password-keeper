<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AppsController extends Controller
{
    public function index(): \Inertia\Response
    {
        $apps = App::all()->map(function (App $app) {
            return array_merge(
                $app->toArray(),
                ['password' => Crypt::decryptString($app->password)]
            );
        })->toArray();


        return Inertia::render('Apps/Index', ['apps' => $apps]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Apps/Create');
    }

    public function store(Request $request)
    {
        $app = new App();
        $app->user_id = auth()->id();
        $app->name = $request->input('name');
        $app->description = $request->input('description');
        $app->url = $request->input('url');
        $app->user_name = $request->input('user_name');
        $app->password = Crypt::encryptString($request->input('password'));
        $app->save();

        return redirect('/apps');
    }
}
