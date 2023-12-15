<?php

namespace App\Http\Controllers;

use App\Http\Requests\AulaRequest;
use App\Models\Aula;
use App\Services\AulaService;
use GuzzleHttp\Psr7\Request;

class AulaController extends Controller
{
    protected $service;

    public function __construct(AulaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $search = Request('search');

        if ($search) {
            return Aula::where([
                ['category', 'like', '%' . $search . '%']
            ])->get();
        } else {
            return $this->service->getAll();
        }
    }

    public function store(AulaRequest $request)
    {
        $aula = $this->service->create($request);
        return response()->json($aula, 201);
    }

    public function update(AulaRequest $request, $id)
    {
        $aulaEditada = $this->service->update($request, $id);
        return response()->json($aulaEditada);
    }

    public function show($id)
    {
        $aula = $this->service->getById($id);
        return response()->json($aula, 200);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }

    public function categoryVue()
    {
        return Aula::where([
            ['category', 'like', '%' . 'Python' . '%']
        ])->get();
    }
}
