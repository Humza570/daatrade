@extends('layouts.common')

@section('content')

   <link rel="stylesheet" href="{{ asset('assets/css/privacy.css') }}" type="text/css">

<br><br><br>
        <!-- Image Showcases-->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('assets/img/nsc1.png')"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Our Privacy Policy</h2>
                        <p class="lead mb-0 text-justify">{!! $privacy->welcome !!}</p>
                    </div>
                </div><br><br>
                <div class="row g-0">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('assets/img/nsc2.png')"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>Our Terms of Use</h2>
                        <p class="lead mb-0 text-justify">{!! $privacy->mission !!}</p>
                    </div>
                </div>
                <br><br>
                                <br><br>
            </div>
        </section>


<!-- image showcase end -->


<div class="section-title">
                        <h2>Privacy Policy</h2>
                    </div>
                    
                   
                   <div>
                           <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                        {!! str_replace('<p>', '<p class="mb-0 text-justify">', $privacy->destination) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
                       
                       <br><br><br><br>
                       
                       <!-------------------2nd--------------------->
                       
    <div class="section-title">
                        <h2>Terms to Use</h2>
                    </div>
                    
                   
                   <div>
                           <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                        {!! str_replace('<p>', '<p class="mb-0 text-justify">', $privacy->commit) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

<br><br><br>
 <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

@endsection