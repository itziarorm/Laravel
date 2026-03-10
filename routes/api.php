<?php

use App\Http\Controllers\PotionController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\WizardController;

Route::apiResource('potions', PotionController::class);
Route::apiResource('ingredients', IngredientController::class);
Route::apiResource('wizards', WizardController::class);