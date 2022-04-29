@extends('layouts.master_home')
@section('home_content')
<main id="main">



    <!-- ======= Contact Section ======= -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="map-section">
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d41369.69331315596!2d20.776477799018547!3d46.63952696699817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47442353c0dead77%3A0x938b376b71f1e7b4!2sWenckheim%20Rudolf%20egykori%20kast%C3%A9lya!5e0!3m2!1shu!2shu!4v1617518648534!5m2!1shu!2shu" frameborder="0" allowfullscreen></iframe>
    </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="icofont-google-map"></i>
                  <h4>Telephely:</h4>
                  <p>{{ $contacts->address }}<br></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p>{{ $contacts->email }}<br></p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="icofont-phone"></i>
                  <h4>Mobil:</h4>
                  <p>{{ $contacts->phone }}<br></p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10">
            <form action="{{ route('contact.form') }}" method="post" >
              <!--FORM VALIDATION ON SERVER SIDE-->
               @csrf
                @if (count($errors) > 0)
                <ul>
                @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
                </ul>
                @endif
              <div class="form-row">
                <div class="col-md-6 form-group">
                    <div class="alert alert-success">
                    @if ($errors->has('name'))<strong>{{ $errors->first('name') }}</strong><br>@endif

                  <input type="text" name="name" class="form-control" placeholder="Ön neve"  />
                </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="alert alert-success">
                  @if ($errors->has('email'))<strong>{{ $errors->first('email') }}</strong><br>@endif
                  <input type="email"  class="form-control" name="email"  placeholder="Email címe" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" required="required" name="subject" id="subject" placeholder="Tárgy"  />

              </div>
              <div class="form-group">
                <textarea class="form-control" required="required" name="message" rows="5" placeholder="Üzenet"></textarea>

              </div>
              <button class="btn btn-success" type="submit">Küldés</button>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->



@endsection
