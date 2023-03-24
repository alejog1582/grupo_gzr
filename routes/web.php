<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Fidepuntos\Api\V1\FidepuntosController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    /* Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); */
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/fidepuntos', [FidepuntosController::class, 'index'])->name('homefidepuntos');
    //crud companias fidepuntos
    Route::get('/dashboard/fidepuntos/companias', [FidepuntosController::class, 'companias_fidepuntos_index'])->name('companias.fidepuntos');
    Route::get('/dashboard/fidepuntos/companias/{id}', [FidepuntosController::class, 'companias_fidepuntos_view'])->name('companias.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/companias/update/{id}', [FidepuntosController::class, 'companias_fidepuntos_update'])->name('companias.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/companias/update/save', [FidepuntosController::class, 'companias_fidepuntos_update_save'])->name('companias.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevacompania', [FidepuntosController::class, 'companias_fidepuntos_create'])->name('companias.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevacompania/save', [FidepuntosController::class, 'companias_fidepuntos_create_save'])->name('companias.fidepuntos.create.save');
    //crud erps fidepuntos
    Route::get('/dashboard/fidepuntos/erps', [FidepuntosController::class, 'erps_fidepuntos_index'])->name('erps.fidepuntos');
    Route::get('/dashboard/fidepuntos/erps/{id}', [FidepuntosController::class, 'erps_fidepuntos_view'])->name('erps.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/erps/update/{id}', [FidepuntosController::class, 'erps_fidepuntos_update'])->name('erps.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/erps/update/save', [FidepuntosController::class, 'erps_fidepuntos_update_save'])->name('erps.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevoerp', [FidepuntosController::class, 'erps_fidepuntos_create'])->name('erps.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevoerp/save', [FidepuntosController::class, 'erps_fidepuntos_create_save'])->name('erps.fidepuntos.create.save');
    //crud Membresia fidepuntos
    Route::get('/dashboard/fidepuntos/membresias', [FidepuntosController::class, 'membresias_fidepuntos_index'])->name('membresias.fidepuntos');
    Route::get('/dashboard/fidepuntos/membresias/{id}', [FidepuntosController::class, 'membresias_fidepuntos_view'])->name('membresias.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/membresias/update/{id}', [FidepuntosController::class, 'membresias_fidepuntos_update'])->name('membresias.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/membresias/update/save', [FidepuntosController::class, 'membresias_fidepuntos_update_save'])->name('membresias.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevamembresia', [FidepuntosController::class, 'membresias_fidepuntos_create'])->name('membresias.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevamembresia/save', [FidepuntosController::class, 'membresias_fidepuntos_create_save'])->name('membresias.fidepuntos.create.save');
    //crud clientes fidepuntos
    Route::get('/dashboard/fidepuntos/clientes', [FidepuntosController::class, 'clientes_fidepuntos_index'])->name('clientes.fidepuntos');
    Route::get('/dashboard/fidepuntos/clientes/{id}', [FidepuntosController::class, 'clientes_fidepuntos_view'])->name('clientes.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/clientes/update/{id}', [FidepuntosController::class, 'clientes_fidepuntos_update'])->name('clientes.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/clientes/update/save', [FidepuntosController::class, 'clientes_fidepuntos_update_save'])->name('clientes.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevocliente', [FidepuntosController::class, 'clientes_fidepuntos_create'])->name('clientes.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevocliente/save', [FidepuntosController::class, 'clientes_fidepuntos_create_save'])->name('clientes.fidepuntos.create.save');
    //crud Fabricantes fidepuntos
    Route::get('/dashboard/fidepuntos/fabricantes', [FidepuntosController::class, 'fabricantes_fidepuntos_index'])->name('fabricantes.fidepuntos');
    Route::get('/dashboard/fidepuntos/fabricantes/{id}', [FidepuntosController::class, 'fabricantes_fidepuntos_view'])->name('fabricantes.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/fabricantes/update/{id}', [FidepuntosController::class, 'fabricantes_fidepuntos_update'])->name('fabricantes.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/fabricantes/update/save', [FidepuntosController::class, 'fabricantes_fidepuntos_update_save'])->name('fabricantes.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevofabricante', [FidepuntosController::class, 'fabricantes_fidepuntos_create'])->name('fabricantes.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevofabricante/save', [FidepuntosController::class, 'fabricantes_fidepuntos_create_save'])->name('fabricantes.fidepuntos.create.save');
    //crud Marcas fidepuntos
    Route::get('/dashboard/fidepuntos/marcas', [FidepuntosController::class, 'marcas_fidepuntos_index'])->name('marcas.fidepuntos');
    Route::get('/dashboard/fidepuntos/marcas/{id}', [FidepuntosController::class, 'marcas_fidepuntos_view'])->name('marcas.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/marcas/update/{id}', [FidepuntosController::class, 'marcas_fidepuntos_update'])->name('marcas.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/marcas/update/save', [FidepuntosController::class, 'marcas_fidepuntos_update_save'])->name('marcas.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevamarca', [FidepuntosController::class, 'marcas_fidepuntos_create'])->name('marcas.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevamarca/save', [FidepuntosController::class, 'marcas_fidepuntos_create_save'])->name('marcas.fidepuntos.create.save');
    //crud Categorias fidepuntos
    Route::get('/dashboard/fidepuntos/categorias', [FidepuntosController::class, 'categorias_fidepuntos_index'])->name('categorias.fidepuntos');
    Route::get('/dashboard/fidepuntos/categorias/{id}', [FidepuntosController::class, 'categorias_fidepuntos_view'])->name('categorias.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/categorias/update/{id}', [FidepuntosController::class, 'categorias_fidepuntos_update'])->name('categorias.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/categorias/update/save', [FidepuntosController::class, 'categorias_fidepuntos_update_save'])->name('categorias.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevacategoria', [FidepuntosController::class, 'categorias_fidepuntos_create'])->name('categorias.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevacategoria/save', [FidepuntosController::class, 'categorias_fidepuntos_create_save'])->name('categorias.fidepuntos.create.save');
    //Biblioteca de Medios
    Route::get('/dashboard/fidepuntos/bibliotecamedia', [FidepuntosController::class, 'bibliotecamedia_fidepuntos_index'])->name('biblioteca.puntos.fidepuntos');
    Route::get('/dashboard/fidepuntos/bibliotecamedia//update/{id}', [FidepuntosController::class, 'bibliotecamedia_fidepuntos_update'])->name('biblioteca.puntos.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/bibliotecamedia//update/save', [FidepuntosController::class, 'bibliotecamedia_fidepuntos_update_save'])->name('biblioteca.puntos.fidepuntos.update.save');
    Route::post('/dashboard/fidepuntos/nuevabibliotecamedia/save', [FidepuntosController::class, 'bibliotecamedia_fidepuntos_create_save'])->name('bibliotecamedia.fidepuntos.create.save');
    //crud Productos fidepuntos
    Route::get('/dashboard/fidepuntos/productos', [FidepuntosController::class, 'productos_fidepuntos_index'])->name('productos.fidepuntos');
    Route::get('/dashboard/fidepuntos/productos/{id}', [FidepuntosController::class, 'productos_fidepuntos_view'])->name('productos.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/productos/update/{id}', [FidepuntosController::class, 'productos_fidepuntos_update'])->name('productos.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/productos/update/save', [FidepuntosController::class, 'productos_fidepuntos_update_save'])->name('productos.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevoproducto', [FidepuntosController::class, 'productos_fidepuntos_create'])->name('productos.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevoproducto/save', [FidepuntosController::class, 'productos_fidepuntos_create_save'])->name('productos.fidepuntos.create.save');
    //crud plan puntos fidepuntos
    Route::get('/dashboard/fidepuntos/planpuntos', [FidepuntosController::class, 'planpuntos_fidepuntos_index'])->name('planpuntos.fidepuntos');
    Route::get('/dashboard/fidepuntos/planpuntos/update/{id}', [FidepuntosController::class, 'planpuntos_fidepuntos_update'])->name('planpuntos.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/planpuntos/update/save', [FidepuntosController::class, 'planpuntos_fidepuntos_update_save'])->name('planpuntos.fidepuntos.update.save');
    //crud puntos x compras fidepuntos
    Route::get('/dashboard/fidepuntos/puntosxcompra', [FidepuntosController::class, 'puntoscompra_fidepuntos_index'])->name('puntoscompra.fidepuntos');
    Route::get('/dashboard/fidepuntos/puntoscompra/update/{id}', [FidepuntosController::class, 'puntoscompra_fidepuntos_update'])->name('puntoscompra.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/puntoscompra/update/save', [FidepuntosController::class, 'puntoscompra_fidepuntos_update_save'])->name('puntoscompra.fidepuntos.update.save');
    //crud puntos x productos fidepuntos
    Route::get('/dashboard/fidepuntos/puntosxproducto', [FidepuntosController::class, 'puntosproducto_fidepuntos_index'])->name('puntosproducto.fidepuntos');
    Route::get('/dashboard/fidepuntos/puntosproducto/update/{id}', [FidepuntosController::class, 'puntosproducto_fidepuntos_update'])->name('puntosproducto.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/puntosproducto/update/save', [FidepuntosController::class, 'puntosproducto_fidepuntos_update_save'])->name('puntosproducto.fidepuntos.update.save');
    //crud Config Fidelizacion Clientes fidepuntos
    Route::get('/dashboard/fidepuntos/fidelizacionconfig', [FidepuntosController::class, 'fidelizacionconfig_fidepuntos_index'])->name('fidelizacionconfig.fidepuntos');
    Route::get('/dashboard/fidepuntos/fidelizacionconfig/{id}', [FidepuntosController::class, 'fidelizacionconfig_fidepuntos_view'])->name('fidelizacionconfig.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/fidelizacionconfig/update/{id}', [FidepuntosController::class, 'fidelizacionconfig_fidepuntos_update'])->name('fidelizacionconfig.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/fidelizacionconfig/update/save', [FidepuntosController::class, 'fidelizacionconfig_fidepuntos_update_save'])->name('fidelizacionconfig.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevafidelizacionconfig', [FidepuntosController::class, 'fidelizacionconfig_fidepuntos_create'])->name('fidelizacionconfig.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevafidelizacionconfig/save', [FidepuntosController::class, 'fidelizacionconfig_fidepuntos_create_save'])->name('fidelizacionconfig.fidepuntos.create.save');
    //crud Pedidos fidepuntos
    Route::get('/dashboard/fidepuntos/pedidos', [FidepuntosController::class, 'pedidos_fidepuntos_index'])->name('pedidos.fidepuntos');
    Route::get('/dashboard/fidepuntos/pedidos/{id}', [FidepuntosController::class, 'pedidos_fidepuntos_view'])->name('pedidos.fidepuntos.view');
    Route::get('/dashboard/fidepuntos/pedidos/update/{id}', [FidepuntosController::class, 'pedidos_fidepuntos_update'])->name('pedidos.fidepuntos.update');
    Route::post('/dashboard/fidepuntos/pedidos/update/save', [FidepuntosController::class, 'pedidos_fidepuntos_update_save'])->name('pedidos.fidepuntos.update.save');
    Route::get('/dashboard/fidepuntos/nuevapedidos', [FidepuntosController::class, 'pedidos_fidepuntos_create'])->name('pedidos.fidepuntos.create');
    Route::post('/dashboard/fidepuntos/nuevapedidos/save', [FidepuntosController::class, 'pedidos_fidepuntos_create_save'])->name('pedidos.fidepuntos.create.save');
    //Exports Plantillas
    Route::get('/dashboard/fidepuntos/exports/plantilla/clientes', [FidepuntosController::class, 'export_clientes_fidepuntos'])->name('clientes.fidepuntos.export.formato');
    Route::get('/dashboard/fidepuntos/exports/plantilla/productos', [FidepuntosController::class, 'export_productos_fidepuntos'])->name('productos.fidepuntos.export.formato');
    //Imports Procesos
    Route::post('/dashboard/fidepuntos/imports/clientes', [FidepuntosController::class, 'import_clientes_fidepuntos'])->name('clientes.fidepuntos.import');
    Route::post('/dashboard/fidepuntos/imports/productos', [FidepuntosController::class, 'import_productos_fidepuntos'])->name('productos.fidepuntos.import');
    //Llamados Ajaxs
    Route::get('/dashboard/fidepuntos/obtenerfabricantesxcompania', [FidepuntosController::class, 'obtenerfabricantesxcompania'])->name('obtenerfabricantesxcompania');
    Route::get('/dashboard/fidepuntos/obtenerclientesxcompania', [FidepuntosController::class, 'obtenerclientesxcompania'])->name('obtenerclientesxcompania');
    Route::get('/dashboard/fidepuntos/obtenerproductosxcompania', [FidepuntosController::class, 'obtenerproductosxcompania'])->name('obtenerproductosxcompania');
    Route::get('/dashboard/fidepuntos/obtenerproductospedidosxcompania', [FidepuntosController::class, 'obtenerproductospedidosxcompania'])->name('obtenerproductospedidosxcompania');
    Route::get('/dashboard/fidepuntos/obtenermarcasxfabricantes', [FidepuntosController::class, 'obtenermarcasxfabricantes'])->name('obtenermarcasxcompania');
    Route::get('/dashboard/fidepuntos/obtenercategoriasxcompania', [FidepuntosController::class, 'obtenercategoriasxcompania'])->name('obtenercategoriasxcompania');
    Route::post('/dashboard/fidepuntos/actualizacionimagenprincipal', [FidepuntosController::class, 'actualizacionimagenprincipal'])->name('actualizacionimagenprincipal');
    // Rutas Actializaciones ERPS
    Route::post('/dashboard/fidepuntos/actualizacioneserps/clientes', [FidepuntosController::class, 'actualizacion_erp_clientes'])->name('actualizacion.erp.clientes');
    Route::post('/dashboard/fidepuntos/actualizacioneserps/productos', [FidepuntosController::class, 'actualizacion_erp_productos'])->name('actualizacion.erp.productos');


});

