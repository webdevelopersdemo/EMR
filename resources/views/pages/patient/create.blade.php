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
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('clinic.store') }}">
          <div class="form-group">
              @csrf
              <label for="country">Clinic Name:</label>
              <input type="text" class="form-control" name="clinic_name" value="{{ old('clinic_name') }}"/>
          </div>
          <div class="form-group">
              <label for="totalcases">Clinic Type :</label>
              <input type="text" class="form-control" name="clinic_type" value="{{ old('clinic_type') }}"/>
          </div>
          <div class="form-group">
              <label for="totaldeath">Clinic place :</label>
              <input type="text" class="form-control" name="clinic_place" value="{{ old('clinic_place') }}"/>
          </div>
          <div class="form-group">
              <label for="newdeath">Clinic Description :</label>
              <input type="text" class="form-control" name="clinic_description" value="{{ old('clinic_description') }}"/>
          </div>
          <div class="form-group">
              <label for="recovered">clinic Address :</label>
              <input type="text" class="form-control" name="clinic_address" value="{{ old('clinic_address') }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection