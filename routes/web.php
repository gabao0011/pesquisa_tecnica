<?php

use App\Livewire\Formulario;
use Illuminate\Support\Facades\Route;

Route::get('/formulario', Formulario::class)->name('formulario');
