<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor as Doctor;
use App\Clinic as Clinic;
use Validator;

class DoctorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortBy  = 'id';
        $orderBy = 'desc';
        $perPage = 5;
        $search = '';
        $selectclinic = '';

        if($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if($request->has('perPage')) $perPage = $request->query('perPage');
        if($request->has('search')) $search = $request->query('search');
        if($request->has('clinic_filter')) $selectclinic = $request->query('clinic_filter');

        $clinics = Clinic::all();
        $doctors = Doctor::with('clinic')->sortable()->search($search,$selectclinic)->orderBy($sortBy, $orderBy)->paginate($perPage);        
        return view('pages.doctor.index', compact('doctors','clinics', 'sortBy','orderBy','search','selectclinic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = Clinic::all();
        return view('pages.doctor.create', compact('clinics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'doctor_clinic_id' => 'required|numeric',
            'doctor_name' => 'required|max:255',
            'doctor_speciality' => 'required|max:255',
            'doctor_fees' => 'required|max:255',
            'doctor_address' => 'required|max:255',
            'doctor_phone' => 'required|numeric'
        ],[
            'doctor_clinic_id' => 'Please select clinic name',
            'doctor_name' => 'Please enter doctor name',
            'doctor_speciality' => 'Please enter doctor speciality',
            'doctor_fees' => 'Please enter your clinic description',
            'doctor_address' => 'Please enter doctor address',
            'doctor_phone' => 'Please enter doctor mobile number'
        ]);
        if ($validator->fails()) {
            return redirect('/doctor/create')->withErrors($validator)->withInput();
        }
        $show = Doctor::create($data);
        return redirect('/doctor')->with('success', 'Records has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $clinics = Clinic::all();
        return view('pages.doctor.edit', compact('doctor','clinics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'doctor_clinic_id' => 'required|numeric',
            'doctor_name' => 'required|max:255',
            'doctor_speciality' => 'required|max:255',
            'doctor_fees' => 'required|max:255',
            'doctor_address' => 'required|max:255',
            'doctor_phone' => 'required|numeric'
        ],[
            'doctor_clinic_id' => 'Please select clinic name',
            'doctor_name' => 'Please enter doctor name',
            'doctor_speciality' => 'Please enter doctor speciality',
            'doctor_fees' => 'Please enter your clinic description',
            'doctor_address' => 'Please enter doctor address',
            'doctor_phone' => 'Please enter doctor mobile number'
        ]);
        if ($validator->fails()) {
            return redirect('/doctor/'.$id.'/create')->withErrors($validator)->withInput();
        }
        $updateData = $request->except(['_token','_method']);
        Doctor::whereId($id)->update($updateData);
        return redirect('/doctor')->with('success', 'Record has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return redirect('/doctor')->with('success', 'Record has been deleted successfully');
    }
}
