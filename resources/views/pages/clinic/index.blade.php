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

  <div class="addnewcornonacase addpanel">
    <span class="leftanel">
      <a href="{{ route('clinic.create')}}" class="btn btn-primary">Add Clinic</a>
    </span>
    <span class="rightanel">
      <form action="{{ route('clinic.index')}}">
        <!-- Search -->
        <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Search"/>
        <button type="submit" class="btn btn-primary">Filter</button>
      </form>
    </span>
  </div>

  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Clinic</th>
      <th scope="col">place</th>
      <th scope="col">Type</th>
      <th scope="col">Address</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($clinics as $clinic)
        <tr>
            <td>{{$clinic->clinic_name}}</td>
            <td>{{$clinic->clinic_place}}</td>
            <td>{{$clinic->clinic_type}}</td>
            <td>{{$clinic->clinic_address}}</td>
            <td><a href="{{ route('clinic.edit', $clinic->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="{{ route('clinic.destroy', $clinic->id)}}" class="btn btn-danger delete-confirm">Delete</a></td>
        </tr>
        @endforeach
  </tbody>
</table>
{{ $clinics->links() }}
<div>
@endsection