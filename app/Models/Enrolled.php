<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['statistic_id'])]
class Enrolled extends Model
{

    /**
     * Override the Primary key.
    */
    protected $primaryKey = 'statistic_id';
    
    /**
     * Avoid timestamps and incrementing attributes.
    */
    public 
    $timestamps= false,
    $incrementing = false;

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the statistic */
    public function statistic()
    {
        return $this->belongsTo(Statistic::class);
    }
}
