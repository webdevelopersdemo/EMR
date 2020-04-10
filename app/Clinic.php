<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    public $table = 'clinics';
    protected $fillable = array('clinic_name','clinic_type','clinic_place','clinic_description','clinic_address');

    /**
     * Get the doctors belong to clinic.
     */
    public function doctors()
    {
        return $this->hasMany('App\Doctor');
    }

    /**
     * Get the patients belong to clinic.
     */
    public function clinicPatient()
    {
        return $this->hasMany('App\Patient');
    }


    /**
	 * clinic scope search filter.
	 */
	public function scopeSearch($query, $search)
    {
    	if($search == null) return $query;

    	return $query->where(function($query) use($search) {
		        $query->where('clinic_name', 'LIKE', '%'.$search.'%')
		            ->orWhere('clinic_type', 'LIKE', '%'.$search.'%');
		    }); 
    }
}
