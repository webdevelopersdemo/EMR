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

  <div class="addnewcornonacase">
    <span class="leftanel">
      <a href="{{ route('doctor.create')}}" class="btn btn-primary">Add Doctor</a>
    </span>
    <span class="rightanel">
      <form action="{{ route('doctor.index')}}">
        <!-- Search -->
        <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Search"/>

        <!-- Filter Clinic wise -->
        <select class="form-control" name="clinic_filter">
          <option value=''>Select Clinic</option>
          @foreach ($clinics as $clinic)
            <option value='{{$clinic->id}}' {{$selectclinic == $clinic->id  ? 'selected' : ''}}>{{$clinic->clinic_name}}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
      </form>
    </span>
  </div>


  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">@sortablelink('doctor_name', 'Doctor')</th>
      <th scope="col">@sortablelink('doctor_clinic_id', 'Clinic')</th>
      <th scope="col">@sortablelink('doctor_speciality', 'Speciality')</th>
      <th scope="col">@sortablelink('doctor_address', 'Address')</th>
      <th scope="col">@sortablelink('doctor_phone', 'Mobile')</th>
      <th scope="col">@sortablelink('doctor_fees', 'Fees')</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($doctors as $doctor)
      <tr>
          <td>{{$doctor->doctor_name}}</td>
          <td>{{$doctor->clinic->clinic_name}}</td>
          <td>{{$doctor->doctor_speciality}}</td>
          <td>{{$doctor->doctor_address}}</td>
          <td>{{$doctor->doctor_phone}}</td>
          <td>{{$doctor->doctor_fees}}</td>
          <td><a href="{{ route('doctor.edit', $doctor->id)}}" class="btn btn-primary">Edit</a></td>
          <td><a href="{{ route('doctor.destroy', $doctor->id)}}" class="btn btn-danger delete-confirm">Delete</a></td>
      </tr>
      @endforeach
  </tbody>
</table>
{!! $doctors->appends(request()->except('page'))->render() !!}
<div>
@endsection