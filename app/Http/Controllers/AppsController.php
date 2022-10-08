<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AppsController extends Controller
{
    public function index(): \Inertia\Response
    {
        $apps = App::where('user_id', auth()->id())->get()->map(function (App $app) {
            return array_merge(
                $app->toArray(),
                ['password' => Crypt::decryptString($app->password)]
            );
        })->toArray();


        return Inertia::render('Apps/Index', ['apps' => $apps]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Apps/FormPage');
    }

    public function store(Request $request): Redirector|Application|RedirectResponse
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

    public function update(App $app, Request $request)
    {
        $app->user_id = auth()->id();
        $app->name = $request->input('name');
        $app->description = $request->input('description');
        $app->url = $request->input('url');
        $app->user_name = $request->input('user_name');
        $app->password = Crypt::encryptString($request->input('password'));
        $app->save();

        return redirect('/apps');
    }

    public function show(App $app)
    {
        $app->password = Crypt::decryptString($app->password);
        return Inertia::render('Apps/FormPage', ['app' => $app]);
    }

    /**
     * @param App $app
     * @return Application|RedirectResponse|Redirector
     */
    public function delete(APP $app): Redirector|RedirectResponse|Application
    {
        $app->delete();
        return redirect('/apps');
    }
}
