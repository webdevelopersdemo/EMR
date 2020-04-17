@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <div class="addnewcornonacase patient_div">
    <span class="leftanel">
      <a href="{{ route('patient.create')}}" class="btn btn-primary">Add Patient</a>
    </span>
    <span class="rightanel">
      <form action="{{ route('patient.index')}}">
        <!-- Search -->
        <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Search"/>

        <!-- Filter Clinic wise -->
        <select class="form-control" name="clinic_filter" id="clinics">
          <option value=''>Select Clinic</option>
          @foreach ($clinics as $clinic)
            <option value='{{$clinic->id}}' {{$selectclinic == $clinic->id ? 'selected' : ''}}>{{$clinic->clinic_name}}</option>
          @endforeach
        </select>

        <!-- Filter Doctor wise -->
        <select class="form-control" name="doctor_filter"  id="doctors">
          <option value=''>Select Doctor</option>
          @foreach ($doctors as $doctor)
            <option value='{{$doctor->id}}' {{$selectdoctor == $doctor->id ? 'selected' : ''}}>{{$doctor->doctor_name}}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
      </form>
    </span>
  </div>


  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">@sortablelink('image', 'Image')</th>
      <th scope="col">@sortablelink('name', 'Patient')</th>
      <th scope="col">@sortablelink('patient_clinic_id', 'Clinic')</th>
      <th scope="col">@sortablelink('patient_doctor_id', 'Doctor')</th>
      <th scope="col">@sortablelink('email', 'Email')</th>
      <th scope="col">@sortablelink('mobile', 'Mobile')</th>
      <th scope="col">@sortablelink('state', 'State')</th>
      <th scope="col">@sortablelink('occupation', 'Occupation')</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($patients as $patient)
        <tr>
            <td>
              <img src="public/uploads/{{$patient->image}}" width="40" height="40"/>
            </td>
            <td>{{$patient->name}}</td>
            <td>{{$patient->patientClinic->clinic_name}}</td>
            <td>{{$patient->patientDoctor->doctor_name}}</td>
            <td>{{$patient->email}}</td>
            <td>{{$patient->mobile}}</td>
            <td>{{$patient->state}}</td>
            <td>{{$patient->occupation}}</td>
            <td><a href="{{ route('patient.edit', $patient->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('patient.destroy', $patient->id)}}" class="btn btn-danger delete-confirm">Delete</a></td>
        </tr>
        @endforeach
  </tbody>
</table>
{!! $patients->appends(request()->except('page'))->render() !!}
<div>
@endsection