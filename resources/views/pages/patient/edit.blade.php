@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Corona Virus Data
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
      <form method="post" action="{{ route('coronas.update', $coronacase->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country">Country Name:</label>
              <input type="text" class="form-control" name="country" value="{{ $coronacase->country }}"/>
          </div>
          <div class="form-group">
              <label for="totalcases">Total Cases :</label>
              <input type="text" class="form-control" name="totalcases" value="{{ $coronacase->totalcases }}"/>
          </div>
          <div class="form-group">
              <label for="totaldeath">Total Death :</label>
              <input type="text" class="form-control" name="totaldeath" value="{{ $coronacase->totaldeath }}"/>
          </div>
          <div class="form-group">
              <label for="newdeath">New Deaths :</label>
              <input type="text" class="form-control" name="newdeath" value="{{ $coronacase->newdeath }}"/>
          </div>
          <div class="form-group">
              <label for="recovered">Recovered Cases :</label>
              <input type="text" class="form-control" name="recovered" value="{{ $coronacase->recovered }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection