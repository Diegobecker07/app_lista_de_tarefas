@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                Tarefas
                            </div>
                            <div class="col-4">
                                <div class="float-right">
                                    <a href="{{ route('tarefa.create') }}" class="mr-3">Novo</a>
                                    <a href="{{ route('tarefa.exportacao', ['extension' => 'csv']) }}" class="mr-3">CSV</a>
                                    <a href="{{ route('tarefa.exportacao', ['extension' => 'ods']) }}" class="mr-3">ODS</a>
                                    <a href="{{ route('tarefa.exportacao', ['extension' => 'xlsx']) }}" class="mr-3">XLSX</a>
                                    <a href="{{ route('tarefa.exportacao', ['extension' => 'pdf']) }}" class="mr-3">PDF</a>
                                    <a href="{{ route('tarefa.exportar') }}" target="_blank">PDF V2</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data limite conclusão</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{ $tarefa['id'] }}</th>
                                    <td>{{ $tarefa['tarefa'] }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tarefa['data_limite_conclusao'])) }}</td>
                                    <td><a href="{{ route('tarefa.edit', $tarefa['id']) }}">Editar</a></td>
                                    <td>
                                        <form method="POST" id="form_{{$tarefa['id']}}" action="{{ route('tarefa.destroy', $tarefa['id']) }}">
                                            @csrf
                                            @METHOD('DELETE')
                                            <a href="#" onclick="document.getElementById('form_{{$tarefa['id']}}').submit()">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Voltar</a></li>
                                @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Avançar</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
