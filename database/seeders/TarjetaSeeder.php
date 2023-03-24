<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeTarjeta;

class TarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeTarjeta::create([
            'activo' => '1',
            'link' => 'admin.users.index',
            'titulo' => 'Usuarios',
            'proyecto' => 'gzr',
            'descripcion' => 'Consulta la informacion de usuarios'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => 'admin.eval.index',
            'titulo' => 'Eval',
            'proyecto' => 'gzr',
            'descripcion' => 'Administracion Proyecto Eval.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos',
            'titulo' => 'Fidepuntos',
            'proyecto' => 'gzr',
            'descripcion' => 'Administracion Proyecto Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/companias',
            'titulo' => 'Companias',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Companias Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/erps',
            'titulo' => 'ERPS',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Erps Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/membresias',
            'titulo' => 'Membresias',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Membresias Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/clientes',
            'titulo' => 'Clientes',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Clientes Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/fabricantes',
            'titulo' => 'Fabricantes',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Fabricantes Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/marcas',
            'titulo' => 'Marcas',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Marcas Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/categorias',
            'titulo' => 'Categorias',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Categorias Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/bibliotecamedia',
            'titulo' => 'Biblioteca Media',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion de Medios Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/productos',
            'titulo' => 'Productos',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Productos Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/planpuntos',
            'titulo' => 'Activar Plan Puntos',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Activar Plan Puntos Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/puntosxcompra',
            'titulo' => 'Puntos x Compra',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Puntos x Compra Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/puntosxproducto',
            'titulo' => 'Puntos x Producto',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Puntos x Producto Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/fidelizacionconfig',
            'titulo' => 'Config Fidelizacion',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Config Fidelizacion Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/pedidos',
            'titulo' => 'Pedidos',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Pedidos Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/cargueventasfidelizacion',
            'titulo' => 'Cargue Ventas Fidelizacion',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion Cargue Venta Fidelizacion Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/pedidoscanjeproducto',
            'titulo' => 'Pedidos Canje de Productos',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion pedidos canje de productos Fidepuntos.'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => '/dashboard/fidepuntos/pedidosecommerce',
            'titulo' => 'Pedidos Ecommerce',
            'proyecto' => 'fidepuntos',
            'descripcion' => 'Administracion pedidos ecommerce Fidepuntos.'
        ]);
    }
}
