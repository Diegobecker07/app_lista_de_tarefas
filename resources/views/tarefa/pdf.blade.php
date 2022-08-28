<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            .titulo {
                text-align: center;
                font-size: 20px;
                font-weight: bold;
                text-transform: uppercase;
                width: 100%;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2
            }

            th {
                background-color: #4CAF50;
                color: white;
            }
        </style>
    </head>
    <body>
        <h2 class="titulo">Lista de tarefas</h2>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Tarefa</th>
                <th>Data limite conclusão</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa['id'] }}</td>
                    <td>{{ $tarefa['tarefa'] }}</td>
                    <td>{{ date('d/m/Y', strtotime($tarefa['data_limite_conclusao'])) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
