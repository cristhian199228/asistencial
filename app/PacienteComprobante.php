<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class PacienteComprobante extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    //
     /**
     * The database connection used by the model.
     *
     * @var string
     */
    protected $connection = 'asis';
 
    /**
    * The database table used by the model.
    *
    * @var string
    */
   // protected $table = 'det_ingreso';
    protected $table = 'paciente_comprobante';
    protected $primaryKey = 'idpaciente_comprobante';

    //Etc...

    public $timestamps = false;

}
