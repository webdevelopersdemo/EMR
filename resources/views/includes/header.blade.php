<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ URL::to('/') }}">HEALTHY INDIA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="{{ URL::to('/') }}">Dashboard</a>
      <a class="nav-item nav-link" href="{{ URL::to('/clinic') }}">Clinic</a>
      <a class="nav-item nav-link" href="{{ URL::to('/doctor') }}">Doctors</a>
      <a class="nav-item nav-link" href="{{ URL::to('/Patient') }}">Patients</a>
    </div>
  </div>
</nav>