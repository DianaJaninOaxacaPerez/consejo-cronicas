<?php
use Illuminate\Support\Facades\Route;
use App\Models\Historia;
use App\Models\Galeria;
use App\Models\Evento;
use App\Models\Noticia;
use App\Models\Entrevista;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CronicaController;
use App\Models\Cronista;

/*
|--------------------------------------------------------------------------
| Rutas públicas (front - sitio del Consejo)
|--------------------------------------------------------------------------
*/
Route::view('/', 'inicio')->name('inicio');

Route::get('/historia', function (\Illuminate\Http\Request $request) {

    $query = Historia::query();

    if ($request->filled('q')) {
        $query->where('titulo', 'like', '%'.$request->q.'%');
    }

    if ($request->filled('categoria')) {
        $query->where('categoria', $request->categoria);
    }

    if ($request->filled('autor')) {
        $query->where('autor', 'like', '%'.$request->autor.'%');
    }

    if ($request->filled('desde')) {
        $query->whereDate('fecha_creacion', '>=', $request->desde);
    }
    if ($request->filled('hasta')) {
        $query->whereDate('fecha_creacion', '<=', $request->hasta);
    }

    $orden = $request->get('orden', 'reciente');
    $query->orderBy('fecha_creacion', $orden === 'antigua' ? 'asc' : 'desc');

    $historias = $query->paginate(9)->withQueryString();

    return view('historia', [
        'historias'  => $historias,
        'categorias' => Historia::CATEGORIAS,
    ]);

})->name('historia');


Route::get('/cronicas', function () {
    $cronicas = \App\Models\Cronica::orderByDesc('id_cronica')->get();
    return view('cronicas', compact('cronicas'));
})->name('cronicas');

Route::get('/galeria', function (\Illuminate\Http\Request $request) {

    $query = Galeria::query();

    if ($request->filled('titulo')) {
        $query->where('titulo', 'like', '%'.$request->titulo.'%');
    }
    if ($request->filled('descripcion')) {
        $query->where('descripcion', 'like', '%'.$request->descripcion.'%');
    }
    if ($request->filled('categoria')) {
        $query->where('categoria', $request->categoria);
    }

    $imagenes = $query->orderByDesc('id_galeria')->get();

    return view('galeria', [
        'imagenes'   => $imagenes,
        'categorias' => Galeria::CATEGORIAS,
    ]);

})->name('galeria');


Route::get('/eventos', function () {
    $eventos = Evento::orderByDesc('id_evento')->get();
    return view('eventos', compact('eventos'));
})->name('eventos');
Route::get('/noticias', function () {
    $noticias = Noticia::orderByDesc('id_noticia')->get();
    return view('noticias', compact('noticias'));
})->name('noticias');
Route::get('/noticias/{id}', function ($id) {
    $noticia = Noticia::findOrFail($id);
    return view('ver_noticia', compact('noticia'));
})->name('noticias.show');
Route::get('/entrevistas', function () {
    $entrevistas = Entrevista::orderByDesc('id')->get();
    return view('entrevistas', compact('entrevistas'));
})->name('entrevistas');
Route::get('/entrevistas/{id}', function ($id) {
    $entrevista = Entrevista::findOrFail($id);
    return view('ver_entrevista', compact('entrevista'));
})->name('entrevistas.show');
Route::get('/perfiles', function () {
    $cronistas = Cronista::orderBy('id_cronista')->get();
    return view('perfiles', compact('cronistas'));
})->name('perfiles');
Route::get('/perfiles/{id}', function ($id) {
    $cronista = Cronista::findOrFail($id);
    return view('ver_perfiles', compact('cronista'));  // ← cambia aquí
})->name('perfiles.show');
Route::get('/videos', function () {
    $videos = \App\Models\Video::orderByDesc('id_video')->get();
    return view('videos', compact('videos'));
})->name('videos');
Route::get('/videos/{id}', function ($id) {
    $video = \App\Models\Video::findOrFail($id);
    return view('ver_video', compact('video'));
})->name('videos.show');


/*Rutas administrativas (back - Livewire Starter Kit*/
/* Login */
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
/* Rutas administrativas */
Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');



    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('cronicas', CronicaController::class)->parameters([
            'cronicas' => 'cronica'
        ]);
        Route::resource('historias', \App\Http\Controllers\Admin\HistoriaController::class)->parameters([
            'historias' => 'historia'
        ]);
        Route::resource('galeria', \App\Http\Controllers\Admin\GaleriaController::class);
        Route::resource('eventos', \App\Http\Controllers\Admin\EventoController::class);
        Route::resource('noticias', \App\Http\Controllers\Admin\NoticiaController::class);
        Route::delete('noticias-imagenes/{imagene}', [\App\Http\Controllers\Admin\NoticiaController::class, 'destroyImagen'])->name('noticias.imagenes.destroy');
        Route::resource('entrevistas', \App\Http\Controllers\Admin\EntrevistaController::class);
        Route::get('configuracion', [\App\Http\Controllers\Admin\ConfiguracionController::class, 'edit'])->name('configuracion.edit');
        Route::post('configuracion', [\App\Http\Controllers\Admin\ConfiguracionController::class, 'update'])->name('configuracion.update');
        Route::resource('cronistas', \App\Http\Controllers\Admin\CronistaController::class)->parameters(['cronistas' => 'cronista']);
        Route::resource('usuarios', \App\Http\Controllers\Admin\UsuarioController::class)->parameters(['usuarios' => 'usuario']);
        Route::resource('videos', \App\Http\Controllers\Admin\VideoController::class);
        Route::get('mesas', [\App\Http\Controllers\Admin\MesaController::class, 'index'])->name('mesas.index');
        Route::put('mesas/{mesa}', [\App\Http\Controllers\Admin\MesaController::class, 'update'])->name('mesas.update');
        Route::resource('registros-evento', \App\Http\Controllers\Admin\RegistroEventoController::class)->only(['index', 'destroy']);





    });


});

Route::get('/evento/confirmar', [\App\Http\Controllers\AsistenciaController::class, 'form'])->name('evento.confirmar.form');
Route::post('/evento/confirmar', [\App\Http\Controllers\AsistenciaController::class, 'store'])->name('evento.confirmar.store');
Route::get('/evento/confirmado/{registro}', [\App\Http\Controllers\AsistenciaController::class, 'confirmado'])->name('evento.confirmado');

require __DIR__.'/settings.php';