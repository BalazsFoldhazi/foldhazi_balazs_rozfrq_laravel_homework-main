
    @extends('layouts.master_home')
    @include('layouts.body.slider')
    @section('home_content')
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Rólunk</strong></h2>
          </div>

          <div class="row content">
            <div class="col-lg-6" data-aos="fade-right">
              <h2>{{ $abouts->title }}</h2>
              <h3>{{ $abouts->short_dis }}</h3>

            </div>
            <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
              <p>
              <h5>{{ $abouts->long_dis }}</h5>
              </p>

            </div>
          </div>

        </div>
      </section><!-- End About Us Section -->



    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Partnereink</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          @foreach($brands as $brand)
          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <img src="{{ $brand->brand_image }}" class="img-fluid" alt="">
            </div>
          </div>
          @endforeach



        </div>

      </div>
    </section><!-- End Our Clients Section -->
@endsection
