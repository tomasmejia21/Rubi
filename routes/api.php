<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReactEducationalInstitutionController;

// Administrar instituciones educativas - Solo administradores
// Route::middleware(['role:administrator'])->group(function () {
//     Route::apiResource('educationalinstitutions', EducationalInstitutionController::class);
// });

Route::apiResource('educationalinstitutions', ReactEducationalInstitutionController::class);