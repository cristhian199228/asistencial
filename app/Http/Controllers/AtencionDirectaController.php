<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AtencionDirecta;
use App\Usuario;
use Input;
use PDF;

class AtencionDirectaController extends Controller
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
            $categorias = AtencionDirecta::select('atencion_directas.id as codigo'  , 
                  DB::raw('concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES) as nombre_usuario,DATE_FORMAT(atencion_directas.fecha_at, "%d-%M-%Y") as fecha_atencion,DATE_FORMAT(atencion_directas.fecha_at, "%d-%m-%y") as fecha_atencion_imp'),
                  'usuario.USU_NOMBRES','usuario.USU_APELLIDOS','usuario.USU_FECHANAC', 'usuario.NIV_ID', 'atencion_directas.condicion','atencion_directas.codigo_paciente')
                ->join('usuario', 'usuario.USU_ID', '=', 'atencion_directas.codigo_paciente')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        else{
            if($criterio == 'nombre_paciente'){
                $criterio = 'concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES)';
                $categorias = AtencionDirecta::select('atencion_directas.id as codigo'  , 
                  DB::raw('concat(usuario.USU_NOMBRES," ",usuario.USU_APELLIDOS) as nombre_usuario,DATE_FORMAT(atencion_directas.fecha_at, "%d-%M-%Y") as fecha_atencion,DATE_FORMAT(atencion_directas.fecha_at, "%d-%m-%y") as fecha_atencion_imp'),
                  'usuario.USU_NOMBRES','usuario.USU_APELLIDOS','usuario.USU_FECHANAC', 'usuario.NIV_ID', 'atencion_directas.condicion','atencion_directas.codigo_paciente')
                ->join('usuario', 'usuario.USU_ID', '=', 'atencion_directas.codigo_paciente')
                ->where(DB::raw($criterio), 'like', '%'. $buscar . '%')
                ->orderBy('id', 'desc')
                ->paginate(10); 
            }
            else{
            $categorias =AtencionDirecta::select('atencion_directas.id as codigo'  , 
                  DB::raw('concat(usuario.USU_APELLIDOS," ",usuario.USU_NOMBRES) as nombre_usuario,DATE_FORMAT(atencion_directas.fecha_at, "%d-%M-%Y") as fecha_atencion,DATE_FORMAT(atencion_directas.fecha_at, "%d-%m-%y") as fecha_atencion_imp'),
                  'usuario.USU_NOMBRES','usuario.USU_APELLIDOS','usuario.USU_FECHANAC', 'usuario.NIV_ID', 'atencion_directas.condicion','atencion_directas.codigo_paciente')
                ->join('usuario', 'usuario.USU_ID', '=', 'atencion_directas.codigo_paciente')
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
        $atdirecta = new AtencionDirecta();
        $atdirecta->codigo_paciente = $request->codigo_paciente;
        $atdirecta->fecha_at = $request->fecha_at;
        $atdirecta->condicion = '1';
        $atdirecta->save();
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
        
    public function selectModelo($id){
        //if (!$request->ajax()) return redirect('/');
        $categorias = Modelo::where('condicion','=','1')
        ->where('id_marca','=',$id)        
        ->select('id','descripcion')->orderBy('descripcion', 'asc')->get();
        return ['modelo' => $categorias];
    }

    public function autocompletar()
    {
        // $result = User::where(DB::raw('concat(name," ",surname)') , 'LIKE' , '%keyword%')
        $users = Usuario::select(DB::raw('CONCAT (usuario.USU_NOMBRES," ",usuario.USU_APELLIDOS) as usuario_nombre ,usuario.USU_ID,
        usuario.NIV_ID,usuario.USU_FECHANAC,usuario.USU_NOMBRES,usuario.USU_APELLIDOS'))->get();
        //echo $users;
        //$id_paciente = $users
        //$nivel_id = 
        //$titular = Usuario::where(DB::raw('concat(usuario.USU_NOMBRES," ",usuario.USU_APELLIDOS) '),'like','%'.$query.'%')->get();        
        return ['paciente' => $users];
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
        $categorias = AtencionDirecta::max('id');
        $categorias = $categorias+1;
        return ['categorias' => $categorias];
    }

    public function DescargarPDF()
    {
        $codigo = Input::get('codigo');
        $codigo = $codigo;
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
        $pdf = PDF::loadView('pdf.atenciondirecta', compact('codigo','nombre_titular','edad_titular','codigo_titular',
        'nombre_paciente','edad_paciente','codigo_paciente','especialidad','fecha_atencion','fecha_validez'))
        ->setPaper('a4', 'portrait'); 
        return $pdf->stream();        
    }
    
}
