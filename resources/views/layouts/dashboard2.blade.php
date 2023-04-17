<section class="section dashboard">
  <div class="row">

    <div class="col-lg-12">
      <div class="row">

        
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Clinic Users Branch</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>{{$location['branch_name']}}</h6>  <span>{{$location['location']}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Number Of Products Ordered</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-basket"></i>
                </div>
                <div class="ps-3">
                    <a href="{{url('/view_my_orders')}}"><h6>{{count($my_orders)}}</h6></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">

            <div class="card-body">
              <h5 class="card-title">Number Of Received Products</h5>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-map"></i>
                </div>
                <div class="ps-3">
                  <a href="{{url('/product_receive')}}"><h6>{{count($recive_product)}}</h6></a>
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
