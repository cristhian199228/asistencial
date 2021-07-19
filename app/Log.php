<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Log extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
   
 
    /**
    * The database table used by the model.
    *
    * @var string
    */
   // protected $table = 'det_ingreso';
    protected $table = 'pacientes_log';
   
}
