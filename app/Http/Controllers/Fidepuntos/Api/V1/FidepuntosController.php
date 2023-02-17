<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeTarjeta;
use App\Models\CompaniasFidepuntos;
use App\Models\ErpsFidepuntos;
use App\Models\ClienteFidepuntos;
use App\Models\MembresiasFidepuntos;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClienteFidepuntosPlantillaExport;
use App\Imports\ClientesFidepuntosImport;
use App\Models\LogsImportacionesFidepuntos;
use App\Models\FabricantesFidepuntos;
use App\Models\MarcasFidepuntos;
use App\Models\CategoriasFidepuntos;
use App\Models\BibliotecaMediaFidepuntos;
use App\Models\TiposMediaFidepuntos;
use App\Models\DescripcionsMediaFidepuntos;
use Cloudinary;


class FidepuntosController extends Controller
{
    public function index()
    {
        $usuario = \Auth::user();
        if ($usuario->email == "alejog1582@gmail.com") {
            $perfil = "Super Administrador";
        }else{
            $perfil = "Super Administrador";
        }
        $tarjetas_fidepuntos = HomeTarjeta::where('proyecto', 'fidepuntos')->get();;
        return view('fidepuntos/home', [
			'usuario' => $usuario,
            'perfil' => $perfil,
            'tarjetas_fidepuntos' => $tarjetas_fidepuntos
		]);
    }

