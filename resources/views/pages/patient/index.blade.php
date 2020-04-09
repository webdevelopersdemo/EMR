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
    <a href="{{ route('clinic.create')}}" class="btn btn-primary">Add Clinic</a>
  </div>


  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Clinic</th>
      <th scope="col">place</th>
      <th scope="col">Type</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
    @foreach($clinics as $clinic)
        <tr>
            <td>{{$clinic->clinic_name}}</td>
            <td>{{$clinic->clinic_place}}</td>
            <td>{{$clinic->clinic_tye}}</td>
            <td>{{$clinic->clinic_address}}</td>
            <td><a href="{{ route('clinic.edit', $clinic->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('clinic.destroy', $clinic->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
  </tbody>
</table>

<div>
@endsection