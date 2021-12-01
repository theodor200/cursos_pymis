<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Exports\AlumnosExport;
use App\Exports\AsginacionCursoDocenteExport;
use App\Exports\CategoriasCursosExport;
use App\Exports\CursosExport;
use App\Exports\EmpresasExport;
use App\Mail\WelcomeMailAlumno;
use App\Exports\DocentesExport;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('storage-link', function () {
    Artisan::call('storage:link');
});*/

Route::get('/email', function () {
    return new WelcomeMailAlumno();
})->middleware('auth');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes();
Route::match(['get', 'post'],'cursos/{id}/get','CursosController@getCursos')->name('cursos.get')->middleware('auth');


Route::resource('empresas','EmpresasController')->middleware(['auth','admin']);
Route::resource('docentes','DocentesController')->middleware(['auth','admin']);
Route::resource('categorias_cursos','CategoriasCursosController')->middleware(['auth','admin']);
Route::resource('cursos','CursosController')->middleware(['auth','admin']);

Route::post('actualizar_logotipo_curso','CursosController@update_logotipo')->name('update_logotipo.update')->middleware(['auth','admin']);/*Listo*/

Route::resource('asignacion_cursos','AsignacionCursosController')->middleware(['auth','admin']);
Route::get('alumnos','AlumnosController@index')->middleware(['auth','admin']);

Route::get('/excel_docentes', function () {
    return Excel::download(new DocentesExport, 'docentes.xlsx');
})->middleware(['auth','admin']);

Route::get('/excel_empresas', function () {
    return Excel::download(new EmpresasExport, 'empresas.xlsx');
})->middleware(['auth','admin']);

Route::get('/excel_categorias_cursos', function () {
    return Excel::download(new CategoriasCursosExport, 'categorias_cursos.xlsx');
})->middleware(['auth','admin']);

Route::get('/excel_cursos', function () {
    return Excel::download(new CursosExport, 'cursos.xlsx');
})->middleware(['auth','admin']);

Route::get('/excel_asignacion_cursos', function () {
    return Excel::download(new AsginacionCursoDocenteExport, 'asignacion_cursos.xlsx');
})->middleware(['auth','admin']);

Route::get('/excel_alumnos', function () {
    return Excel::download(new AlumnosExport, 'alumnos.xlsx');
})->middleware(['auth','admin']);


Route::get('provincias/{id}','ProvinciasController@getProvincias')->middleware('auth');
Route::get('distritos/{id}','DistritosController@getDistritos')->middleware('auth');

/* --- Route para docentes ----*/
Route::get('mis_cursos_asignados/{id}','AsignacionCursoDocenteController@show')->name('asignacion_cursos_docente.show')->middleware(['auth','docente']);/*Listo*/
Route::get('perfil_docente/{id}/edit','PerfilDocenteController@edit')->name('perfil_docente.edit')->middleware(['auth','docente']);/*Listo*/
Route::patch('perfil_docente/{id}','PerfilDocenteController@update')->name('perfil_docente.update')->middleware(['auth','docente']);/*Listo*/
Route::get('registrar_notas/{id}','NotasController@show')->name('registrar_notas.show')->middleware(['auth','docente']);/*Listo*/
Route::patch('actualizar_notas/{id}','NotasController@update')->name('registrar_notas.update')->middleware(['auth','docente']);/*Listo*/

Route::get('modulo_lista/{id}','ModulosController@index')->name('modulos_index')->middleware(['auth','docente']);
Route::get('modulo/{id}','ModulosController@show')->name('modulos_show')->middleware(['auth','docente']);
Route::get('modulo/create/{id}','ModulosController@create')->name('modulos_create')->middleware(['auth','docente']);
Route::post('modulo','ModulosController@store')->name('modulos_store')->middleware(['auth','docente']);
Route::delete('modulo/{id}/delete','ModulosController@destroy')->name('modulos_delete')->middleware(['auth','docente']);
Route::get('modulo/{id}/edit','ModulosController@edit')->name('modulos_edit')->middleware(['auth','docente']);
Route::patch('modulo/{id}/update','ModulosController@update')->name('modulos_edit.update')->middleware(['auth','docente']);

/* --- Route para alumnos ----*/
Route::get('perfil_alumno/{id}/edit','PerfilAlumnoController@edit')->name('perfil_alumno.edit')->middleware(['auth','alumno']);/*Listo*/
Route::patch('perfil_alumno/{id}','PerfilAlumnoController@update')->name('perfil_alumno.update')->middleware(['auth','alumno']);/*Listo*/
Route::get('inscripciones_cursos','InscripcionesCursoAlumnoController@index')->name('inscripciones_cursos.index')->middleware(['auth','alumno']);/*Listo*/
Route::post('inscripciones_cursos','InscripcionesCursoAlumnoController@store')->name('guardar_inscripcion_curso.index')->middleware(['auth','alumno']);
Route::delete('inscripciones_cursos/{id}','InscripcionesCursoAlumnoController@destroy')->name('eliminar_inscripcion_curso.index')->middleware(['auth','alumno']);
Route::get('ver_notas/{id}','NotasController@show_notas_alumno')->name('ver_notas.index')->middleware(['auth','alumno']);/*listo*/
Route::get('ver_certificado/{id}/{user}','CertificadoController@show')->name('ver_certificado.index')->middleware(['auth']);/*Listo*/


Route::get('ver_certificado_ejemplo/{id}/curso','CertificadoController@ejemplo')->name('ver_certificado_ejemplo.index')->middleware(['auth','admin']);/*Listo*/


Route::get('modulo/{id}/view','ModulosController@index_alumno')->name('modulos_index_alumno')->middleware(['auth','alumno']);
Route::delete('alumno/{id}/delete','AlumnosController@destroy')->name('alumnos_delete')->middleware(['auth','admin']);

Route::get('cert',function (){
   return view('certificado/certificado');
});
