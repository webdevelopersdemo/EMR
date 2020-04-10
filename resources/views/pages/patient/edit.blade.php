@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Patient
  </div>

  <div class="card-body">
    <form method="post" action="{{ route('patient.update', $patient->id ) }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="patient_clinic_id">Select Clinic:</label>
              <select class="form-control" name="patient_clinic_id">
                <option value=''>Select</option>
                @foreach ($clinics as $clinic)
                  <option value='{{$clinic->id}}' {{$patient->patient_clinic_id == $clinic->id  ? 'selected' : ''}}>{{$clinic->clinic_name}}</option>
                @endforeach
              </select>
              @if($errors->has('patient_clinic_id'))
                  <div class="error">{{ $errors->first('patient_clinic_id') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="patient_doctor_id">Select Doctor:</label>
              <select class="form-control" name="patient_doctor_id">
                <option value=''>Select</option>
                @foreach ($clinics as $clinic)
                  <option value='{{$clinic->id}}' {{$patient->patient_clinic_id == $clinic->id  ? 'selected' : ''}}>{{$clinic->clinic_name}}</option>
                @endforeach
              </select>
              @if($errors->has('patient_doctor_id'))
                  <div class="error">{{ $errors->first('patient_doctor_id') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="name">Name :</label>
              <input type="text" class="form-control" name="name" value="{{ $patient->name }}"/>
              @if($errors->has('name'))
                  <div class="error">{{ $errors->first('name') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="email">Email :</label>
              <input type="email" class="form-control" name="email" value="{{ $patient->email }}"/>
              @if($errors->has('email'))
                  <div class="error">{{ $errors->first('email') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="mobile">Mobile :</label>
              <input type="text" class="form-control" name="mobile" value="{{ $patient->mobile }}"/>
              @if($errors->has('mobile'))
                  <div class="error">{{ $errors->first('mobile') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="state">State :</label>
              <input type="text" class="form-control" name="state" value="{{ $patient->state }}"/>
              @if($errors->has('state'))
                  <div class="error">{{ $errors->first('state') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="country">Country :</label>
              <input type="text" class="form-control" name="country" value="{{ $patient->country }}"/>
              @if($errors->has('country'))
                  <div class="error">{{ $errors->first('country') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="address">Address :</label>
              <input type="text" class="form-control" name="address" value="{{ $patient->address }}"/>
              @if($errors->has('address'))
                  <div class="error">{{ $errors->first('address') }}</div>
              @endif
          </div>

          <div class="form-group">
              <label for="occupation">Occupation :</label>
              <input type="text" class="form-control" name="occupation" value="{{ $patient->occupation }}"/>
              @if($errors->has('occupation'))
                  <div class="error">{{ $errors->first('occupation') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="status">Status:</label>
              <select class="form-control" name="status">
                <option value=''>Select</option>
                <option value='1' {{$patient->status == 1  ? 'selected' : ''}}>True</option>
                <option value='0' {{$patient->status == 0  ? 'selected' : ''}}>False</option>
              </select>
              @if($errors->has('status'))
                  <div class="error">{{ $errors->first('status') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="occupation">Image Upload :</label>
              <input type="file" class="form-control" name="image"/>
              @if($errors->has('image'))
                  <div class="error">{{ $errors->first('image') }}</div>
              @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection

<script type="text/javascript">
  $(document).ready(function ()
  {
    $('select[name="patient_clinic_id"]').on('change',function(){
       var patientClinicId = $(this).val();
       if(patientClinicId)
       {
          $.ajax({
             url : 'doctors/' + patientClinicId,
             type : "GET",
             dataType : "json",
             success:function(data)
             {
                console.log(data);
                $('select[name="patient_doctor_id"]').empty();
                $.each(data, function(key,value){
                   $('select[name="patient_doctor_id"]').append('<option value="'+ value.id +'">'+ value.doctor_name +'</option>');
                });
             }
          });
       }
       else
       {
          $('select[name="patient_doctor_id"]').empty();
       }
    });
  });
</script>