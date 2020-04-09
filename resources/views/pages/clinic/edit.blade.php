@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Clinic
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('clinic.update', $clinic->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country">Clinic Name:</label>
              <input type="text" class="form-control" name="clinic_name" value="{{ $clinic->clinic_name }}"/>
              @if($errors->has('clinic_name'))
                  <div class="error">{{ $errors->first('clinic_name') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="totalcases">Clinic Type :</label>
              <input type="text" class="form-control" name="clinic_type" value="{{ $clinic->clinic_type }}"/>
              @if($errors->has('clinic_type'))
                  <div class="error">{{ $errors->first('clinic_type') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="totaldeath">Clinic Place :</label>
              <input type="text" class="form-control" name="clinic_place" value="{{ $clinic->clinic_place }}"/>
              @if($errors->has('clinic_place'))
                  <div class="error">{{ $errors->first('clinic_place') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="newdeath">Clinic Description :</label>
              <input type="text" class="form-control" name="clinic_description" value="{{ $clinic->clinic_description }}"/>
              @if($errors->has('clinic_description'))
                  <div class="error">{{ $errors->first('clinic_description') }}</div>
              @endif
          </div>
          <div class="form-group">
              <label for="recovered">Clinic Address  :</label>
              <input type="text" class="form-control" name="clinic_address" value="{{ $clinic->clinic_address }}"/>
              @if($errors->has('clinic_address'))
                  <div class="error">{{ $errors->first('clinic_address') }}</div>
              @endif
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection