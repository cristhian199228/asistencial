<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CartaGarantia;
use App\Especialidad;
use App\Usuario;
use Input;
use PDF;

class CartaGarantiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){

            $categorias = CartaGarantia::select('carta_garantias.id as codigo'  , 
                  DB::raw('concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES) as nombre_usuario,DATE_FORMAT(carta_garantias.fecha_at, "%d-%M-%Y") as fecha_atencion,DATE_FORMAT(carta_garantias.fecha_at, "%d-%m-%Y") as fecha_atencion_imp,DATE_FORMAT(carta_garantias.fecha_at  + INTERVAL 10 DAY, "%d-%M-%Y") as fecha_atencion_validez,DATE_FORMAT(carta_garantias.fecha_at  + INTERVAL 10 DAY, "%d-%m-%Y") as fecha_atencion_validez_imp'),
                  'usuario.USU_APELLIDOS','usuario.USU_NOMBRES','usuario.USU_FECHANAC', 'usuario.NIV_ID', 'carta_garantias.condicion','carta_garantias.codigo_paciente','provedor.PRE_NOMBRE as nombre_provedor','especialidad.ESP_NOMBRE as nombre_especialidad')
                ->join('usuario', 'usuario.USU_ID', '=', 'carta_garantias.codigo_paciente')
                ->join('provedor', 'provedor.PRE_ID', '=', 'carta_garantias.codigo_especialista')
                ->join('especialidad', 'especialidad.ESP_ID', '=', 'provedor.ESP_ID')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        
        else{
            if($criterio == 'nombre_paciente'){
                $criterio = 'concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES)';
              $categorias = CartaGarantia::select('carta_garantias.id as codigo'  , 
                  DB::raw('concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES) as nombre_usuario,DATE_FORMAT(carta_garantias.fecha_at, "%d-%M-%Y") as fecha_atencion,DATE_FORMAT(carta_garantias.fecha_at, "%d-%m-%Y") as fecha_atencion_imp,DATE_FORMAT(carta_garantias.fecha_at  + INTERVAL 10 DAY, "%d-%M-%Y") as fecha_atencion_validez'),
                  'usuario.USU_APELLIDOS','usuario.USU_NOMBRES','usuario.USU_FECHANAC', 'usuario.NIV_ID', 'carta_garantias.condicion','carta_garantias.codigo_paciente','provedor.PRE_NOMBRE as nombre_provedor','especialidad.ESP_NOMBRE as nombre_especialidad')
                ->join('usuario', 'usuario.USU_ID', '=', 'carta_garantias.codigo_paciente')
                ->join('provedor', 'provedor.PRE_ID', '=', 'carta_garantias.codigo_especialista')
                ->join('especialidad', 'especialidad.ESP_ID', '=', 'provedor.ESP_ID')
                ->where(DB::raw($criterio), 'like', '%'. $buscar . '%')
                ->orderBy('id', 'desc')
                ->paginate(10); 
            }
            else{
             $categorias = CartaGarantia::select('carta_garantias.id as codigo'  , 
                  DB::raw('concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES) as nombre_usuario,DATE_FORMAT(carta_garantias.fecha_at, "%d-%M-%Y") as fecha_atencion,DATE_FORMAT(carta_garantias.fecha_at, "%d-%m-%Y") as fecha_atencion_imp,DATE_FORMAT(carta_garantias.fecha_at  + INTERVAL 10 DAY, "%d-%M-%Y") as fecha_atencion_validez'),
                  'usuario.USU_APELLIDOS','usuario.USU_NOMBRES','usuario.USU_FECHANAC', 'usuario.NIV_ID', 'carta_garantias.condicion','carta_garantias.codigo_paciente','provedor.PRE_NOMBRE as nombre_provedor','especialidad.ESP_NOMBRE as nombre_especialidad')
                ->join('usuario', 'usuario.USU_ID', '=', 'carta_garantias.codigo_paciente')
                ->join('provedor', 'provedor.PRE_ID', '=', 'carta_garantias.codigo_especialista')
                ->join('especialidad', 'especialidad.ESP_ID', '=', 'provedor.ESP_ID')
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('id', 'desc')
                ->paginate(10);
            }
            //$categorias = AtencionDirecta::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(10);
        }
        
        

