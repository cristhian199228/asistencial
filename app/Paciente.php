<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Paciente extends Model implements Auditable
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
    protected $table = 'paciente';
    protected $primaryKey = 'idpaciente';

    //Etc...

    public $timestamps = false;

}
