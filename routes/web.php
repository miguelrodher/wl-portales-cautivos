<?php

use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| Ruta para pruebas de portal
|--------------------------------------------------------------------------
*/
# Ruta de acceso de usuario #
Route::get('/portal', 'PortalController@accesoPortal')->name('accesoPortal');
Route::post('/portal', 'PortalController@accesoPortalPost')->name('accesoPortalPost');
Route::get('/portal/inicio', 'PortalController@inicioPortal')->name('inicioPortal');

# Rutas básicas de Auth #
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas privadas administradores
|--------------------------------------------------------------------------
*/

# Vista principal, inicio de sesion#
Route::get('/', 'Auth\AuthenticatedSessionController@create')->name('login');
Route::post('/', 'Auth\AuthenticatedSessionController@store')->name('loginPost');

# Vista principal de usuarios administradores #
Route::get('/wl', 'AdministradorController@inicio')->name('inicio');

# Vista principal de restricciones registradas #
Route::get('/wl/listar-restricciones', 'AdministradorController@listarRestricciones')->name('listarRestricciones');

# Registro de restricciones de correo #
Route::get('/wl/registro-restriccion-correo', 'CorreoDominioRestringidoController@registroRestriccionCorreo')->name('registroRestriccionCorreo');
Route::post('/wl/registro-restriccion-correo', 'CorreoDominioRestringidoController@registroRestriccionCorreoPost')->name('registroRestriccionCorreoPost');
Route::get('/wl/editar-restriccion-correo/{correos_restricciones_id}', 'CorreoDominioRestringidoController@editarRestriccionCorreo')->name('editarRestriccionCorreo');
Route::post('/wl/editar-restriccion-correo/{correos_restricciones_id}', 'CorreoDominioRestringidoController@editarRestriccionCorreoPost')->name('editarRestriccionCorreoPost');
Route::post('/wl/eliminar-restriccion-correo/{correos_restricciones_id}', 'CorreoDominioRestringidoController@eliminarRestriccionCorreoPost')->name('eliminarRestriccionCorreoPost');

# Registro de restricciones de nombre #
Route::get('/wl/registro-restriccion-nombre', 'NombreRestringidoController@registroRestriccionNombre')->name('registroRestriccionNombre');
Route::post('/wl/registro-restriccion-nombre', 'NombreRestringidoController@registroRestriccionNombrePost')->name('registroRestriccionNombrePost');
Route::get('/wl/editar-restriccion-nombre/{nombres_restricciones_id}', 'NombreRestringidoController@editarRestriccionNombre')->name('editarRestriccionNombre');
Route::post('/wl/editar-restriccion-nombre/{nombres_restricciones_id}', 'NombreRestringidoController@editarRestriccionNombrePost')->name('editarRestriccionNombrePost');
Route::post('/wl/eliminar-restriccion-nombre/{nombres_restricciones_id}', 'NombreRestringidoController@eliminarRestriccionNombrePost')->name('eliminarRestriccionNombrePost');

# Registro de restricciones de telefono #
Route::get('/wl/registro-restriccion-telefono', 'TelefonoRestringidoController@registroRestriccionTelefono')->name('registroRestriccionTelefono');
Route::post('/wl/registro-restriccion-telefono', 'TelefonoRestringidoController@registroRestriccionTelefonoPost')->name('registroRestriccionTelefonoPost');
Route::get('/wl/editar-restriccion-telefono/{telefonos_restricciones_id}', 'TelefonoRestringidoController@editarRestriccionTelefono')->name('editarRestriccionTelefono');
Route::post('/wl/editar-restriccion-telefono/{telefonos_restricciones_id}', 'TelefonoRestringidoController@editarRestriccionTelefonoPost')->name('editarRestriccionTelefonoPost');
Route::post('/wl/eliminar-restriccion-telefono/{telefonos_restricciones_id}', 'TelefonoRestringidoController@eliminarRestriccionTelefonoPost')->name('eliminarRestriccionTelefonoPost');

/*
|--------------------------------------------------------------------------
| Rutas de supervisor (super usuario)
|--------------------------------------------------------------------------
*/

# Registro de administradores #
Route::get('/wl/supervisor/registro-admin', 'SupervisorController@registro')->name('registro');
Route::post('/wl/supervisor/registro-admin', 'SupervisorController@registroPost')->name('registroPost');


