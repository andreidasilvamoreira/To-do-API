<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use http\Env\Response;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function findAll() {
        return response()->json(Tarefa::all(), 200);
    }

    public function find($id)
    {
        $tarefa = Tarefa::find($id);
        if (!$tarefa) {
            return response()->json(['erro' => 'Tarefa não encontrada'], 404);
        }
        return response()->json($tarefa, 200);
    }

    public function create(Request $request)
    {
        $validacao = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);
        $tarefa = Tarefa::create($validacao);
        return response()->json($tarefa, 201);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::find($id);

        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }
        $validacao = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

        $tarefa->update($validacao);
        return response()->json($tarefa, 200);
    }

    public function delete($id)
    {
        $tarefa = Tarefa::find($id);
        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $tarefa->delete();
        return response()->json(['message' => 'Tarefa excluida com sucesso!',],200);
    }
}
