<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['transferreds_id'])]
class Departure extends Model
{
    /**
     * Override the Primary key.
    */
    protected $primaryKey = 'transferred_id';
    
    /**
     * Avoid timestamps and incrementing attributes.
    */
    public 
    $timestamps= false,
    $incrementing = false;

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the transferred */
    public function transferred()
    {
        return $this->belongsTo(Transferred::class, 'transferred_id', 'statistic_id');
    }
}
