<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id'])]
class Statistic extends Model
{
    /**
     * Avoid timestamps attributes.
    */
    public $timestamps= false;
    
    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get the AcademicPeriod */
    public function academicPeriod()
    {
        return $this->belongsTo(AcademicPeriod::class);
    }

    /* Get the Succeed */
    public function succeed()
    {
        return $this->hasOne(Succeed::class);
    }

    /* Get the failed */
    public function failed()
    {
        return $this->hasOne(Failed::class);
    }

    /* Get the dead */
    public function dead()
    {
        return $this->hasOne(Dead::class);
    }

    /* Get the desisted */
    public function desisted()
    {
        return $this->hasOne(Desisted::class);
    }

    /* Get the enrolled */
    public function enrolled()
    {
        return $this->hasOne(Enrolled::class);
    }

    /* Get the teacher */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    /* Get the tested */
    public function tested()
    {
        return $this->hasOne(Tested::class);
    }

        /* Get the transferred */
    public function transferred()
    {
        return $this->hasOne(Transferred::class);
    }

}
