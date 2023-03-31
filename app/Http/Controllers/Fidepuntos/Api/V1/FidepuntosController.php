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
use App\Exports\ProductoFidepuntosPlantillaExport;
use App\Imports\ClientesFidepuntosImport;
use App\Models\LogsImportacionesFidepuntos;
use App\Models\FabricantesFidepuntos;
use App\Models\MarcasFidepuntos;
use App\Models\CategoriasFidepuntos;
use App\Models\BibliotecaMediaFidepuntos;
use App\Models\TiposMediaFidepuntos;
use App\Models\DescripcionsMediaFidepuntos;
use Cloudinary;
use App\Models\ProductosFidepuntos;
use App\Models\PlanPuntosxCompaniaFidepuntos;
use App\Models\PuntosxComprasFidepuntos;
use App\Models\PuntosxproductosFidepuntos;
use App\Models\ConfigFidelizacionClientesFidepuntos;
use App\Models\Logins;
use App\Models\PedidosFidepuntos;
use App\Models\PedidosxProductosFidepuntos;
use App\Models\MovimientosPuntosFidepuntos;
use App\Models\FidelizacionClientesFidepuntos;
use App\Imports\ProductosFidepuntosImport;
use App\Jobs\ActualizacionClientesFidepuntos;
use App\Jobs\ActualizacionProductosFidepuntos;
use Flash;


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
                'password' => password_hash($compania->identificacion, PASSWORD_DEFAULT),
            ]);
            $nuevo_usuario->save();

            $login_nuevo = Logins::create([
                'identificacion' => $compania->identificacion,
                'password' => password_hash($compania->identificacion, PASSWORD_DEFAULT),
                'role' => 'compania',
                'proyecto' => 'fidepuntos',
                'user_id' => $nuevo_usuario->id,
            ]);
            $login_nuevo->save();
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
        $companias = CompaniasFidepuntos::where('activo', '1')->where('erp', '1')->get();
        return view('fidepuntos/clientes', [
			'usuario' => $usuario,
            'clientes' => $clientes,
            'companias' => $companias
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

        $uploadedMediaUrl = Cloudinary::uploadFile( $request ->file( 'media' )->getRealPath (), ['folder' => 'puntosgroup_media'])->getSecurePath ();

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

    //Inicio Crud Productos Fidepuntos
    //Productos fidepuntos index
    public function productos_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $productos = ProductosFidepuntos::all();
        $companias = CompaniasFidepuntos::where('activo', '1')->where('erp', '1')->get();
        return view('fidepuntos/productos', [
			'usuario' => $usuario,
            'productos' => $productos,
            'companias' => $companias
		]);

    }

    //Vista de una Categoria fidepuntos
    public function productos_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $categoria = ProductosFidepuntos::find($id);
        return view('fidepuntos/viewcategoria', [
			'usuario' => $usuario,
            'categoria' => $categoria
		]);

    }

    //Edicion de una Categoria fidepuntos
    public function productos_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        $producto = ProductosFidepuntos::find($id);
        if ($producto->impoconsumo > 0) {
            $impoconsumo = intval(($producto->impoconsumo / $producto->precio_unitario)* 100);
        }else{
            $impoconsumo = 0;
        }
        $fabricantes = FabricantesFidepuntos::all();
        $categorias = CategoriasFidepuntos::all();
        $marcas = MarcasFidepuntos::all();
        return view('fidepuntos/updateproducto', [
			'usuario' => $usuario,
            'companias' => $companias,
            'producto' => $producto,
            'fabricantes' => $fabricantes,
            'impoconsumo' => $impoconsumo,
            'marcas' => $marcas,
            'categorias' => $categorias,
		]);

    }

    //Guardad de la edicion de una productos fidepuntos
    public function productos_fidepuntos_update_save(Request $request)
    {
        $nombre_producto = ucwords(strtolower($request->nombre_producto));
        $producto = ProductosFidepuntos::find($request->producto_id);
        $control_oferta = false;

        //se valida si en el formulario marcaron oferta. Si viene marcada se debe tener o porcentaje de oferta o valor de descuento. Si trae los dos se aplica el valor de descuent
        if ($request->oferta == "no") {
            $oferta = 0;
            $descuento_porcentaje = 0;
            $descuento_valor = 0;
            if ($request->impoconsumo != "sin") {
                $impoconsumo = ($request->precio_unitario * $request->impoconsumo) / 100;
            }else{
                $impoconsumo = 0;
            }
            if ($request->iva != "sin") {
                $iva = ($request->precio_unitario * $request->iva) / 100;
            }else{
                $iva = 0;
            }
            $precio = $request->precio_unitario + $impoconsumo + $iva;
        }else{
            if ($request->descuento_porcentaje != null) {
                if ($request->descuento_porcentaje > 100) {
                    $descuento_porcentaje = 0;
                }else{
                    $control_oferta = true;
                    $descuento_porcentaje = $request->descuento_porcentaje;
                    $descuento_valor = ($request->precio_unitario * $descuento_porcentaje) / 100;
                }
            }else{
                $descuento_porcentaje = 0;
                $control_oferta = false;
            }
            if ($request->descuento_valor != null) {
                $control_oferta = true;
                $descuento_valor = $request->descuento_valor;
            }else{
                $descuento_porcentaje = 0;
                $control_oferta = false;
            }
            if ($control_oferta == false) {
                $oferta = 0;

                if ($request->impoconsumo != "sin") {
                    $impoconsumo = ($request->precio_unitario * $request->impoconsumo) / 100;
                }else{
                    $impoconsumo = 0;
                }
                if ($request->iva != "sin") {
                    $iva = ($request->precio_unitario * $request->iva) / 100;
                }else{
                    $iva = 0;
                }
                $precio = $request->precio_unitario + $impoconsumo + $iva;
            }else{
                $oferta = 1;

                if ($descuento_valor > 0) {
                    $precio_descuento_antes_impuestos = $request->precio_unitario - $descuento_valor;
                    $descuento_porcentaje = ($descuento_valor / $request->precio_unitario) * 100;
                }else{
                    $descuento_valor = ($request->precio_unitario * $descuento_porcentaje) / 100;
                    $precio_descuento_antes_impuestos = $request->precio_unitario - $descuento_valor;
                }

                if ($request->impoconsumo != "sin") {
                    $impoconsumo = ($precio_descuento_antes_impuestos * $request->impoconsumo) / 100;
                }else{
                    $impoconsumo = 0;
                }
                if ($request->iva != "sin") {
                    $iva = ($precio_descuento_antes_impuestos * $request->iva) / 100;
                }else{
                    $iva = 0;
                }
                $precio = $precio_descuento_antes_impuestos + $impoconsumo + $iva;

            }
        }

        $producto->nombre_producto = $nombre_producto;
        $producto->codigo_producto = $request->codigo_producto;
        $producto->ean = $request->ean;
        $producto->marca_id = $request->marca_id;
        $producto->categoria_id = $request->categoria_id;
        $producto->tipo = $request->tipo;
        $producto->objetivo = $request->objetivo;
        $producto->presentacion_talla_tamano = $request->presentacion_talla_tamano;
        $producto->inventario = $request->inventario;
        $producto->oferta = $oferta;
        $producto->descuento_porcentaje = $descuento_porcentaje;
        $producto->descuento_valor = $descuento_valor;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->iva = $iva;
        $producto->impoconsumo = $impoconsumo;
        $producto->precio_puntos = $request->precio_puntos;
        $producto->precio = $precio;
        $producto->fidelizacion = $request->fidelizacion;
        $producto->activo = $request->activo;

        $producto->save();

        Flash::success('Producto Actualizado con exito.');

        //redireccion a listado de productos
        $usuario = \Auth::user();
        $productos = ProductosFidepuntos::all();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/productos', [
			'usuario' => $usuario,
            'productos' => $productos,
            'companias' => $companias,
		]);

    }

    //Vista de Creacion de nueva categoria
    public function productos_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/createproducto', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guarda un nuevo producto
    public function productos_fidepuntos_create_save(Request $request)
    {
        $control_producto_existe = ProductosFidepuntos::where('codigo_producto', $request->codigo_producto)->where('compania_id', $request->compania_id)->get();
        if (count($control_producto_existe) > 0) {
            Flash::error('Producto ya existe si desea modificar informacion, edite el producto.');
        }else{
            $nombre_producto = ucwords(strtolower($request->nombre_producto));
            $control_oferta = false;

            if ($request->media_principal != null) {

                $uploadedMediaUrl = Cloudinary::uploadFile( $request ->file( 'media_principal' )->getRealPath (), ['folder' => 'puntosgroup_media'])->getSecurePath ();

                $media = BibliotecaMediaFidepuntos::create([
                    'nombre' => $nombre_producto,
                    'url' => $uploadedMediaUrl,
                    'tipo' => 'imagen',
                    'descripcion' => 'principal',
                ]);
                $media->save();
                $media_principal_id = $media->id;
            }else{
                $media_principal_id = 1;
            }

            //se valida si en el formulario diligenciaron categoria. Si no se asigna la generica
            if ($request->categoria_id == null) {
                $categoria_tmp = CategoriasFidepuntos::where('nombre_categoria', 'Generica')->where('compania_id', $request->compania_id)->get();
                $categoria = $categoria_tmp[0]->id;
            }else{
                $categoria = $request->categoria_id;
            }
            //se valida si en el formulario marcaron oferta. Si viene marcada se debe tener o porcentaje de oferta o valor de descuento. Si trae los dos se aplica el valor de descuent
            if ($request->oferta == "no") {
                $oferta = 0;
                $descuento_porcentaje = 0;
                $descuento_valor = 0;
                if ($request->impoconsumo != "sin") {
                    $impoconsumo = ($request->precio_unitario * $request->impoconsumo) / 100;
                }else{
                    $impoconsumo = 0;
                }
                if ($request->iva != "sin") {
                    $iva = ($request->precio_unitario * $request->iva) / 100;
                }else{
                    $iva = 0;
                }
                $precio = $request->precio_unitario + $impoconsumo + $iva;
            }else{
                if ($request->descuento_porcentaje != null) {
                    if ($request->descuento_porcentaje > 100) {
                        $descuento_porcentaje = 0;
                    }else{
                        $control_oferta = true;
                        $descuento_porcentaje = $request->descuento_porcentaje;
                        $descuento_valor = ($request->precio_unitario * $descuento_porcentaje) / 100;
                    }
                }else{
                    $descuento_porcentaje = 0;
                    $control_oferta = false;
                }
                if ($request->descuento_valor != null) {
                    $control_oferta = true;
                    $descuento_valor = $request->descuento_valor;
                }else{
                    $descuento_porcentaje = 0;
                    $control_oferta = false;
                }
                if ($control_oferta == false) {
                    $oferta = 0;

                    if ($request->impoconsumo != "sin") {
                        $impoconsumo = ($request->precio_unitario * $request->impoconsumo) / 100;
                    }else{
                        $impoconsumo = 0;
                    }
                    if ($request->iva != "sin") {
                        $iva = ($request->precio_unitario * $request->iva) / 100;
                    }else{
                        $iva = 0;
                    }
                    $precio = $request->precio_unitario + $impoconsumo + $iva;
                }else{
                    $oferta = 1;

                    if ($descuento_valor > 0) {
                        $precio_descuento_antes_impuestos = $request->precio_unitario - $descuento_valor;
                        $descuento_porcentaje = ($descuento_valor / $request->precio_unitario) * 100;
                    }else{
                        $descuento_valor = ($request->precio_unitario * $descuento_porcentaje) / 100;
                        $precio_descuento_antes_impuestos = $request->precio_unitario - $descuento_valor;
                    }

                    if ($request->impoconsumo != "sin") {
                        $impoconsumo = ($precio_descuento_antes_impuestos * $request->impoconsumo) / 100;
                    }else{
                        $impoconsumo = 0;
                    }
                    if ($request->iva != "sin") {
                        $iva = ($precio_descuento_antes_impuestos * $request->iva) / 100;
                    }else{
                        $iva = 0;
                    }
                    $precio = $precio_descuento_antes_impuestos + $impoconsumo + $iva;

                }
            }
            $producto = ProductosFidepuntos::create([
                'nombre_producto' => $nombre_producto,
                'codigo_producto' => $request->codigo_producto,
                'ean' => $request->ean,
                'presentacion_talla_tamano' => $request->presentacion_talla_tamano,
                'fabricante_id' => $request->fabricante_id,
                'marca_id' => $request->marca_id,
                'categoria_id' => $categoria,
                'compania_id' => $request->compania_id,
                'inventario' => $request->inventario,
                'activo' => $request->activo,
                'tipo' => $request->tipo,
                'objetivo' => $request->objetivo,
                'oferta' => $oferta,
                'precio_unitario' => $request->precio_unitario,
                'iva' => $iva,
                'impoconsumo' => $impoconsumo,
                'descuento_porcentaje' => $descuento_porcentaje,
                'descuento_valor' => $descuento_valor,
                'precio' => $precio,
                'precio_puntos' => $request->precio_puntos,
                'fidelizacion' => $request->fidelizacion,
                'media_id_principal' => $media_principal_id,
            ]);
            $producto->save();

            Flash::success('Producto Guardado con exito.');
        }
        //redireccion a listado de productos
        $usuario = \Auth::user();
        $productos = ProductosFidepuntos::all();
        $companias = CompaniasFidepuntos::where('activo', '1')->where('erp', '1')->get();
        return view('fidepuntos/productos', [
			'usuario' => $usuario,
            'productos' => $productos,
            'companias' => $companias,
		]);
    }
    //Fin Crud productos Fidepuntos

    //Inicio Crud planpunto Fidepuntos
    //planpuntos fidepuntos index
    public function planpuntos_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        $planpuntos = PlanPuntosxCompaniaFidepuntos::all();
        return view('fidepuntos/planpuntos', [
			'usuario' => $usuario,
            'planpuntos' => $planpuntos,
            'companias' => $companias,
		]);

    }


    //Edicion de una planpunto fidepuntos
    public function planpuntos_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $compania = CompaniasFidepuntos::find($id);
        $puntosxcompra = false;
        $puntosxproducto = false;
        $fidelizacioncliente = false;
        $planpuntos = PlanPuntosxCompaniaFidepuntos::where('compania_id', $compania->id)->get();
        foreach ($planpuntos as $pp) {
            if ($pp->plan_puntos_id == 1 && $pp->activo == 1) {
                $puntosxcompra = true;
            }elseif ($pp->plan_puntos_id == 2 && $pp->activo == 1) {
                $puntosxproducto = true;
            }elseif ($pp->plan_puntos_id == 3 && $pp->activo == 1) {
                $fidelizacioncliente = true;
            }
        }

        return view('fidepuntos/updateplanpunto', [
			'usuario' => $usuario,
            'compania' => $compania,
            'puntosxcompra' => $puntosxcompra,
            'puntosxproducto' => $puntosxproducto,
            'fidelizacioncliente' => $fidelizacioncliente,
		]);

    }

    //Guardad de la edicion de una planpuntos fidepuntos
    public function planpuntos_fidepuntos_update_save(Request $request)
    {
        //condicion plan puntos por compras
        if (isset($request->puntosxcompra) && $request->puntosxcompra == 1) {
            $planPuntosxCompras = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '1')->get();
            if (count($planPuntosxCompras) > 0) {
                foreach ($planPuntosxCompras as $ppxc) {
                    $ppxc->activo = 1;
                    $ppxc->save();
                }
            }else{
                $planPuntosxComprasNuevo = PlanPuntosxCompaniaFidepuntos::create([
                    'plan_puntos_id' => "1",
                    'compania_id' => $request->compania_id,
                    'activo' => "1",
                ]);
                $planPuntosxComprasNuevo->save();
            }
        }else{
            $planPuntosxCompras = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '1')->get();
            if (count($planPuntosxCompras) > 0) {
                foreach ($planPuntosxCompras as $ppxc) {
                    $ppxc->activo = "0";
                    $ppxc->save();
                }
            }
        }

        //condicion plan puntos por productos
        if (isset($request->puntosxproducto) && $request->puntosxproducto == 2) {
            $planPuntosxProductos = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '2')->get();
            if (count($planPuntosxProductos) > 0) {
                foreach ($planPuntosxProductos as $ppxp) {
                    $ppxp->activo = "1";
                    $ppxp->save();
                }
            }else{
                $planPuntosxProductosNuevo = PlanPuntosxCompaniaFidepuntos::create([
                    'plan_puntos_id' => "2",
                    'compania_id' => $request->compania_id,
                    'activo' => "1",
                ]);
                $planPuntosxProductosNuevo->save();
            }
        }else{
            $planPuntosxProductos = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '2')->get();
            if (count($planPuntosxProductos) > 0) {
                foreach ($planPuntosxProductos as $ppxp) {
                    $ppxp->activo = "0";
                    $ppxp->save();
                }
            }
        }

        //condicion plan fidelizacion cliente
        if (isset($request->fidelizacioncliente) && $request->fidelizacioncliente == 3) {
            $planFidelizacionClientes = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '3')->get();
            if (count($planFidelizacionClientes) > 0) {
                foreach ($planFidelizacionClientes as $pfc) {
                    $pfc->activo = 1;
                    $pfc->save();
                }
            }else{
                $planFidelizacionClientesNuevo = PlanPuntosxCompaniaFidepuntos::create([
                    'plan_puntos_id' => "3",
                    'compania_id' => $request->compania_id,
                    'activo' => "1",
                ]);
                $planFidelizacionClientesNuevo->save();
            }
        }else{
            $planFidelizacionClientes = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '3')->get();
            if (count($planFidelizacionClientes) > 0) {
                foreach ($planFidelizacionClientes as $pfc) {
                    $pfc->activo = "0";
                    $pfc->save();
                }
            }
        }

        //redireccion a listado de planpuntos
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        $planpuntos = PlanPuntosxCompaniaFidepuntos::all();
        return view('fidepuntos/planpuntos', [
			'usuario' => $usuario,
            'planpuntos' => $planpuntos,
            'companias' => $companias,
		]);

    }
    //Fin Crud Plan Puntos Fidepuntos

    //Inicio Crud puntos x compra Fidepuntos
    //puntos x comprea fidepuntos index
    public function puntoscompra_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $companiasplanpuntoscompra = PlanPuntosxCompaniaFidepuntos::where('plan_puntos_id', '1')->where('activo', '1')->get();
        $puntoscompra = PuntosxComprasFidepuntos::all();
        return view('fidepuntos/puntoscompra', [
			'usuario' => $usuario,
            'companiasplanpuntoscompra' => $companiasplanpuntoscompra,
            'puntoscompra' => $puntoscompra,
		]);

    }


    //Edicion de una planpunto fidepuntos
    public function puntoscompra_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $control_existe_configuracion = false;
        $plan_punto_compania = PlanPuntosxCompaniaFidepuntos::find($id);
        $configuracion_puntos_compras = PuntosxComprasFidepuntos::where('plan_puntos_compania_id', $id)->get();
        if (count($configuracion_puntos_compras) > 0) {
            $control_existe_configuracion = true;
        }


        return view('fidepuntos/updatepuntoscompra', [
			'usuario' => $usuario,
            'control_existe_configuracion' => $control_existe_configuracion,
            'plan_punto_compania' => $plan_punto_compania,
            'configuracion_puntos_compras' => $configuracion_puntos_compras,
		]);

    }

    //Guardad de la edicion de una puntoscompra fidepuntos
    public function puntoscompra_fidepuntos_update_save(Request $request)
    {

        $configuracion_puntos_compras = PuntosxComprasFidepuntos::where('plan_puntos_compania_id', $request->plan_puntos_compania_id)->get();
        if (count($configuracion_puntos_compras) > 0) {
            foreach ($configuracion_puntos_compras as $key => $cpc) {
                $cpc->valor_punto = $request->valor_punto;
                $cpc->valor_punto_canje = $request->valor_punto_canje;
                $cpc->save();
            }
        }else{
            $nueva_configuracion_puntos_compras = PuntosxComprasFidepuntos::create([
                'plan_puntos_compania_id' => $request->plan_puntos_compania_id,
                'valor_punto' => $request->valor_punto,
                'valor_punto_canje' => $request->valor_punto_canje,
            ]);
            $nueva_configuracion_puntos_compras->save();
        }

        //redireccion a listado de puntoscompra
        $usuario = \Auth::user();
        $companiasplanpuntoscompra = PlanPuntosxCompaniaFidepuntos::where('plan_puntos_id', '1')->where('activo', '1')->get();
        $puntoscompra = PuntosxComprasFidepuntos::all();
        return view('fidepuntos/puntoscompra', [
			'usuario' => $usuario,
            'companiasplanpuntoscompra' => $companiasplanpuntoscompra,
            'puntoscompra' => $puntoscompra,
		]);

    }
    //Fin Crud Puntos Compras Fidepuntos

    //Inicio Crud puntos x producto Fidepuntos
    //puntos x producto fidepuntos index
    public function puntosproducto_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $companiasplanpuntosproducto = PlanPuntosxCompaniaFidepuntos::where('plan_puntos_id', '2')->where('activo', '1')->get();
        return view('fidepuntos/puntosproducto', [
			'usuario' => $usuario,
            'companiasplanpuntosproducto' => $companiasplanpuntosproducto,
		]);

    }


    //Edicion de una planpunto fidepuntos
    public function puntosproducto_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $plan_punto_compania = PlanPuntosxCompaniaFidepuntos::find($id);
        $fabricantes = FabricantesFidepuntos::where('compania_id', $plan_punto_compania->compania->id)->where('activo', '1')->get();
        $marcas = MarcasFidepuntos::where('compania_id', $plan_punto_compania->compania->id)->where('activo', '1')->get();
        $categorias = CategoriasFidepuntos::where('compania_id', $plan_punto_compania->compania->id)->where('activo', '1')->get();
        $productos = ProductosFidepuntos::where('compania_id', $plan_punto_compania->compania->id)->where('activo', '1')->get();
        $configuracion_puntos_productos = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $id)->get();

        return view('fidepuntos/updatepuntosproducto', [
			'usuario' => $usuario,
            'plan_punto_compania' => $plan_punto_compania,
            'fabricantes' => $fabricantes,
            'marcas' => $marcas,
            'categorias' => $categorias,
            'productos' => $productos,
            'configuracion_puntos_productos' => $configuracion_puntos_productos,
		]);

    }

    //Guardad de la edicion de una puntosproducto fidepuntos
    public function puntosproducto_fidepuntos_update_save(Request $request)
    {
        if ($request->puntaje_asignado_fabricante != null) {
            $control_existe_config_fabricante = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $request->plan_puntos_compania_id)->where('fabricante_id', $request->fabricante_id)->first();
            if ($control_existe_config_fabricante == null) {
                $config_fabricante_nuevo = PuntosxproductosFidepuntos::create([
                    'plan_puntos_compania_id' => $request->plan_puntos_compania_id,
                    'fabricante_id' => $request->fabricante_id,
                    'puntaje_asignado' => $request->puntaje_asignado_fabricante,
                    'excluir_puntos_compra' => 0,
                ]);
                $config_fabricante_nuevo->save();
            }else{
                $control_existe_config_fabricante->puntaje_asignado = $request->puntaje_asignado_fabricante;
                $control_existe_config_fabricante->save();
            }
        }
        if ($request->puntaje_asignado_marca != null) {
            $control_existe_config_marca = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $request->plan_puntos_compania_id)->where('marca_id', $request->marca_id)->first();
            if ($control_existe_config_marca == null) {
                $config_marca_nuevo = PuntosxproductosFidepuntos::create([
                    'plan_puntos_compania_id' => $request->plan_puntos_compania_id,
                    'marca_id' => $request->marca_id,
                    'puntaje_asignado' => $request->puntaje_asignado_marca,
                    'excluir_puntos_compra' => 0,
                ]);
                $config_marca_nuevo->save();
            }else{
                $control_existe_config_marca->puntaje_asignado = $request->puntaje_asignado_marca;
                $control_existe_config_marca->save();
            }
        }
        if ($request->puntaje_asignado_categoria != null) {
            $control_existe_config_categoria = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $request->plan_puntos_compania_id)->where('categoria_id', $request->categoria_id)->first();
            if ($control_existe_config_categoria == null) {
                $config_categoria_nuevo = PuntosxproductosFidepuntos::create([
                    'plan_puntos_compania_id' => $request->plan_puntos_compania_id,
                    'categoria_id' => $request->categoria_id,
                    'puntaje_asignado' => $request->puntaje_asignado_categoria,
                    'excluir_puntos_compra' => 0,
                ]);
                $config_categoria_nuevo->save();
            }else{
                $control_existe_config_categoria->puntaje_asignado = $request->puntaje_asignado_categoria;
                $control_existe_config_categoria->save();
            }
        }
        if ($request->puntaje_asignado_producto != null) {
            $control_existe_config_producto = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $request->plan_puntos_compania_id)->where('producto_id', $request->producto_id)->first();
            if ($control_existe_config_producto == null) {
                $config_producto_nuevo = PuntosxproductosFidepuntos::create([
                    'plan_puntos_compania_id' => $request->plan_puntos_compania_id,
                    'producto_id' => $request->producto_id,
                    'puntaje_asignado' => $request->puntaje_asignado_producto,
                    'excluir_puntos_compra' => 0,
                ]);
                $config_producto_nuevo->save();
            }else{
                $control_existe_config_producto->puntaje_asignado = $request->puntaje_asignado_producto;
                $control_existe_config_producto->save();
            }
        }

        //redireccion a listado de puntosproducto
        $usuario = \Auth::user();
        $companiasplanpuntosproducto = PlanPuntosxCompaniaFidepuntos::where('plan_puntos_id', '2')->where('activo', '1')->get();
        return view('fidepuntos/puntosproducto', [
			'usuario' => $usuario,
            'companiasplanpuntosproducto' => $companiasplanpuntosproducto,
		]);

    }
    //Fin Crud Puntos productos Fidepuntos

    //Inicio Crud Fidelizacion Clientes Fidepuntos
    //Fidelizacion Clientes fidepuntos index
    public function fidelizacionconfig_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $fidelizacionconfig = ConfigFidelizacionClientesFidepuntos::all();
        return view('fidepuntos/fidelizacionconfig', [
			'usuario' => $usuario,
            'fidelizacionconfig' => $fidelizacionconfig
		]);

    }

    //Vista de una Categoria fidepuntos
    public function fidelizacionconfig_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $categoria = fidelizacionconfigFidepuntos::find($id);
        return view('fidepuntos/viewcategoria', [
			'usuario' => $usuario,
            'categoria' => $categoria
		]);

    }

    //Edicion de una Categoria fidepuntos
    public function fidelizacionconfig_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $categoria = fidelizacionconfigFidepuntos::find($id);
        return view('fidepuntos/updatecategoria', [
			'usuario' => $usuario,
            'categoria' => $categoria,
		]);

    }

    //Guardad de la edicion de una fidelizacionconfig fidepuntos
    public function fidelizacionconfig_fidepuntos_update_save(Request $request)
    {
        $nombre_categoria = ucwords(strtolower($request->nombre_categoria));
        $categoria = fidelizacionconfigFidepuntos::find($request->categoria_id);

        $categoria->nombre_categoria = $nombre_categoria;
        $categoria->activo = $request->activo;

        $categoria->save();

        //redireccion a listado de fidelizacionconfig
        $usuario = \Auth::user();
        $fidelizacionconfig = fidelizacionconfigFidepuntos::all();
        return view('fidepuntos/fidelizacionconfig', [
			'usuario' => $usuario,
            'fidelizacionconfig' => $fidelizacionconfig
		]);

    }

    //Vista de Creacion de nueva categoria
    public function fidelizacionconfig_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companiasfidelizacionclientes = PlanPuntosxCompaniaFidepuntos::where('plan_puntos_id', '3')->where('activo', '1')->get();
        return view('fidepuntos/createconfigfidelizacioncliente', [
			'usuario' => $usuario,
			'companiasfidelizacionclientes' => $companiasfidelizacionclientes,
		]);

    }

    //Guarda un nueva categoria
    public function fidelizacionconfig_fidepuntos_create_save(Request $request)
    {
        if (isset($request->compania_id) && isset($request->producto_id) && isset($request->producto_canjeable_id) && ($request->porcentaje_descuento_canje != null || $request->numero_compras_canje != null)) {
            $control_fidelizacion = ConfigFidelizacionClientesFidepuntos::where('producto_id', $request->producto_id)->first();
            if ($control_fidelizacion == null) {
                $config_fidelizacion_nuevo = ConfigFidelizacionClientesFidepuntos::create([
                    'plan_puntos_compania_id' => $request->compania_id,
                    'producto_id' => $request->producto_id,
                    'tipo_fidelizacion' => $request->tipo_fidelizacion,
                    'producto_id' => $request->producto_id,
                    'porcentaje_descuento_canje' => $request->porcentaje_descuento_canje,
                    'numero_compras_canje' => $request->numero_compras_canje,
                    'producto_canjeable_id' => $request->producto_canjeable_id,
                ]);
                $config_fidelizacion_nuevo->save();

                $producto_editar = ProductosFidepuntos::find($config_fidelizacion_nuevo->producto_id);
                $producto_editar->fidelizacion = '1';
                $producto_editar->save();

                Flash::success('La configuracion se creo exitosamente.');
            }else{
                Flash::error('El producto ya cuenta con una configuracion. Se debe editar');
            }
        }else{
            Flash::error('No se creo la configuracion por falta de un campo en el formulario.');

        }

        //redireccion a listado de fidelizacionconfig
        $usuario = \Auth::user();
        $fidelizacionconfig = ConfigFidelizacionClientesFidepuntos::all();
        return view('fidepuntos/fidelizacionconfig', [
			'usuario' => $usuario,
            'fidelizacionconfig' => $fidelizacionconfig
		]);
    }
    //Fin Crud fidelizacionconfig Fidepuntos

    //Inicio Crud Pedidos Fidepuntos
    //Pedidos fidepuntos index
    public function pedidos_fidepuntos_index()
    {
        $usuario = \Auth::user();
        $pedidos = PedidosFidepuntos::all();
        return view('fidepuntos/pedidos', [
			'usuario' => $usuario,
            'pedidos' => $pedidos
		]);

    }

    //Vista de un Pedido fidepuntos
    public function pedidos_fidepuntos_view($id)
    {
        $usuario = \Auth::user();
        $pedido = PedidosFidepuntos::find($id);
        $productosxpeidos = PedidosxProductosFidepuntos::where("pedido_id", $id)->get();
        return view('fidepuntos/viewpedido', [
			'usuario' => $usuario,
            'pedido' => $pedido,
            'productosxpeidos' => $productosxpeidos,
		]);

    }
    //Edicion de una Categoria fidepuntos
    public function pedidos_fidepuntos_update($id)
    {
        $usuario = \Auth::user();
        $categoria = PedidosFidepuntos::find($id);
        return view('fidepuntos/updatecategoria', [
			'usuario' => $usuario,
            'categoria' => $categoria,
		]);

    }

    //Guardad de la edicion de una pedidos fidepuntos
    public function pedidos_fidepuntos_update_save(Request $request)
    {
        $nombre_categoria = ucwords(strtolower($request->nombre_categoria));
        $categoria = PedidosFidepuntos::find($request->categoria_id);

        $categoria->nombre_categoria = $nombre_categoria;
        $categoria->activo = $request->activo;

        $categoria->save();

        //redireccion a listado de pedidos
        $usuario = \Auth::user();
        $pedidos = PedidosFidepuntos::all();
        return view('fidepuntos/pedidos', [
			'usuario' => $usuario,
            'pedidos' => $pedidos
		]);

    }

    //Vista de Creacion de nueva categoria
    public function pedidos_fidepuntos_create()
    {
        $usuario = \Auth::user();
        $companias = CompaniasFidepuntos::where('activo', '1')->get();
        return view('fidepuntos/createpedido', [
			'usuario' => $usuario,
			'companias' => $companias,
		]);

    }

    //Guarda un nuevo Pedido
    public function pedidos_fidepuntos_create_save(Request $request)
    {
        $productos = ProductosFidepuntos::where('compania_id', $request->compania_id)->where('activo', '1')->get();
        $prods_seleccionados = [];
        $valor_pedido = 0;
        $cantidad = 0;
        $puntos_asignar_compras = 0;
        $puntos_asignar_productos = 0;
        foreach ($productos as $key => $prod) {
            $seleccionador_prod = "seleccionadoprod-" . $prod->id;
            $cantidad_prod = "cantidadprod-" . $prod->id;
            if ($request->{$seleccionador_prod}) {
                $prod_selec_tmp = array("id_producto" => $request->{$seleccionador_prod},
                            "cantidad" => $request->{$cantidad_prod});
                array_push($prods_seleccionados, $prod_selec_tmp);
            }
        }
        if (count($prods_seleccionados) > 0) {
            $cod_aleatorio = rand(1000000,9999999);
            $cod_pedido = $request->compania_id . "-" . $cod_aleatorio;
            $cliente = ClienteFidepuntos::find($request->cliente_id);
            $pedido_nuevo = PedidosFidepuntos::create([
                'codigo_pedido' => $cod_pedido,
                'valor_pedido' => $valor_pedido,
                'estado_pedido' => 1,
                'compania_id' => $request->compania_id,
                'identificacion_cliente' => $cliente->identificacion,
                'cliente_id' => $cliente->id,
                'fecha_envio' => $request->fecha_envio,
                'metodo_pago' => $request->metodo_pago,
                'fecha_pago' => $request->fecha_pago,
            ]);
            $pedido_nuevo->save();

            foreach ($prods_seleccionados as $key => $ps) {
                $cantidad = 0;
                $producto_tmp = ProductosFidepuntos::find($ps["id_producto"]);
                if ($ps["cantidad"] > 0) {
                    $cantidad = $ps["cantidad"];
                }else{
                    $cantidad = 1;
                }
                $pedidoxproducto_nuevo = PedidosxProductosFidepuntos::create([
                    'pedido_id' => $pedido_nuevo->id,
                    'codigo_producto' => $producto_tmp->codigo_producto,
                    'producto_id' => $producto_tmp->id,
                    'cantidad' => $cantidad,
                    'objetivo' => $producto_tmp->objetivo,
                    'oferta' => $producto_tmp->oferta,
                    'precio_unitario' => $producto_tmp->precio_unitario,
                    'iva' => $producto_tmp->iva,
                    'impoconsumo' => $producto_tmp->impoconsumo,
                    'descuento_porcentaje' => $producto_tmp->descuento_porcentaje,
                    'descuento_valor' => $producto_tmp->descuento_valor,
                    'precio' => $producto_tmp->precio,
                    'precio_puntos' => $producto_tmp->precio_puntos,
                    'fidelizacion' => $producto_tmp->fidelizacion,
                ]);
                $pedidoxproducto_nuevo->save();
                $valor_pedido = $valor_pedido + ($producto_tmp->precio * $cantidad);
                $pedido_nuevo->valor_pedido = $valor_pedido;
                $pedido_nuevo->save();
            }
            // Se valida si la compañia cuenta con plan puntos x compra
            $plan_puntosxcompras = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '1')->first();
            if ($plan_puntosxcompras) {
                $config_puntosxcompra = PuntosxComprasFidepuntos::where('plan_puntos_compania_id', $plan_puntosxcompras->id)->first();
                $puntos_asignar_compras = round($valor_pedido / $config_puntosxcompra->valor_punto);
                $movimiento_puntos_compra_nuevo = MovimientosPuntosFidepuntos::create([
                    'pedido_id' => $pedido_nuevo->id,
                    'puntaje_anterior' => $cliente->puntos_total,
                    'tipo' => "compras",
                    'puntos_compras_id' => $config_puntosxcompra->id,
                    'puntos_otrogados' => $puntos_asignar_compras,
                    'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_compras,
                ]);
                $movimiento_puntos_compra_nuevo->save();
                $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_compras;
                $cliente->save();
            }
            // Se valida si la compañia cuenta con plan puntos x compra
            $plan_puntosxproductos = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '2')->first();
            if ($plan_puntosxproductos) {
                $config_puntosxproductos = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $plan_puntosxproductos->id)->get();
                foreach ($prods_seleccionados as $key => $prod_selec) {
                    $producto_aplicar_puntos = ProductosFidepuntos::find($prod_selec["id_producto"]);
                    foreach ($config_puntosxproductos as $key => $cpp) {
                        if ($cpp->fabricante_id != null && $producto_aplicar_puntos->fabricante_id == $cpp->fabricante_id) {
                            $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                            $movimiento_puntos_fabricante_nuevo = MovimientosPuntosFidepuntos::create([
                                'pedido_id' => $pedido_nuevo->id,
                                'puntaje_anterior' => $cliente->puntos_total,
                                'tipo' => "productos",
                                'puntos_productos_id' => $cpp->id,
                                'puntos_otrogados' => $cpp->puntaje_asignado,
                                'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                            ]);
                            $movimiento_puntos_fabricante_nuevo->save();
                            $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                            $cliente->save();
                            $puntos_asignar_productos = 0;
                        }
                        if ($cpp->marca_id != null && $producto_aplicar_puntos->marca_id == $cpp->marca_id) {
                            $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                            $movimiento_puntos_marca_nuevo = MovimientosPuntosFidepuntos::create([
                                'pedido_id' => $pedido_nuevo->id,
                                'puntaje_anterior' => $cliente->puntos_total,
                                'tipo' => "productos",
                                'puntos_productos_id' => $cpp->id,
                                'puntos_otrogados' => $cpp->puntaje_asignado,
                                'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                            ]);
                            $movimiento_puntos_marca_nuevo->save();
                            $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                            $cliente->save();
                            $puntos_asignar_productos = 0;
                        }
                        if ($cpp->categoria_id != null && $producto_aplicar_puntos->categoria_id == $cpp->categoria_id) {
                            $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                            $movimiento_puntos_categorias_nuevo = MovimientosPuntosFidepuntos::create([
                                'pedido_id' => $pedido_nuevo->id,
                                'puntaje_anterior' => $cliente->puntos_total,
                                'tipo' => "productos",
                                'puntos_productos_id' => $cpp->id,
                                'puntos_otrogados' => $cpp->puntaje_asignado,
                                'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                            ]);
                            $movimiento_puntos_categorias_nuevo->save();
                            $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                            $cliente->save();
                            $puntos_asignar_productos = 0;
                        }
                        if ($cpp->producto_id != null && $producto_aplicar_puntos->id == $cpp->producto_id) {
                            $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                            $movimiento_puntos_producto_nuevo = MovimientosPuntosFidepuntos::create([
                                'pedido_id' => $pedido_nuevo->id,
                                'puntaje_anterior' => $cliente->puntos_total,
                                'tipo' => "productos",
                                'puntos_productos_id' => $cpp->id,
                                'puntos_otrogados' => $cpp->puntaje_asignado,
                                'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                            ]);
                            $movimiento_puntos_producto_nuevo->save();
                            $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                            $cliente->save();
                            $puntos_asignar_productos = 0;
                        }
                    }
                }
            }
            // Se valida si hay productos con Fidelizacion de clientes
            $plan_fidelizacion = PlanPuntosxCompaniaFidepuntos::where('compania_id', $request->compania_id)->where('plan_puntos_id', '3')->first();
            if ($plan_fidelizacion) {
                $config_fidelizacion = ConfigFidelizacionClientesFidepuntos::where('plan_puntos_compania_id', $plan_fidelizacion->id)->get();
                foreach ($config_fidelizacion as $key => $cf) {
                    foreach ($prods_seleccionados as $key => $prod_fidelizacion) {
                        if ($cf->producto_id ==  $prod_fidelizacion["id_producto"]) {
                            $fidelizacion_nuevo = FidelizacionClientesFidepuntos::create([
                                'config_fidelizacion_cliente_id' => $cf->id,
                                'pedido_id' => $pedido_nuevo->id,
                                'canjeado' => 0,
                            ]);
                            $fidelizacion_nuevo->save();
                        }
                    }
                }
            }
            Flash::success('Pedido creado exitosamente.');
        }else{
            Flash::error('No se creo pedido por no tener productos');
        }
        //redireccion a listado de pedidos
        $usuario = \Auth::user();
        $pedidos = PedidosFidepuntos::all();
        return view('fidepuntos/pedidos', [
			'usuario' => $usuario,
            'pedidos' => $pedidos
		]);
    }
    //Fin Crud pedidos Fidepuntos

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

    //Inicio Import de Clientes Fidepuntos

    public function export_productos_fidepuntos()
    {
        return Excel::download(new ProductoFidepuntosPlantillaExport, 'plantilla_productos.xlsx');
    }

    public function import_productos_fidepuntos(Request $request)
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
        $file = $request->file('file_productos_fidepuntos');
        Excel::import(new ProductosFidepuntosImport($identificador_importacion, $date), $file);

        $logs_importar_cliente = LogsImportacionesFidepuntos::where('identificador_importacion', $identificador_importacion)->get();
        foreach ($logs_importar_cliente as $key => $lip) {
            if ($lip->resultado == 'exitoso') {
                $registros_exitosos  = $registros_exitosos + 1;
            }elseif ($lip->resultado == 'declinado') {
                $registros_declinados = $registros_declinados + 1;
                if ($lip->motivo_decline == 'campos requeridos vacios' ) {
                    $registros_declinados_campos_vacios = $registros_declinados_campos_vacios + 1;
                    array_push($filas_declinadas_campos_vacios, $lip->numero_fila_excel);
                    $string_filas_error_campos_vacios = json_encode( $filas_declinadas_campos_vacios );
                }elseif ($lip->motivo_decline == 'producto ya existe') {
                    $registros_declinados_duplicidad_cliente = $registros_declinados_duplicidad_cliente + 1;
                    array_push($filas_declinadas_duplicidad_cliente, $lip->numero_fila_excel);
                    $string_filas_error_duplicidad_cliente = json_encode( $filas_declinadas_duplicidad_cliente );
                }
            }
        }
        $proceso_importacion = 'productos';

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

    //Fin Import de Productos Fidepuntos

    //Inicio Funciones Ajaxs
    public function obtenerfabricantesxcompania(Request $request)
    {
        $compania_id = $request->get('compania_id');
        $fabricantes = FabricantesFidepuntos::where('compania_id', $compania_id)->get();

        return $fabricantes;
    }
    public function obtenerclientesxcompania(Request $request)
    {
        $compania_id = $request->get('compania_id');
        $clientes = ClienteFidepuntos::where('compania_id', $compania_id)->orderBy('identificacion','ASC')->get();

        return $clientes;
    }
    public function obtenerproductospedidosxcompania(Request $request)
    {
        $compania_id = $request->get('compania_id');
        $productos = ProductosFidepuntos::where('compania_id', $compania_id)->where('activo', '1')->orderBy('codigo_producto','ASC')->get();

        return $productos;
    }
    public function obtenerproductosxcompania(Request $request)
    {
        $compania_fidelizacion_cliente_id = $request->get('compania_fidelizacion_cliente');
        $companiasfidelizacioncliente = PlanPuntosxCompaniaFidepuntos::find($compania_fidelizacion_cliente_id);
        $productos = ProductosFidepuntos::where('compania_id', $companiasfidelizacioncliente->compania_id)->where('activo', '1')->get();

        return $productos;
    }
    public function obtenermarcasxfabricantes(Request $request)
    {
        $fabricante_id = $request->get('fabricante_id');
        $marcas = MarcasFidepuntos::where('fabricante_id', $fabricante_id)->get();

        return $marcas;
    }
    public function obtenercategoriasxcompania(Request $request)
    {
        $compania_id = $request->get('compania_id');
        $categorias = CategoriasFidepuntos::where('compania_id', $compania_id)->get();

        return $categorias;
    }
    public function actualizacionimagenprincipal(Request $request)
    {
        $producto = ProductosFidepuntos::find($request->producto_id);


        $uploadedMediaUrlPrincipal = Cloudinary::uploadFile( $request ->file( 'imagen_principal' )->getRealPath (), ['folder' => 'puntosgroup_media'])->getSecurePath ();

        $media = BibliotecaMediaFidepuntos::create([
            'nombre' => $producto->nombre_producto,
            'url' => $uploadedMediaUrlPrincipal,
            'tipo' => 'imagen',
            'descripcion' => 'principal',
        ]);
        $media->save();

        $producto->media_id_principal = $media->id;
        $producto->save();

        $usuario = \Auth::user();
        $productos = ProductosFidepuntos::all();
        $companias = CompaniasFidepuntos::where('activo', '1')->where('erp', '1')->get();
        return view('fidepuntos/productos', [
			'usuario' => $usuario,
            'productos' => $productos,
            'companias' => $companias,
		]);
    }
    //Fin Funciones Ajaxs

    public function actualizacion_erp_clientes(Request $request)
    {
        ini_set('max_execution_time', '300');
        $compania_id = $request->compania_id;
        $compania = CompaniasFidepuntos::find($compania_id);
        $proceso_actualziacion = $request->proceso;
        if ($compania_id != null) {
            $erp_info = ErpsFidepuntos::where('compania_id', $compania_id)->get();
            $endpoint = $erp_info[0]->endpoint;
            $token = $erp_info[0]->token;
            $data_connection = $erp_info[0]->data_connection;
            if ($proceso_actualziacion == "clientes") {
                ActualizacionClientesFidepuntos::dispatch($compania_id, $compania->nombre_compania, $endpoint, $token, $data_connection);
                //ActualizacionClientesFidepuntos::dispatch();
            }
        }else{
            dd("no seleccionaron compañia a actualizar");
        }
        Flash::success('Cola procesada con exito. En unos segundos iniciara el proceso de actualización.');

        //redireccion a listado de clientes
        $usuario = \Auth::user();
        $clientes = ClienteFidepuntos::all();
        $companias = CompaniasFidepuntos::where('activo', '1')->where('erp', '1')->get();
        return view('fidepuntos/clientes', [
			'usuario' => $usuario,
            'clientes' => $clientes,
            'companias' => $companias
		]);
    }

    public function actualizacion_erp_productos(Request $request)
    {
        $compania_id = $request->compania_id;
        $compania = CompaniasFidepuntos::find($compania_id);
        $proceso_actualziacion = $request->proceso;
        if ($compania_id != null) {
            $erp_info = ErpsFidepuntos::where('compania_id', $compania_id)->get();
            $endpoint = $erp_info[0]->endpoint;
            $token = $erp_info[0]->token;
            $data_connection = $erp_info[0]->data_connection;
            if ($proceso_actualziacion == "productos") {
                ActualizacionProductosFidepuntos::dispatch($compania_id, $compania->nombre_compania, $endpoint, $token, $data_connection);
                //ActualizacionClientesFidepuntos::dispatch();
            }
        }else{
            dd("no seleccionaron compañia a actualizar");
        }
        Flash::success('Cola procesada con exito. En unos segundos iniciara el proceso de actualización.');

        //redireccion a listado de productos
        $usuario = \Auth::user();
        $productos = ProductosFidepuntos::all();
        $companias = CompaniasFidepuntos::where('activo', '1')->where('erp', '1')->get();
        return view('fidepuntos/productos', [
			'usuario' => $usuario,
            'productos' => $productos,
            'companias' => $companias
		]);
    }

}
