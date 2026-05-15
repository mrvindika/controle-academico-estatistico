<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id', 'created_at', 'updated_at'])]
class AcademicPeriod extends Model
{
    
    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the academicYear */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /* Get collection of statistics */
    public function statistics()
    {
        return $this->hasMany(Statistic::class);
    }

    /* Get the FilledRoom */
    public function filledRoom()
    {
        return $this->hasOne(FilledRoom::class);
    }

}
