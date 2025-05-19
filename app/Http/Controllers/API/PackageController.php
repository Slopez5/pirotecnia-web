<?php

namespace App\Http\Controllers\API;

use App\Core\UseCases\Packages\GetAllPackages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //

    public function index()
    {
        $packages = app(GetAllPackages::class)->execute(request()->get('page', 1));

        return response()->success($packages, 200);
    }

    public function show($id) {}

    public function store(Request $request) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
