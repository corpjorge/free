<?php

namespace App\Http\Controllers\Admin_boleteria;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Model\Boleteria\Producto;
use App\Model\Boleteria\Serial;
use App\Model\Boleteria\Venta; 
use App\Model\Usuario\Users_detalle;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use \Carbon\Carbon;
use App\Exports\VentasExport;
use App\Exports\InventarioExport;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin_user')->user()->role_id <= 3) {
            $ventatotal   = Serial::where('estado_actual_id', 5)->count();
            $inventario   = Serial::where('admin_user_id', null)->count();
            $pendientes   = Serial::where('estado_actual_id', 3)->where('admin_user_id', '!=', null)->count();
            $valorventas  = Serial::where('estado_actual_id', 5)->sum('precio_venta');
            $valorcompra  = Serial::where('estado_actual_id', 5)->sum('precio_compra');
            $valorpublico = Serial::where('estado_actual_id', 5)->sum('precio_publico');
            $dt           = Carbon::now();
            $enero        = DB::table('seriales')->whereMonth('updated_at', 1)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $febrero      = DB::table('seriales')->whereMonth('updated_at', 2)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $marzo        = DB::table('seriales')->whereMonth('updated_at', 3)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $abril        = DB::table('seriales')->whereMonth('updated_at', 4)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $mayo         = DB::table('seriales')->whereMonth('updated_at', 5)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $junio        = DB::table('seriales')->whereMonth('updated_at', 6)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $julio        = DB::table('seriales')->whereMonth('updated_at', 7)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $agosto       = DB::table('seriales')->whereMonth('updated_at', 8)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $septiembre   = DB::table('seriales')->whereMonth('updated_at', 9)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $octubre      = DB::table('seriales')->whereMonth('updated_at', 10)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $noviembre    = DB::table('seriales')->whereMonth('updated_at', 11)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $diciembre    = DB::table('seriales')->whereMonth('updated_at', 12)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->count();
            $ventatablas  = Venta::orderBy('id', 'desc')->paginate(7);

            $ano             = $dt->year;
            $ahorroasociados = $valorpublico - $valorventas;
            $ahorrofondo     = $valorventas - $valorcompra;
                        
            return view(
                'admin_boleteria.informe.coordinador',
                compact(
                    'ventatotal',
                    'inventario',
                    'pendientes',
                    'valorventas',
                    'enero',
                    'febrero',
                    'marzo',
                    'abril',
                    'mayo',
                    'junio',
                    'julio',
                    'agosto',
                    'septiembre',
                    'octubre',
                    'noviembre',
                    'diciembre',
                    'valorcompra',
                    'ahorrofondo',
                    'ahorroasociados',
                    'ano',
                    'ventatablas'
                )
            );
        } else {
            $ventatotal   = Serial::where('admin_user_id', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', 5)->count();
            $inventario   = Serial::where('admin_user_id', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', 1)->count();
            $pendientes   = Serial::where('admin_user_id', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', 3)->count();
            $valorventas  = Serial::where('admin_user_id', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', 5)->sum('precio_venta');
            $valorcompra  = Serial::where('admin_user_id', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', 5)->sum('precio_compra');
            $valorpublico = Serial::where('admin_user_id', Auth::guard('admin_user')->user()->id)->where('estado_actual_id', 5)->sum('precio_publico');
            $dt           = Carbon::now();
            $enero        = DB::table('seriales')->whereMonth('updated_at', 1)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $febrero      = DB::table('seriales')->whereMonth('updated_at', 2)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $marzo        = DB::table('seriales')->whereMonth('updated_at', 3)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $abril        = DB::table('seriales')->whereMonth('updated_at', 4)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $mayo         = DB::table('seriales')->whereMonth('updated_at', 5)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $junio        = DB::table('seriales')->whereMonth('updated_at', 6)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $julio        = DB::table('seriales')->whereMonth('updated_at', 7)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $agosto       = DB::table('seriales')->whereMonth('updated_at', 8)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $septiembre   = DB::table('seriales')->whereMonth('updated_at', 9)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $octubre      = DB::table('seriales')->whereMonth('updated_at', 10)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $noviembre    = DB::table('seriales')->whereMonth('updated_at', 11)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $diciembre    = DB::table('seriales')->whereMonth('updated_at', 12)->whereYear('updated_at', $dt->year)->where('estado_actual_id', 5)->where('admin_user_id', Auth::guard('admin_user')->user()->id)->count();
            $ventatablas = Venta::where('admin_user_id', '=', Auth::guard('admin_user')->user()->id)->orderBy('id', 'desc')->paginate(7);
            $ano             = $dt->year;
            $ahorroasociados = $valorpublico - $valorventas;
            $ahorrofondo     = $valorventas - $valorcompra;
            
            return view(
                'admin_boleteria.informe.coordinador',
                compact(
                    'ventatotal',
                    'inventario',
                    'pendientes',
                    'valorventas',
                    'enero',
                    'febrero',
                    'marzo',
                    'abril',
                    'mayo',
                    'junio',
                    'julio',
                    'agosto',
                    'septiembre',
                    'octubre',
                    'noviembre',
                    'diciembre',
                    'valorcompra',
                    'ahorrofondo',
                    'ahorroasociados',
                    'ano',
                    'ventatablas'
                )
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Producto            $producto
     * @return \Illuminate\Http\Response
     */
    public function cedula(Request $request)
    {
        $this->Validate($request, ['cedula' => 'required|numeric']);

        $user = Users_detalle::where('cedula', $request->cedula)->first();

        if (!$user) {
            session()->flash('error', 'Cedula no se encuentra');
            return redirect()->back();
        } else {
          $ventas = Venta::where('user_id', $user->user_id)->paginate(15);
          return view('admin_boleteria.informe.cedula', compact('user'), ['ventas' => $ventas]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Producto            $producto
     * @return \Illuminate\Http\Response
     */
    public function referencia(Request $request)
    {
        $this->Validate($request, ['referencia' => 'required|']);

        $venta = Venta::where('referencia', $request->referencia)->first();
        if (!$venta) {
            session()->flash('error', 'Referencia no se encuentra');
            return redirect()->back();
        } else {
            $venta_detalles = Venta::find($venta->id)->venta_detalle;
            $usuario        = Users_detalle::where('user_id', $venta->user_id)->first();
            $telefonos      = User::find($venta->user_id)->usuario_telefono->first();

            foreach ($venta_detalles as $venta_detalle) {
                $totales[]       = $venta_detalle->producto->precio_venta;
                $totalpublicos[] = $venta_detalle->producto->precio_publico;
            }
            $total        = array_sum($totales);
            $totalpublico = array_sum($totalpublicos);
            $ganancia     = $totalpublico - $total;
            return view('admin_boleteria.venta.ver', compact('venta', 'usuario', 'telefonos', 'total', 'ganancia'), ['venta_detalles' => $venta_detalles]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Producto            $producto
     * @return \Illuminate\Http\Response
     */
    public function serial(Request $request)
    {
        $this->Validate($request, ['serial' => 'required|']);

        $serial = Serial::where('numero', $request->serial)->first();

        if (!$serial) {
            session()->flash('error', 'Serial no se encuentra');
            return redirect()->back();
        } else {
            $asignaciones = Serial::find($serial->id)->serial_asignacion;
            return view('admin_boleteria.seriales.ver', compact('serial'), ['asignaciones' => $asignaciones]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Producto            $producto
     * @return \Illuminate\Http\Response
     */
    public function inventario()
    {
        $usarios = AdminUser::all();

        foreach ($usarios as $usario) {
            $variable[]         = $usario->name;
            $usarioventas[]     = Venta::where('admin_user_id', $usario->id)->count();
            $usarioinventario[] = Serial::where('admin_user_id', $usario->id)->where('estado_actual_id', 1)->count();
        }

        $productolistas = Producto::all();
        foreach ($productolistas as $productolista) {
            $color            = substr(md5(time()), 0, 6);
            $colorse          = '#' . $color;
            $rand             = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $colors           = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            $proveedoresventa = Serial::where('estado_actual_id', 5)->where('producto_id', $productolista->id)->count();
            $torta[]          = $data          = ['value' => $proveedoresventa, 'color' => $colors, 'highlight' => $colorse, 'label' => $productolista->nombre];
        }
        if (empty($torta)) {
            $torta = ['value' => '0', 'color' => '#FF8000', 'highlight' => '#FF8000', 'label' => 'Vacío'];
        }

        return view('admin_boleteria.informe.inventario', compact('variable', 'usarioventas', 'usarioinventario', 'torta'));
    }

    public function serialesexcel()
    {
        $products = Serial::where('admin_user_id', '!=', null)->get();

        foreach ($products as $product) {
            $result[] = $tabla = ['id' => $product->id, 'producto'                 => $product->serial_producto->nombre,
                'Serial'                   => $product->numero, 'Precio compra'        => $product->precio_compra,
                'Precio publico'           => $product->precio_publico, 'Precio venta' => $product->precio_venta,
                'Fecha caducidad'          => $product->fecha_caducidad, 'Usuario'     => $product->serial_admin->name,
                'Estado'                   => $product->serial_estado->tipo,
            ];
        }

        if (empty($result)) {
            session()->flash('error', 'Resultado vacíos');
            return redirect()->back();
        }
        
        dd($result);

       
    }

    public function ventasesexcelCopia()
    {
        $products = DB::table('venta_detalles as vd')
                ->join('ventas as v', 'v.id', '=', 'vd.venta_id')
                ->join('seriales as s', 's.id', '=', 'vd.serial_id')
                ->join('productos as p', 'p.id', '=', 's.producto_id')
                ->join('admin_users as a', 'a.id', '=', 'v.admin_user_id')
                ->leftJoin('users_detalles as u', 'u.id', '=', 'v.user_id')
                ->select('s.numero as serial', 's.precio_venta as precio', 'p.nombre as producto', 'a.email as coordinador', 'u.cod_persona as usuario', 'v.radicado as radicado', 'v.created_at as fecha')
                ->where('s.estado_actual_id', '=', '5')               
                ->orderBy('v.id', 'desc')
                ->limit(1)
                ->get();
      
        foreach ($products as $product) {
            $result[] = $tabla = 
            [   
                'Fecha' => isset($product->fecha) ? $product->fecha : "N/A",
                'Radicado' => isset($product->radicado) ? $product->radicado : "N/A",
                'Producto' => isset($product->producto) ? $product->producto : "N/A",
                'Serial' => isset($product->serial) ? $product->serial : "N/A",               
                'Valor' => isset($product->precio) ? $product->precio : "N/A",              
                'Vendedor' => isset($product->coordinador) ? $product->coordinador : "N/A",
            ];
        }

        if (empty($result)) {
            session()->flash('error', 'Resultado vacíos');
            return redirect()->back();
        }         
    }
    
    public function ventasesexcel()
    {
        return Excel::download(new VentasExport, 'ventas.xlsx');         
    }
    
    public function tenenciaexcel ()
    {
        return Excel::download(new InventarioExport, 'Inventario.xlsx');
    }
}
