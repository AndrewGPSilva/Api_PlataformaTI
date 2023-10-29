<?php

namespace App\Repositories;

use App\Http\Requests\AulaRequest;
use App\Models\Aula;

class AulaRepository
{
    protected $model;

    public function __construct(Aula $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $aula = $this->model->all();
        return response()->json($aula, 200);
    }

    public function create(AulaRequest $request)
    {
        $dados = $request->all();
        $aula = $this->model->create($dados);
        return response()->json($aula, 201);
    }

    public function update(AulaRequest $request, $id)
    {
        $aula = $this->model->findOrFail($id);
        $aulaDados = $request->all();
        $aula->update($aulaDados);
        return response()->json($aula, 200);
    }

    public function getById($id)
    {
        $aula = $this->model->findOrFail($id);
        return response()->json($aula, 200);
    }

    public function delete($id)
    {
        $aula = $this->model->findOrFail($id);
        $aula->delete();
        return response()->json(["message" => "Aula excluída com sucesso"]);
    }
}
