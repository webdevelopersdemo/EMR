<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinic;
use App\Doctor;
use App\Patient;
use Validator;

class PatientController extends Controller
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
        $selectdoctor = '';

        if($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if($request->has('perPage')) $perPage = $request->query('perPage');
        if($request->has('search')) $search = $request->query('search');
        if($request->has('clinic_filter')) $selectclinic = $request->query('clinic_filter');
        if($request->has('doctor_filter')) $selectdoctor = $request->query('doctor_filter');
        $clinics = Clinic::all();
        $doctors = [];
        if($selectclinic != '') {
            $clinc = Clinic::find($selectclinic);
            $doctors = $clinc->doctors;
        }
        $patients = Patient::with('patientClinic','patientDoctor')->search($search,$selectclinic, $selectdoctor,)->orderBy($sortBy, $orderBy)->paginate($perPage);
        return view('pages.patient.index', compact('clinics', 'doctors', 'patients', 'sortBy','orderBy','search','selectdoctor','selectclinic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = Clinic::all();
        return view('pages.patient.create', compact('clinics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exp ="/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i|unique:patients',
            'mobile' => 'required',
            'state' => 'required',
            'country' => 'required',
            'occupation' => 'required',
            'status' => 'required',
            'patient_clinic_id' => 'required',
            'patient_doctor_id' => 'required',
            'image' => 'mimes:gif,jpg,jpeg,bmp,png|max:2048'
        ],[
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email.',
            'email.unique' => 'Email already exits in DB.',
            'email.regex' => 'Please enter valid email format.',
            'mobile.required' => 'Please enter your mobile number.',
            'state.required' => 'Please enter your state.',
            'country.required' => 'Please enter your country.',
            'occupation.required' => 'Please enter your occupation.',
            'status.required' => 'Please select patient status.',
            'patient_clinic_id.required' => 'Please select your clinic.',
            'patient_doctor_id.required' => 'Please select your doctor.',
            'image.mime' => "Images extension are allowed to upload",
            'image.max' => "Max. 2MB files are allowed to upload"
        ]);
        if ($validator->fails()) {
            return redirect('/patient/create')->withErrors($validator)->withInput();
        }
        if($request->file('image')) {
            $fileName = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads'), $fileName);
            $data['image'] = $fileName;
        }
        Patient::create($data);
        return redirect('/patient')->with('success', 'Records has been successfully added.');
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
        $patient = Patient::findOrFail($id);
        $clinics = Clinic::all();
        $clinc = Clinic::find($patient->patient_clinic_id);
        $doctors = $clinc->doctors;
        return view('pages.patient.edit', compact('clinics','patient','doctors'));
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
        $emailDuplicate = Patient::whereEmail($request->all()['email'])->whereNotIn('id',[$id])->first();
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|regex:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i',
            'mobile' => 'required',
            'state' => 'required',
            'country' => 'required',
            'occupation' => 'required',
            'status' => 'required',
            'patient_clinic_id' => 'required',
            'patient_doctor_id' => 'required',
            'image' => 'mimes:gif,jpg,jpeg,bmp,png|max:2048'
        ],[
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter valid email id.',
            'email.regex' => 'Please enter valid email id.',
            'mobile.required' => 'Please enter your mobile number.',
            'state.required' => 'Please enter your state.',
            'country.required' => 'Please enter your country.',
            'occupation.required' => 'Please enter your occupation.',
            'status.required' => 'Please select patient status.',
            'patient_clinic_id.required' => 'Please select your clinic.',
            'patient_doctor_id.required' => 'Please select your doctor.',
            'image.mime' => "Images extension are allowed to upload",
            'image.max' => "Max. 2MB files are allowed to upload"
        ]);
        if(!empty($emailDuplicate)) {
            $validator->errors()->add('email', 'Email already exists.');
        }
        if ($validator->fails()) {
                // foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                //     var_dump($messages); 
                // }
                // die;
                return redirect('/patient/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        $updateData = $request->except(['_token','_method']);
        if($request->file('image')) {
            $fileName = time().'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('uploads'), $fileName);
            $updateData['image'] = $fileName;
        }
        Patient::whereId($id)->update($updateData);
        return redirect('/patient')->with('success', 'Record has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patientcase = Patient::findOrFail($id);
        $patientcase->delete();
        return redirect('/patient')->with('success', 'Record has been deleted successfully');
    }

    /**
     * Get doctors list according to clinic id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDoctors(Request $request)
    {
        $data = $request->all();
        $clinic = Clinic::find($data['clinicID']);
        $doctors = $clinic->doctors()->pluck('id', 'doctor_name')->toArray();
        $html = '';
        if(is_array($doctors) && !empty($doctors)) {
            $html = '<option value="">Select</option>';
            foreach($doctors as $name => $doctorId) {
                $html .= '<option value="'.(int)$doctorId.'">'.$name.'</option>';
            }
        }
        return response()->json(['doctors'=>$html]);
    }
}
