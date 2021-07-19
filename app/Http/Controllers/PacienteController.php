<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use KubAT\PhpSimple\HtmlDomParser;
use App\Producto;
use App\Log;
use App\Paciente;
use App\PacienteComprobante;
use DateTime;
use DatePeriod;
use DateInterval;
use Exception;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');


       

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            //$categorias = Paciente::orderBy('idpaciente', 'desc')->paginate(10);
            $categorias = Paciente::selectRaw("CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',nombres)) as nombre,
                CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',dni)) as dni,
                CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',apellido_paterno)) as a_paterno,
                CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',apellido_materno)) as a_materno
                ,idpaciente,direccion,telefono")              
                ->paginate(20);  
        }
        else{
            //$categorias = Paciente::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(10);
            $raw = "CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',".$criterio.")) LIKE '%".$buscar."%'";
            $categorias = Paciente::selectRaw("CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',nombres)) as nombre,
                CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',dni)) as dni,
                CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',apellido_paterno)) as a_paterno,
                CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',apellido_materno)) as a_materno
                ,idpaciente,direccion,telefono")
                ->whereRaw($raw)
                ->paginate(20); 
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

    public function listarPdf(){
        $categorias = Categoria::select('nombre','descripcion','condicion')->orderBy('nombre', 'asc')->get();
        $cont=Categoria::count();

        $pdf = \PDF::loadView('pdf.categoriaspdf',['categorias'=>$categorias,'cont'=>$cont])->setPaper('a4', 'portrait');
        return $pdf->download('categorias.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
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
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($request->id);
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function editar(Request $request)
    {
        
        //DB::table('myTable')->selectRaw('CAST(name as VARBINARY(max)) as name')->get();

        
        /*$data = Paciente::selectRaw("CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',nombres))")
        ->whereRaw("CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',dni)) = '72815630'")
        ->get();     
        


        return response()->json($data);
         */
        $idpaciente =$request->id;
        $dni =$request->dni;
        echo $dni;
       // mb_strtoupper($miTexto,'utf-8');
        $nombre =mb_strtoupper($request->nombre,'utf-8');
        //strtoupper($request->nombre);
        $ap_paterno =mb_strtoupper($request->ap_paterno,'utf-8');
        $ap_materno =mb_strtoupper($request->ap_materno,'utf-8');
 

        $data = Paciente::selectRaw("CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',nombres)) as nombre,
            CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',apellido_paterno)) as a_paterno,
            CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',apellido_materno)) as a_materno ,
            CONVERT(VARCHAR(MAX), DECRYPTBYPASSPHRASE('9utHxlI7{4(XcWc',dni)) as dni")
        ->whereRaw("idpaciente = '".$idpaciente."'")
            ->get();

           

                $updated_c = PacienteComprobante::whereRaw("idpaciente = '".$idpaciente."'")
        ->update(['nombres' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$nombre."')"),
                  'apellido_paterno' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$ap_paterno."')"),
                  'apellido_materno' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$ap_materno."')"),
                  'dni' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$dni."')")
            ]);

            $updated = Paciente::whereRaw("idpaciente = '".$idpaciente."'")
        ->update(['nombres' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$nombre."')"),
                  'apellido_paterno' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$ap_paterno."')"),
                  'apellido_materno' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$ap_materno."')"),
                  'dni' =>DB::raw("ENCRYPTBYPASSPHRASE('9utHxlI7{4(XcWc','".$dni."')")
            ]);

        
           

        
        
        
            
        if($updated_c) {
        // returns true
        $id_usuario =  auth()->user()->id ;
        $flight = new Log;
        $flight->usuario = $id_usuario;
        $flight->nombre_ant = $data[0]->nombre;
        $flight->nombre_nue = $nombre;
        $flight->ap_paterno_ant = $data[0]->a_paterno;
        $flight->ap_paterno_nue = $ap_paterno;
        $flight->ap_materno_ant = $data[0]->a_materno;
        $flight->ap_materno_nue = $ap_materno;
        //$flight->dni = $data[0]->dni;

        $flight->save();


        

        
       // print_r($data);
       echo 'seeee';
        }
        else
        {
        echo 'nadine';
        }


        


            
        
    }
    public function BuscarDNI($dni){
        //echo $dni;
        
        
        
         
        //OBTENEMOS EL VALOR
        //$consulta = file_get_html('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni)->plaintext;
        
        //$consulta = file_get_html('https://eldni.com/buscar-por-dni?dni='.$dni);
        $consulta = HtmlDomParser::file_get_html('https://eldni.com/buscar-por-dni?dni='.$dni);
        
        $datosnombres = array();
        foreach($consulta->find('td') as $header) {
         $datosnombres[] = $header->plaintext;
        }
        //print_r($headlines);
         
         
        //LA LOGICA DE LA PAGINAS ES APELLIDO PATERNO | APELLIDO MATERNO | NOMBRES
         
        //$partes = explode("|", $consulta);
         
         
        $datos = array(
                0 => $dni,
                1 => $datosnombres[0],
                2 => $datosnombres[1],
                3 => $datosnombres[2],
        );
         
        return ['reniec' => $datos];   
         
        
        
        }

    public function prueba(Request $request)
    {
       
       // if (!$request->ajax()) return redirect('/');

            $fecha = date('Y-m-j');
            $fecha_resta = new DateTime($fecha);
            $nuevafecha = strtotime ( '+100 day' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
            //echo $nuevafecha;

            $data = Producto::select('det_ingreso.iddet_ingreso','producto.codigo','producto.descripcion','det_ingreso.lote','det_ingreso.fechavencimiento')
            ->whereBetween('fechavencimiento', [$fecha,$nuevafecha])
            ->orderBy('fechavencimiento')
            ->join('producto', 'producto.idproducto', '=', 'det_ingreso.idproducto')
            ->get();
           // $collection = collect($data);
            $unique = $data->unique('lote','fechavencimiento');
            //return array_values($unique);
            //return response()->json($unique);

           
            foreach ($unique as $vencido) {                
               //echo $vencido->fechavencimiento.'<br>';
               $venc = new DateTime($vencido->fechavencimiento);
               $diff = $fecha_resta->diff($venc);
               $vencido->dias = $diff->days;
               //$unique->put('dias', $diff->days);
            // will output 2 days
           // echo $diff->days . ' days <br>';


            }
            
            $unique_r = (array)$unique;
            $convert_array = array_reduce($unique_r, 'array_merge', array());
            //return $convert_array;
            
            return response()->json($convert_array);
            //$flat = call_user_func_array('array_merge', $response_r);
            //return $response_r;

           /* return [
            
                'vencidos' => $unique
            ];

            //$array = (array)$unique;

            
            //print_r($);
            //$json = json_encode($unique);
            //dd($json);
            //json_decode($unique->json(), true);
            //return $json;

/*
            $date2 = new DateTime("2015-02-16");
            $diff = $date1->diff($date2);
            // will output 2 days
            echo $diff->days . ' days ';
            
            $unique->put('dias', 100);

            

/*
            $categorias = Producto::where('idingreso','=','3211')
            ->join('productos', 'vecinos.id', '=', 'pagos.idvecino')->get();           
            
            
        return [
            
            'categorias' => $categorias
        ];*/
    
    }

    
}
