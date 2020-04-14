@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Clinic
  </div>
  <div class="card-body">    
      <form method="post" action="{{ route('clinic.store') }}" name="createclinic">
          <div class="form-group">
              @csrf
              <label for="country">Clinic Name:</label>
              <input type="text" class="form-control" name="clinic_name" value="{{ old('clinic_name') }}"/>
              @if($errors->has('clinic_name'))
                  <div class="error">{{ $errors->first('clinic_name') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="totalcases">Clinic Type :</label>
              <input type="text" class="form-control" name="clinic_type" value="{{ old('clinic_type') }}"/>
              @if($errors->has('clinic_type'))
                  <div class="error">{{ $errors->first('clinic_type') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="totaldeath">Clinic place :</label>
              <input type="text" class="form-control" name="clinic_place" value="{{ old('clinic_place') }}"/>
              @if($errors->has('clinic_place'))
                  <div class="error">{{ $errors->first('clinic_place') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="newdeath">Clinic Description :</label>
              <input type="text" class="form-control" name="clinic_description" value="{{ old('clinic_description') }}"/>
              @if($errors->has('clinic_description'))
                  <div class="error">{{ $errors->first('clinic_description') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="recovered">clinic Address :</label>
              <input type="text" class="form-control" name="clinic_address" value="{{ old('clinic_address') }}"/>
              @if($errors->has('clinic_address'))
                  <div class="error">{{ $errors->first('clinic_address') }}</div>
              @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection