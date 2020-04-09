<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public $table = 'doctors';
    protected $fillable = array('doctor_clinic_id','doctor_name','doctor_speciality','doctor_address','doctor_phone','doctor_fees');

    /**
	 * doctor belongs to one clinic.
	 */
	public function clinic()
	{
	    return $this->belongsTo('App\Clinic', 'doctor_clinic_id');
	}

	/**
	 * doctor scope search filter.
	 */
	public function scopeSearch($query, $search,$clinic)
    {
    	if($search == null && $clinic == null) return $query;

    	if($search != null && $clinic == null) {
	    	return $query->where(function($query) use($search) {
		        $query->where('doctor_name', 'LIKE', '%'.$search.'%')
		            ->orWhere('doctor_speciality', 'LIKE', '%'.$search.'%')
	    			->orWhere('doctor_fees', 'LIKE', '%'.$search.'%')
	    			->orWhere('doctor_phone', 'LIKE', '%'.$search.'%');
		    });        			
    	} else if($search == null && $clinic != null) {
    		return $query->where(function($query) use($clinic) {
		        $query->where('doctor_clinic_id', $clinic);
		    });
    	} else {
    		return $query->where(function($query) use($search) {
		        $query->where('doctor_name', 'LIKE', '%'.$search.'%')
		            ->orWhere('doctor_speciality', 'LIKE', '%'.$search.'%')
	    			->orWhere('doctor_fees', 'LIKE', '%'.$search.'%')
	    			->orWhere('doctor_phone', 'LIKE', '%'.$search.'%');
		    })->where(function($query) use($clinic) {
		        $query->where('doctor_clinic_id', $clinic);
		    });
    	}
    }
}
