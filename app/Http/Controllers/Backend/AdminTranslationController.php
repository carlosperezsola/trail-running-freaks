<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTranslationController extends Controller
{
    public function index()
    {
        // Aquí podrías realizar una lógica específica para la extensión.
        // Si la extensión maneja su propia lógica, podrías simplemente redirigir.
        
        // Ejemplo: Redirigir a la URL de la extensión
        return redirect()->to('translations');
        
        // Si la extensión ya maneja la vista, solo asegúrate de que no necesitas más lógica aquí.
    }
}