    //Inicio Crud companias Fidepuntos
    //companias fidepuntos index
    public function companias_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/companias', [
			'usuario' => $usuario,
            'companias' => $companias
		]);

    }

    //Vista de una companias fidepuntos
    public function companias_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $compania = CompaniasFidepuntos::find($id);
        return view('fidepuntos/viewcompania', [
			'usuario' => $usuario,
            'compania' => $compania
		]);

    }

    //Edicion de una companias fidepuntos
    public function companias_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $compania = CompaniasFidepuntos::find($id);
        return view('fidepuntos/updatecompania', [
			'usuario' => $usuario,
            'compania' => $compania
		]);

    }

    //Guardad de la edicion de una companias fidepuntos
    public function companias_fidepuntos_update_save(Request $request)
    {
        $compania = CompaniasFidepuntos::find($request->compania_id);

        $compania->tipo = $request->tipo;
        $compania->identificacion = $request->identificacion;
        $compania->nombre_compania = $request->nombre_compania;
        $compania->nombre_contacto = $request->nombre_contacto;
        $compania->celular_contacto = $request->celular_contacto;
        $compania->telefono_contacto = $request->telefono_contacto;
        $compania->email_contacto = $request->email_contacto;
        $compania->direccion = $request->direccion;
        $compania->ciudad = $request->ciudad;
        $compania->codigo_postal = $request->codigo_postal;
        $compania->activo = $request->activo;
        $compania->erp = $request->erp;

        $compania->save();

        //redireccion a listado de compañias
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/companias', [
			'usuario' => $usuario,
            'companias' => $companias
		]);

    }

    //Vista de Creacion de nueva compañia
    public function companias_fidepuntos_create()
    {
        $usuario = \Auth::user();
        return view('fidepuntos/createcompania', [
			'usuario' => $usuario,
		]);

    }

    //Guardad una compañia nueva
    public function companias_fidepuntos_create_save(Request $request)
    {
        $compania = CompaniasFidepuntos::create([
			'tipo' => $request->tipo,
			'identificacion' => $request->identificacion,
			'nombre_compania' => $request->nombre_compania,
			'nombre_contacto' => $request->nombre_contacto,
			'celular_contacto' => $request->celular_contacto,
			'telefono_contacto' => $request->telefono_contacto,
			'email_contacto' => $request->email_contacto,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'codigo_postal' => $request->codigo_postal,
            'erp' => $request->erp,
            'activo' => 1,
        ]);
        $compania->save();

        $consulta_usuario = User::where('email', $compania->email_contacto)->get();

        if (count($consulta_usuario) == 0) {
            $nuevo_usuario = User::create([
                'name' => $compania->nombre_contacto,
                'email' => $compania->email_contacto,
                'proyecto_id' => 2,
                'password' => bcrypt($compania->identificacion),
            ]);
            $nuevo_usuario->save();
        }

        //redireccion a listado de compañias
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/companias', [
			'usuario' => $usuario,
            'companias' => $companias
		]);
    }
    //Fin Crud companias Fidepuntos

    //Inicio Crud erps Fidepuntos
    //ERPS fidepuntos index
    public function erps_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $erps = ErpsFidepuntos::all();
        return view('fidepuntos/erps', [
			'usuario' => $usuario,
            'erps' => $erps
		]);

    }

    //Vista de una erps fidepuntos
    public function erps_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $erp = ErpsFidepuntos::find($id);
        return view('fidepuntos/viewerp', [
			'usuario' => $usuario,
            'erp' => $erp
		]);

    }

    //Edicion de un erps fidepuntos
    public function erps_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $erp = ErpsFidepuntos::find($id);
        return view('fidepuntos/updateerp', [
			'usuario' => $usuario,
            'erp' => $erp
		]);

    }

    //Guardado de la edicion de una erps fidepuntos
    public function erps_fidepuntos_update_save(Request $request)
    {
        $erp = ErpsFidepuntos::find($request->erp_id);

        $erp->endpoint = $request->endpoint;
        $erp->sistema_erp = $request->sistema_erp;
        $erp->token = $request->token;
        $erp->data_connection = $request->data_connection;

        $erp->save();

        //redireccion a listado de erps
        $usuario = \Auth::user();
        $erps = ErpsFidepuntos::all();
        return view('fidepuntos/erps', [
			'usuario' => $usuario,
            'erps' => $erps
		]);

    }

    //Vista de Creacion de un nuevo erp
    public function erps_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/createerp', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guardad un erp nuevo
    public function erps_fidepuntos_create_save(Request $request)
    {
        $control_creacion_erp = false;
        $erps_tpm = ErpsFidepuntos::all();

        foreach ($erps_tpm as $erp) {
            if ($erp->compania_id == $request->compania_id) {
                $control_creacion_erp = true;
            }
        }

        if (!$control_creacion_erp) {
            $erp = ErpsFidepuntos::create([
                'compania_id' => $request->compania_id,
                'endpoint' => $request->endpoint,
                'sistema_erp' => $request->sistema_erp,
                'token' => $request->token,
                'data_connection' => $request->data_connection,
            ]);
            $erp->save();

            $compania = CompaniasFidepuntos::find($request->compania_id);
            $compania->erp = 1;
            $compania->save();
        }else{
            dd("La compañia ya cuenta con ERP");
        }

        //redireccion a listado de erps
        $usuario = \Auth::user();
        $erps = ErpsFidepuntos::all();
        return view('fidepuntos/erps', [
			'usuario' => $usuario,
            'erps' => $erps
		]);
    }
    //Fin Crud erps Fidepuntos

    //Inicio Crud Membresias Fidepuntos
    //Membresias fidepuntos index
    public function membresias_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $membresias = MembresiasFidepuntos::all();
        return view('fidepuntos/membresias', [
			'usuario' => $usuario,
            'membresias' => $membresias
		]);

    }

    //Vista de una membresia fidepuntos
    public function membresias_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $membresia = MembresiasFidepuntos::find($id);
        return view('fidepuntos/viewmembresia', [
			'usuario' => $usuario,
            'membresia' => $membresia
		]);

    }

    //Edicion de una membresias fidepuntos
    public function membresias_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $membresia = MembresiasFidepuntos::find($id);
        return view('fidepuntos/updatemembresia', [
			'usuario' => $usuario,
            'membresia' => $membresia
		]);

    }

    //Guardad de la edicion de una membresias fidepuntos
    public function membresias_fidepuntos_update_save(Request $request)
    {
        $membresia = MembresiasFidepuntos::find($request->membresia_id);

        $membresia->membresia = $request->membresia;
        $membresia->puntos_otorgar = $request->puntos_otorgar;
        $membresia->activo = $request->activo;

        $membresia->save();

        //redireccion a listado de membresias
        $usuario = \Auth::user();
        $membresias = MembresiasFidepuntos::all();
        return view('fidepuntos/membresias', [
			'usuario' => $usuario,
            'membresias' => $membresias
		]);

    }

    //Vista de Creacion de nueva membresia
    public function membresias_fidepuntos_create()
    {
        $usuario = \Auth::user();
        return view('fidepuntos/createmembresia', [
			'usuario' => $usuario,
		]);

    }

    //Guardad una membresia nueva
    public function membresias_fidepuntos_create_save(Request $request)
    {

        $membresia = MembresiasFidepuntos::create([
            'membresia' => $request->membresia,
            'puntos_otorgar' => $request->puntos_otorgar,
            'activo' => $request->activo,
        ]);
        $membresia->save();

        //redireccion a listado de compañias
        $usuario = \Auth::user();
        $membresias = MembresiasFidepuntos::all();
        return view('fidepuntos/membresias', [
			'usuario' => $usuario,
            'membresias' => $membresias
		]);
    }
    //Fin Crud Membresias Fidepuntos

    //Inicio Crud clientes Fidepuntos
    //Clientes fidepuntos index
    public function clientes_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $clientes = ClienteFidepuntos::all();
        return view('fidepuntos/clientes', [
			'usuario' => $usuario,
            'clientes' => $clientes
		]);

    }

    //Vista de una clientes fidepuntos
    public function clientes_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $cliente = ClienteFidepuntos::find($id);
        return view('fidepuntos/viewcliente', [
			'usuario' => $usuario,
            'cliente' => $cliente
		]);

    }

    //Edicion de una clientes fidepuntos
    public function clientes_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $cliente = ClienteFidepuntos::find($id);
        return view('fidepuntos/updatecliente', [
			'usuario' => $usuario,
            'cliente' => $cliente
		]);

    }

    //Guardad de la edicion de una clientes fidepuntos
    public function clientes_fidepuntos_update_save(Request $request)
    {
        $cliente = ClienteFidepuntos::find($request->cliente_id);
        $date = Carbon::now();

        $control_membresia = false;

        if ($request->membresia != null) {
            if (!$cliente->otorgada_membresia) {
                $membresia = MembresiasFidepuntos::where('membresia', $request->membresia)->Where('activo', 1)->get();
                if (count($membresia) > 0) {
                    $cliente->tipo = $request->tipo;
                    $cliente->identificacion = $request->identificacion;
                    $cliente->nombre_completo = $request->nombre_completo;
                    $cliente->nombre_comercial = $request->nombre_comercial;
                    $cliente->puntos_total = $request->puntos_total + $membresia[0]->puntos_otorgar;
                    $cliente->codigo_cliente = $request->codigo_cliente;
                    $cliente->membresia_id = $membresia[0]->id;
                    $cliente->otorgada_membresia = 1;
                    $cliente->fecha_otorgada_membresia = $date;
                    $cliente->celular = $request->celular;
                    $cliente->telefono = $request->telefono;
                    $cliente->email = $request->email;
                    $cliente->direccion = $request->direccion;
                    $cliente->ciudad = $request->ciudad;
                    $cliente->barrio = $request->barrio;
                    $cliente->codigo_postal = $request->codigo_postal;
                    $cliente->latitud = $request->latitud;
                    $cliente->longitud = $request->longitud;

                    $cliente->save();
                }else{
                    dump("La membresia no existe o esta desactivada");
                    $cliente->tipo = $request->tipo;
                    $cliente->identificacion = $request->identificacion;
                    $cliente->nombre_completo = $request->nombre_completo;
                    $cliente->nombre_comercial = $request->nombre_comercial;
                    $cliente->puntos_total = $request->puntos_total;
                    $cliente->codigo_cliente = $request->codigo_cliente;
                    $cliente->celular = $request->celular;
                    $cliente->telefono = $request->telefono;
                    $cliente->email = $request->email;
                    $cliente->direccion = $request->direccion;
                    $cliente->ciudad = $request->ciudad;
                    $cliente->barrio = $request->barrio;
                    $cliente->codigo_postal = $request->codigo_postal;
                    $cliente->latitud = $request->latitud;
                    $cliente->longitud = $request->longitud;

                    $cliente->save();
                }
            }else{
                $cliente->tipo = $request->tipo;
                $cliente->identificacion = $request->identificacion;
                $cliente->nombre_completo = $request->nombre_completo;
                $cliente->nombre_comercial = $request->nombre_comercial;
                $cliente->puntos_total = $request->puntos_total;
                $cliente->codigo_cliente = $request->codigo_cliente;
                $cliente->celular = $request->celular;
                $cliente->telefono = $request->telefono;
                $cliente->email = $request->email;
                $cliente->direccion = $request->direccion;
                $cliente->ciudad = $request->ciudad;
                $cliente->barrio = $request->barrio;
                $cliente->codigo_postal = $request->codigo_postal;
                $cliente->latitud = $request->latitud;
                $cliente->longitud = $request->longitud;

                $cliente->save();
            }
        }else{
            $cliente->tipo = $request->tipo;
            $cliente->identificacion = $request->identificacion;
            $cliente->nombre_completo = $request->nombre_completo;
            $cliente->nombre_comercial = $request->nombre_comercial;
            $cliente->puntos_total = $request->puntos_total;
            $cliente->codigo_cliente = $request->codigo_cliente;
            $cliente->celular = $request->celular;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->ciudad = $request->ciudad;
            $cliente->barrio = $request->barrio;
            $cliente->codigo_postal = $request->codigo_postal;
            $cliente->latitud = $request->latitud;
            $cliente->longitud = $request->longitud;

            $cliente->save();
        }

        //redireccion a listado de clientes
        $usuario = \Auth::user();
        $clientes = ClienteFidepuntos::all();
        return view('fidepuntos/clientes', [
			'usuario' => $usuario,
            'clientes' => $clientes
		]);

    }

    //Vista de Creacion de nuevo cliente
    public function clientes_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/createcliente', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guardad un cliente nueva
    public function clientes_fidepuntos_create_save(Request $request)
    {
        $date = Carbon::now();

        if ($request->codigo_cliente == null) {
            $codigo_cliente = $request->identificacion;
        }else{
            $codigo_cliente = $request->codigo_cliente;
        }
        if ($request->puntos_total == null) {
            $puntos = 0;
        }else{
            $puntos = $request->puntos_total;
        }

        $cliente = ClienteFidepuntos::create([
            'tipo' => $request->tipo,
            'identificacion' => $request->identificacion,
            'nombre_completo' => $request->nombre_completo,
            'nombre_comercial' => $request->nombre_comercial,
            'puntos_total' => $puntos,
            'codigo_cliente' => $codigo_cliente,
            'celular' => $request->celular,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'barrio' => $request->barrio,
            'codigo_postal' => $request->codigo_postal,
            'latitud' => $request->latitud,
            'longitud' => $request->longitud,
            'compania_id' => $request->compania_id,
        ]);
        $cliente->save();


        if ($request->membresia != null) {
            $membresia = MembresiasFidepuntos::where('membresia', $request->membresia)->Where('activo', 1)->get();
            if (count($membresia) > 0) {

                $cliente->puntos_total = $cliente->puntos_total + $membresia[0]->puntos_otorgar;
                $cliente->membresia_id = $membresia[0]->id;
                $cliente->otorgada_membresia = 1;
                $cliente->fecha_otorgada_membresia = $date;

                $cliente->save();
            }else{
                dump("Cliente creado con Exito sin embargo la membresia ingresada no existe o esta desactivada");
            }
        }

        //redireccion a listado de compañias
        $usuario = \Auth::user();
        $clientes = ClienteFidepuntos::all();
        return view('fidepuntos/clientes', [
			'usuario' => $usuario,
            'clientes' => $clientes
		]);
    }
    //Fin Crud clientes Fidepuntos

    //Inicio Crud Fabricantes Fidepuntos
    //Fabricantes fidepuntos index
    public function fabricantes_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $fabricantes = FabricantesFidepuntos::all();
        return view('fidepuntos/fabricantes', [
			'usuario' => $usuario,
            'fabricantes' => $fabricantes
		]);

    }

    //Vista de un fabricante fidepuntos
    public function fabricantes_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $fabricante = FabricantesFidepuntos::find($id);
        return view('fidepuntos/viewfabricante', [
			'usuario' => $usuario,
            'fabricante' => $fabricante
		]);

    }

    //Edicion de una fabrica fidepuntos
    public function fabricantes_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $fabricante = FabricantesFidepuntos::find($id);
        return view('fidepuntos/updatefabricante', [
			'usuario' => $usuario,
            'fabricante' => $fabricante
		]);

    }

    //Guardad de la edicion de una fabricantes fidepuntos
    public function fabricantes_fidepuntos_update_save(Request $request)
    {
        $nombre_fabricante = ucwords(strtolower($request->nombre_fabricante));
        $fabricante = FabricantesFidepuntos::find($request->fabricante_id);


        $fabricante->nombre_fabricante = $nombre_fabricante;
        $fabricante->activo = $request->activo;

        $fabricante->save();

        //redireccion a listado de fabricantes
        $usuario = \Auth::user();
        $fabricantes = FabricantesFidepuntos::all();
        return view('fidepuntos/fabricantes', [
			'usuario' => $usuario,
            'fabricantes' => $fabricantes
		]);

    }

    //Vista de Creacion de nuevo fabricante
    public function fabricantes_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/createfabricante', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guardad un fabricante nuevo
    public function fabricantes_fidepuntos_create_save(Request $request)
    {

        $nombre_fabricante = ucwords(strtolower($request->nombre_fabricante));

        $fabricante = FabricantesFidepuntos::create([
            'nombre_fabricante' => $nombre_fabricante,
            'compania_id' => $request->compania_id,
            'activo' => $request->activo,
        ]);
        $fabricante->save();


        //redireccion a listado de fabricantes
        $usuario = \Auth::user();
        $fabricantes = FabricantesFidepuntos::all();
        return view('fidepuntos/fabricantes', [
			'usuario' => $usuario,
            'fabricantes' => $fabricantes
		]);
    }
    //Fin Crud Fabricante Fidepuntos

    //Inicio Crud Marca Fidepuntos
    //Marcas fidepuntos index
    public function marcas_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $marcas = MarcasFidepuntos::all();
        return view('fidepuntos/marcas', [
			'usuario' => $usuario,
            'marcas' => $marcas
		]);

    }

    //Vista de una Marca fidepuntos
    public function marcas_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $marca = MarcasFidepuntos::find($id);
        return view('fidepuntos/viewmarca', [
			'usuario' => $usuario,
            'marca' => $marca
		]);

    }

    //Edicion de una Marca fidepuntos
    public function marcas_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $marca = MarcasFidepuntos::find($id);
        $fabricantes = FabricantesFidepuntos::all();
        return view('fidepuntos/updatemarca', [
			'usuario' => $usuario,
            'marca' => $marca,
            'fabricantes' => $fabricantes
		]);

    }

    //Guardad de la edicion de una marcas fidepuntos
    public function marcas_fidepuntos_update_save(Request $request)
    {
        $nombre_marca = ucwords(strtolower($request->nombre_marca));
        $marca = MarcasFidepuntos::find($request->marca_id);

        $marca->nombre_marca = $nombre_marca;
        $marca->fabricante_id = $request->fabricante_id;
        $marca->activo = $request->activo;

        $marca->save();

        //redireccion a listado de marcas
        $usuario = \Auth::user();
        $marcas = MarcasFidepuntos::all();
        return view('fidepuntos/marcas', [
			'usuario' => $usuario,
            'marcas' => $marcas
		]);

    }

    //Vista de Creacion de nueva marca
    public function marcas_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        $fabricantes = FabricantesFidepuntos::all();
        return view('fidepuntos/createmarca', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guarda un marca nueva
    public function marcas_fidepuntos_create_save(Request $request)
    {
        $nombre_marca = ucwords(strtolower($request->nombre_marca));

        $marca = MarcasFidepuntos::create([
            'nombre_marca' => $nombre_marca,
            'compania_id' => $request->compania_id,
            'fabricante_id' => $request->fabricante_id,
            'activo' => $request->activo,
        ]);
        $marca->save();


        //redireccion a listado de marcas
        $usuario = \Auth::user();
        $marcas = MarcasFidepuntos::all();
        return view('fidepuntos/marcas', [
			'usuario' => $usuario,
            'marcas' => $marcas
		]);
    }
    //Fin Crud Marca Fidepuntos

    //Inicio Crud Categoria Fidepuntos
    //Categorias fidepuntos index
    public function categorias_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $categorias = CategoriasFidepuntos::all();
        return view('fidepuntos/categorias', [
			'usuario' => $usuario,
            'categorias' => $categorias
		]);

    }

    //Vista de una Categoria fidepuntos
    public function categorias_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $categoria = CategoriasFidepuntos::find($id);
        return view('fidepuntos/viewcategoria', [
			'usuario' => $usuario,
            'categoria' => $categoria
		]);

    }

    //Edicion de una Categoria fidepuntos
    public function categorias_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $categoria = CategoriasFidepuntos::find($id);
        return view('fidepuntos/updatecategoria', [
			'usuario' => $usuario,
            'categoria' => $categoria,
		]);

    }

    //Guardad de la edicion de una categorias fidepuntos
    public function categorias_fidepuntos_update_save(Request $request)
    {
        $nombre_categoria = ucwords(strtolower($request->nombre_categoria));
        $categoria = CategoriasFidepuntos::find($request->categoria_id);

        $categoria->nombre_categoria = $nombre_categoria;
        $categoria->activo = $request->activo;

        $categoria->save();

        //redireccion a listado de categorias
        $usuario = \Auth::user();
        $categorias = CategoriasFidepuntos::all();
        return view('fidepuntos/categorias', [
			'usuario' => $usuario,
            'categorias' => $categorias
		]);

    }

    //Vista de Creacion de nueva categoria
    public function categorias_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/createcategoria', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guarda un nueva categoria
    public function categorias_fidepuntos_create_save(Request $request)
    {
        $nombre_categoria = ucwords(strtolower($request->nombre_categoria));

        $categoria = CategoriasFidepuntos::create([
            'nombre_categoria' => $nombre_categoria,
            'compania_id' => $request->compania_id,
            'activo' => $request->activo,
        ]);
        $categoria->save();


        //redireccion a listado de categorias
        $usuario = \Auth::user();
        $categorias = CategoriasFidepuntos::all();
        return view('fidepuntos/categorias', [
			'usuario' => $usuario,
            'categorias' => $categorias
		]);
    }
    //Fin Crud Categorias Fidepuntos

    //Inicio Crud Media
    public function bibliotecamedia_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $medias = BibliotecaMediaFidepuntos::all();
        $tipos_medias = TiposMediaFidepuntos::all();
        $descripcion_medias = DescripcionsMediaFidepuntos::all();

        return view('fidepuntos/bibliotecamedia', [
			'usuario' => $usuario,
            'medias' => $medias,
            'tipos_medias' => $tipos_medias,
            'descripcion_medias' => $descripcion_medias,
		]);
    }

    //Edicion de una Media fidepuntos
    public function bibliotecamedia_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $media = BibliotecaMediaFidepuntos::find($id);
        $tipos_medias = TiposMediaFidepuntos::all();
        $descripcion_medias = DescripcionsMediaFidepuntos::all();
        return view('fidepuntos/updatemedia', [
			'usuario' => $usuario,
            'media' => $media,
            'tipos_medias' => $tipos_medias,
            'descripcion_medias' => $descripcion_medias,
		]);

    }

    //Guardad de la edicion de una media fidepuntos
    public function bibliotecamedia_fidepuntos_update_save(Request $request)
    {
        $nombre_media = ucwords(strtolower($request->nombre));
        $slugs = ucwords(strtolower($request->slugs));
        $media = BibliotecaMediaFidepuntos::find($request->media_id);

        $media->nombre = $nombre_media;
        $media->url = $request->url;
        $media->tipo = $request->tipo;
        $media->descripcion = $request->descripcion;
        $media->slugs = $slugs;

        $media->save();

        //redireccion a listado de medias
        $usuario = \Auth::user();
        $medias = BibliotecaMediaFidepuntos::all();
        $tipos_medias = TiposMediaFidepuntos::all();
        $descripcion_medias = DescripcionsMediaFidepuntos::all();
        return view('fidepuntos/bibliotecamedia', [
			'usuario' => $usuario,
            'medias' => $medias,
            'tipos_medias' => $tipos_medias,
            'descripcion_medias' => $descripcion_medias,
		]);

    }

    //Guarda un nueva media
    public function bibliotecamedia_fidepuntos_create_save(Request $request)
    {
        $nombre_media = ucwords(strtolower($request->nombre));
        if ($request->slugs != null) {
            $slugs = ucwords(strtolower($request->slugs));
        }else{
            $slugs = null;
        }

        $uploadedMediaUrl = Cloudinary::uploadFile( $request ->file( 'media' )->getRealPath (), ['folder' => 'fidepuntos_media'])->getSecurePath ();

        $media = BibliotecaMediaFidepuntos::create([
            'nombre' => $nombre_media,
            'url' => $uploadedMediaUrl,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'slugs' => $slugs,
        ]);
        $media->save();


        //redireccion a listado de medias
        $usuario = \Auth::user();
        $medias = BibliotecaMediaFidepuntos::all();
        $tipos_medias = TiposMediaFidepuntos::all();
        $descripcion_medias = DescripcionsMediaFidepuntos::all();
        return view('fidepuntos/bibliotecamedia', [
			'usuario' => $usuario,
            'medias' => $medias,
            'tipos_medias' => $tipos_medias,
            'descripcion_medias' => $descripcion_medias,
		]);
    }
    //Fin Crud Media

    //Inicio Import de Clientes Fidepuntos

    public function export_clientes_fidepuntos()
    {
        return Excel::download(new ClienteFidepuntosPlantillaExport, 'plantilla_clientes.xlsx');
    }

    public function import_clientes_fidepuntos(Request $request)
    {
        $date = Carbon::now();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $identificador_importacion = substr(str_shuffle($permitted_chars), 0, 15);
        $registros_exitosos = 0;
        $registros_declinados = 0;
        $registros_declinados_campos_vacios = 0;
        $registros_declinados_duplicidad_cliente = 0;
        $filas_declinadas_campos_vacios = [];
        $filas_declinadas_duplicidad_cliente = [];
        $string_filas_error_campos_vacios  = null;
        $string_filas_error_duplicidad_cliente  = null;
        $file = $request->file('file_clientes_fidepuntos');
        Excel::import(new ClientesFidepuntosImport($identificador_importacion, $date), $file);

        $clientes_procesar_membresia = ClienteFidepuntos::where('procesar_membresia', 1)->get();
        if (count($clientes_procesar_membresia) > 0) {
            foreach ($clientes_procesar_membresia as $key => $cpm) {
                if (!$cpm->otorgada_membresia) {
                    $cpm->puntos_total = $cpm->puntos_total + $cpm->membresia->puntos_otorgar;
                    $cpm->otorgada_membresia = 1;
                    $cpm->fecha_otorgada_membresia = $date;
                    $cpm->procesar_membresia = 0;
                    $cpm->save();
                }else{
                    continue;
                }
            }
        }

        $logs_importar_cliente = LogsImportacionesFidepuntos::where('identificador_importacion', $identificador_importacion)->get();
        foreach ($logs_importar_cliente as $key => $lic) {
            if ($lic->resultado == 'exitoso') {
                $registros_exitosos  = $registros_exitosos + 1;
            }elseif ($lic->resultado == 'declinado') {
                $registros_declinados = $registros_declinados + 1;
                if ($lic->motivo_decline == 'campos requeridos vacios' ) {
                    $registros_declinados_campos_vacios = $registros_declinados_campos_vacios + 1;
                    array_push($filas_declinadas_campos_vacios, $lic->numero_fila_excel);
                    $string_filas_error_campos_vacios = json_encode( $filas_declinadas_campos_vacios );
                }elseif ($lic->motivo_decline == 'cliente ya existe') {
                    $registros_declinados_duplicidad_cliente = $registros_declinados_duplicidad_cliente + 1;
                    array_push($filas_declinadas_duplicidad_cliente, $lic->numero_fila_excel);
                    $string_filas_error_duplicidad_cliente = json_encode( $filas_declinadas_duplicidad_cliente );
                }
            }
        }
        $proceso_importacion = 'clientes';

        return view('fidepuntos/imports/resultadoimport', [
			'logs_importar_cliente' => $logs_importar_cliente,
			'registros_exitosos' => $registros_exitosos,
			'registros_declinados' => $registros_declinados,
			'registros_declinados_campos_vacios' => $registros_declinados_campos_vacios,
			'registros_declinados_duplicidad_cliente' => $registros_declinados_duplicidad_cliente,
			'string_filas_error_campos_vacios' => $string_filas_error_campos_vacios,
			'string_filas_error_duplicidad_cliente' => $string_filas_error_duplicidad_cliente,
            'proceso_importacion' => $proceso_importacion,
            'identificador_importacion' => $identificador_importacion,
		]);
    }
    //Fin Import de Clientes Fidepuntos

    //Inicio Funciones Ajaxs
    public function obtenerfabricantesxcompania(Request $request)
    {
        $compania_id = $request->get('compania_id');
        $fabricantes = FabricantesFidepuntos::where('compania_id', $compania_id)->get();

        return $fabricantes;
    }
    //Fin Funciones Ajaxs

}
