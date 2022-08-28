<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Auth::user()->tarefas()->get();
    }

    public function headings(): array
    {
        return [
            'ID da Tarefa',
            'Tarefa',
            'Data Limite Conclusão',
        ];
    }

    public function map($tarefa): array
    {
        return [
            $tarefa->id,
            $tarefa->tarefa,
            date('d/m/Y', strtotime($tarefa->data_limite_conclusao)),
        ];
    }
}
