<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('tarefa', TarefaController::class)->middleware('verified');

Route::get('/export/tarefas/download/{extension}', [TarefaController::class, 'exportacao'])->name('tarefa.exportacao');
Route::get('/export/tarefas/download-pdf-v2', [TarefaController::class, 'exportar'])->name('tarefa.exportar');

Route::get('/mensagem-teste', function (){
   \Illuminate\Support\Facades\Mail::to(env('MAIL_USERNAME'))->send(new \App\Mail\MensagemTesteMail());
   return 'Sucesso';
});