        return [
            'pagination' => [
                'total'        => $categorias->total(),
                'current_page' => $categorias->currentPage(),
                'per_page'     => $categorias->perPage(),
                'last_page'    => $categorias->lastPage(),
                'from'         => $categorias->firstItem(),
                'to'           => $categorias->lastItem(),
            ],
            'categorias' => $categorias
        ];
    }

    public function selectCategoria(Request $request){
        if (!$request->ajax()) return redirect('/');
        $categorias = Categoria::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['categorias' => $categorias];
    }

    public function selectMarca(Request $request){
        if (!$request->ajax()) return redirect('/');
        $marcas = Marca::where('condicion','=','1')
        ->select('id','descripcion')->orderBy('descripcion', 'asc')->get();
        return ['marcas' => $marcas];
    }

    public function listarPdf(){
        $categorias = Categoria::select('nombre','descripcion','condicion')->orderBy('nombre', 'asc')->get();
        $cont = Categoria::count();

        $pdf = \PDF::loadView('pdf.categoriaspdf',['categorias'=>$categorias,'cont'=>$cont])->setPaper('a4', 'portrait');
        //return $pdf;

        return response()->file($pdf);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $cargarantia = new CartaGarantia();
        $cargarantia->codigo_paciente = $request->codigo_paciente;
        $cargarantia->fecha_at = $request->fecha_at;
        $cargarantia->codigo_especialista = $request->codigo_especialista;
        $cargarantia->condicion = '1';
        $cargarantia->save();
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Marca::findOrFail($request->id);        
        $categoria->descripcion = $request->descripcion;
        $categoria->comentario = $request->comentario;
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Marca::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Marca::findOrFail($request->id);
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function autocompletar()
    {
        $query = Input::get('query');
       // $result = User::where(DB::raw('concat(name," ",surname)') , 'LIKE' , '%keyword%')
        $users = Usuario::where(DB::raw('concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES) '),'like','%'.$query.'%')->get();
        //echo $users;
        //$id_paciente = $users
        //$nivel_id = 
        //$titular = Usuario::where(DB::raw('concat(usuario.USU_NOMBRES," ",usuario.USU_APELLIDOS) '),'like','%'.$query.'%')->get();
        return response()->json($users);
    }

    public function autocompletarEspecialidad()
    {
       
       // $result = User::where(DB::raw('concat(name," ",surname)') , 'LIKE' , '%keyword%')
        $consulta = Especialidad::select(DB::raw('concat(provedor.PRE_NOMBRE," / ",especialidad.ESP_NOMBRE) as busqueda, 
        provedor.PRE_NOMBRE as especialista , especialidad.ESP_NOMBRE as especialidad,provedor.PRE_ID as cod_esp'))
                ->join('provedor', 'provedor.ESP_ID', '=', 'especialidad.ESP_ID')
                ->get();
        //echo $users;
        //$id_paciente = $users
        //$nivel_id = 
        //$titular = Usuario::where(DB::raw('concat(usuario.USU_NOMBRES," ",usuario.USU_APELLIDOS) '),'like','%'.$query.'%')->get();


       
        return ['especialidad' => $consulta];
    }

    public function BuscarTitular()
    {
        
        //$categorias = AtencionDirecta::where('','=','1')->orderBy('id', 'desc')->paginate(10);
        $id_usuario = Input::get('query');
       // $result = User::where(DB::raw('concat(name," ",surname)') , 'LIKE' , '%keyword%')
        $id_usuario = substr ($id_usuario, 0, -2);
        $id_usuario = $id_usuario.'00';
        $users = Usuario::where('USU_ID','=',$id_usuario)
                        ->where('NIV_ID', '=', '00')
                        ->get();
        //echo $users;
        //$id_paciente = $users
        //$nivel_id = 
        //$titular = Usuario::where(DB::raw('concat(usuario.USU_NOMBRES," ",usuario.USU_APELLIDOS) '),'like','%'.$query.'%')->get();
        return response()->json($users);
    }

    public function sacarMaximo(Request $request){
        // if (!$request->ajax()) return redirect('/');
        //DB::table('orders')->max('id');
        $categorias = CartaGarantia::max('id');
        $categorias = $categorias+1;
        return ['categorias' => $categorias];
    }

    public function DescargarPDF()
    {
        
        $codigo = Input::get('codigo');
        $codigo = 'PD'.$codigo;
        $nombre_titular = Input::get('nombre_titular');
        $edad_titular = Input::get('edad_titular');
        $codigo_titular = Input::get('codigo_titular');
        $nombre_paciente = Input::get('nombre_paciente');
        $edad_paciente = Input::get('edad_paciente');
        $codigo_paciente = Input::get('codigo_paciente');
        $especialidad = Input::get('especialidad');
        $fecha_atencion = Input::get('fecha_atencion');
        $fecha_validez = Input::get('fecha_atencion_validez');
        
        
        //echo $id_usuario;
        $pdf = PDF::loadView('pdf.cartagarantia', compact('codigo','nombre_titular','edad_titular','codigo_titular',
        'nombre_paciente','edad_paciente','codigo_paciente','especialidad','fecha_atencion','fecha_validez'))
        ->setPaper('a4', 'portrait');        

        //return $pdf->download('listado.pdf');
        return $pdf->stream();
        
        
    }

    
}
