<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;

#[Guarded(['id', 'created_at', 'updated_at'])]
class School extends Model
{
    

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Get collection of users */
    public function users()
    {
        return $this->morphMany(User::class, 'useable');
    }

    /* Get the department */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /* Get the Location  manageable*/
    public function location()
    {
        return $this->morphOne(Location::class, 'locatable');
    }

    /* Get collection of managers*/
    public function managers()
    {
        return $this->morphMany(Manager::class, 'manageable');
    }

    /* Get collection of  academicYear */
    public function academicYear()
    {
        return $this->hasMany(AcademicYear::class);
    }



}
