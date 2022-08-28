<?php

namespace App\Http\Controllers;

use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tarefas = Tarefa::where('user_id', auth()->user()->id)->paginate(5);
        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    public function create()
    {
        return view('tarefa.create');
    }

    public function store(Request $request)
    {
        $dados = $request->all(['tarefa', 'data_limite_conclusao']);
        $dados['user_id'] = auth()->user()->id;
        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    public function edit(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');
        }

        return view('tarefa.edit', ['tarefa' => $tarefa]);
    }

    public function update(Request $request, Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');
        }

        $tarefa->update($request->all(['tarefa', 'data_limite_conclusao']));
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    public function destroy(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');
        }

        $tarefa->delete();
        return redirect()->route('tarefa.index');
    }

    public function exportacao($extensao)
    {
        if(!in_array($extensao, ['xlsx', 'csv', 'ods', 'pdf'])){
            return redirect()->route('tarefa.index');
        }
        return Excel::download(new \App\Exports\TarefasExport(), "lista_de_tarefas.{$extensao}");
    }

    public function exportar()
    {
        return Pdf::loadView('tarefa.pdf', ['tarefas' => \Auth::user()->tarefas()->get()])->setPaper('a4', 'portrait')->stream('lista_de_tarefas.pdf');
    }
}
