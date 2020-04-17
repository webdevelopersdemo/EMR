<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinic;
use Validator;

class ClinicController extends Controller
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

        if($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if($request->has('perPage')) $perPage = $request->query('perPage');
        if($request->has('search')) $search = $request->query('search');

        $clinics = Clinic::search($search)->sortable()->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('pages.clinic.index', compact('clinics', 'sortBy','orderBy','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clinic.create');
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
            'clinic_name' => 'required|max:50|unique:clinics',
            'clinic_type' => 'required|max:50',
            'clinic_place' => 'required|max:50',
            'clinic_description' => 'required',
            'clinic_address' => 'required'
        ],[
            'clinic_name.required' => 'Please enter your clinic name.',
            'clinic_name.max' => 'Clinic name length can not exceed 50 characters.',
            'clinic_name.unique' => 'Clinic name already exists.',
            'clinic_type.required' => 'Please enter type of clinic type.',
            'clinic_type.max' => 'Clinic type length can not exceed 50 charcaters.',
            'clinic_place.required' => 'Please enter your clinic place.',
            'clinic_place.max' => 'Clinic place length cannot exceed 50 charcters.',
            'clinic_description.required' => 'Please enter your clinic description.',
            'clinic_address.required' => 'Please enter your clinic address.'
        ]);
        if ($validator->fails()) {
            return redirect('/clinic/create')->withErrors($validator)->withInput();
        }
        $show = Clinic::create($data);
        return redirect('/clinic')->with('success', 'Records has been successfully added.');
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
        $clinic = Clinic::findOrFail($id);
        return view('pages.clinic.edit', compact('clinic'));
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
            'clinic_name' => 'required|max:255',
            'clinic_type' => 'required|max:255',
            'clinic_place' => 'required|max:255',
            'clinic_description' => 'required|max:255',
            'clinic_address' => 'required|max:255'
        ],[
            'clinic_name' => 'Please enter your clinic name',
            'clinic_type' => 'Please enter type of clinic',
            'clinic_place' => 'Please enter your clinic place',
            'clinic_description' => 'Please enter your clinic description',
            'clinic_address' => 'Please enter your clinic address'
        ]);
        if ($validator->fails()) {
            return redirect('/clinic/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        $updateData = $request->except(['_token','_method']);
        Clinic::whereId($id)->update($updateData);
        return redirect('/clinic')->with('success', 'Record has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coronacase = Clinic::findOrFail($id);
        $coronacase->delete();
        return redirect('/clinic')->with('success', 'Record has been deleted successfully');
    }
}
