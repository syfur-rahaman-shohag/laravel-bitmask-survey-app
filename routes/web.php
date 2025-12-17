<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return redirect()->route('surveys.index');
});

Route::resource('surveys', SurveyController::class);
