@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add clinc
  </div>
  <div class="card-body">
     <form method="post" action="{{ route('doctor.update', $doctor->id ) }}" name="updatedoctor" id="updatedoctor">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country">Select Clinic:</label>
              <select class="form-control" name="doctor_clinic_id">
                <option value=''>Select</option>
                @foreach ($clinics as $clinic)
                  <option value='{{$clinic->id}}' {{$doctor->doctor_clinic_id == $clinic->id  ? 'selected' : ''}}>{{$clinic->clinic_name}}</option>
                @endforeach
              </select>
              @if($errors->has('doctor_clinic_id'))
                  <div class="error">{{ $errors->first('doctor_clinic_id') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="totalcases">Name :</label>
              <input type="text" class="form-control" name="doctor_name" value="{{ $doctor->doctor_name }}"/>
              @if($errors->has('doctor_name'))
                  <div class="error">{{ $errors->first('doctor_name') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="doctor_phone">mobile number :</label>
              <input type="text" class="form-control" name="doctor_phone" value="{{ $doctor->doctor_phone }}"/>
              @if($errors->has('doctor_phone'))
                  <div class="error">{{ $errors->first('doctor_phone') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="doctor_fees">Fees :</label>
              <input type="text" class="form-control" name="doctor_fees" value="{{ $doctor->doctor_fees }}"/>
              @if($errors->has('doctor_fees'))
                  <div class="error">{{ $errors->first('doctor_fees') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="doctor_speciality">speciality :</label>
              <input type="text" class="form-control" name="doctor_speciality" value="{{ $doctor->doctor_speciality }}"/>
              @if($errors->has('doctor_speciality'))
                  <div class="error">{{ $errors->first('doctor_speciality') }}</div>
              @endif
          </div>

          <div class="form-group">
              <label for="doctor_address">Address :</label>
              <input type="text" class="form-control" name="doctor_address" value="{{ $doctor->doctor_address }}"/>
              @if($errors->has('doctor_address'))
                  <div class="error">{{ $errors->first('doctor_address') }}</div>
              @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection