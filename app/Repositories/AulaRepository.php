<?php

namespace App\Repositories;

use App\Http\Requests\AulaRequest;
use App\Models\Aula;
use Exception;

class AulaRepository
{
    protected $model;

    public function __construct(Aula $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $aulas = $this->model->all();

        if($aulas->isEmpty()) {
            return response()->json(['error' => 'Nenhum conteúdo encontrado'], 404);
        }

        return response()->json($aulas, 200);
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
        try {
            $aula = $this->model->findOrFail($id);
            $aula->delete();
            return response()->json(["message" => "Aula excluída com sucesso"]);
        } catch(Exception $e) {
            return response()->json([
                'message' => "Nenhuma aula com esse ID foi encontrada!",
                'status_code' => 404,
                $e->getMessage()
            ], 404);

        }
    }
}
