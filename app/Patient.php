<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Patient extends Model
{
	use Sortable;
    public $table = 'patients';
    public $sortable = ['name','email','mobile','state','country','address','occupation'];
    protected $fillable = array('patient_clinic_id','patient_doctor_id','name','email','mobile','state','country','address','status','occupation','image');

    /**
	 * Patient belongs to clinic
	 */
	public function patientClinic()
	{
	    return $this->belongsTo('App\Clinic', 'patient_clinic_id');
	}

    /**
	 * patient belongs to one doctor.
	 */
	public function patientDoctor()
	{
	    return $this->belongsTo('App\Doctor', 'patient_doctor_id');
	}

	/**
	 * doctor scope search filter.
	 */
	public function scopeSearch($query, $search, $clinic, $doctor)
    {
    	if($search == null && $clinic == null && $doctor == null) return $query;

    	if($search != null && $clinic == null && $doctor == null) {
	    	return $query->where(function($query) use($search) {
		        $query->where('name', 'LIKE', '%'.$search.'%')
		            ->orWhere('email', 'LIKE', '%'.$search.'%')
	    			->orWhere('mobile', 'LIKE', '%'.$search.'%')
	    			->orWhere('state', 'LIKE', '%'.$search.'%')
	    			->orWhere('country', 'LIKE', '%'.$search.'%');
		    });        			
    	} else if($search == null && $clinic != null && $doctor == null) {
    		return $query->where(function($query) use($clinic) {
		        $query->where('patient_clinic_id', $clinic);
		    });
    	} else if($search == null && $clinic == null && $doctor != null) {
    		return $query->where(function($query) use($doctor) {
		        $query->where('patient_doctor_id', $doctor);
		    });
    	} else {
    		return $query->where(function($query) use($search) {
		        $query->where('name', 'LIKE', '%'.$search.'%')
		            ->orWhere('email', 'LIKE', '%'.$search.'%')
	    			->orWhere('mobile', 'LIKE', '%'.$search.'%')
	    			->orWhere('state', 'LIKE', '%'.$search.'%')
	    			->orWhere('country', 'LIKE', '%'.$search.'%');
		    })->where(function($query) use($clinic) {
		        $query->where('patient_clinic_id', $clinic);
		    })->where(function($query) use($doctor) {
		        $query->where('patient_doctor_id', $doctor);
		    });
    	}
    }



    // Mutators for patient table
    // -----------------------------


    /**
     * Set the patient doctor id as integer .
     *
     * @param  string  $value
     * @return integer
     */
    public function setPatientDoctorIdAttribute($value)
    {
        $this->attributes['patient_doctor_id'] = (int)$value;
    }



}
