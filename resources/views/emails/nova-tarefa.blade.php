@component('mail::message')
# {{ $tarefa }}

Data limite de conclusão: {{ $data_limite_conclusao }}

@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
