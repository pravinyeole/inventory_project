<section class="section dashboard">
  <div class="row">

    
    <div class="col-lg-12">
      <div class="row">

        
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Total Store Users</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <a href="{{url('/clinic_details')}}"><h6>{{count($data)}}</h6></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Total Clinic Users</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <a href="{{url('/all_clinc_users')}}"><h6>{{count($all_users)}}</h6></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Total Clinic Location</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-map"></i>
                </div>
                <div class="ps-3">
                  <a href="{{url('/clinic')}}"><h6>{{count($location)}}</h6></a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  setTimeout(function(){
    location = 'http://manage.neevwellbeing.in/home'
  },60000)
</script>