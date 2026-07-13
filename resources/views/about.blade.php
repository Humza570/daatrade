@extends('layouts.common')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/about.css') }}" type="text/css">
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}"
        style="background-image: url('{{ asset('assets/img/breadcrumb.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Daatrade</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Empowering B2B Connections</a>
                            {{-- <span>Empowering B2B Connections</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>About Us</h2>
                    </div>
                   <div>
                           <section class="page-section cta">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="cta-inner bg-faded text-center rounded">
                            <p class="mb-0">{!!$about->welcome!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 
            <!-------------About Content Start------------------>
                       
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/f1.png" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Our Mission</h4>
                            </div>
                            <div class="timeline-body"><p class="text-justify">{!!$about->mission!!}</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/f1.png" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Your Ultimate Destination</h4>
                            </div>
                            <div class="timeline-body"><p class="text-justify">{!!$about->destination!!}</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/f1.png" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Our Commitment</h4>
                            </div>
                            <div class="timeline-body"><p class="text-justify">{!!$about->commit!!}
</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Be Part
                                <br />
                                Of Our
                                <br />
                                Story!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
                       
                       
    <!-----------WHY CHOOSE US Start-------->
                       <div class="container">
    <div class="text-center mb-2-8 mb-lg-6">
        <h2 class="display-18 display-md-16 display-lg-14 font-weight-700">Why choose <strong class="text-primary font-weight-700">Daatrade.com</strong></h2>
        <span>The trusted source for why choose us</span>
    </div>
    <div class="row align-items-center">
        <div class="col-sm-6 col-lg-4 mb-2-9 mb-sm-0">
            <div class="pr-md-3">
                <div class="text-center text-sm-right mb-2-9">
                    <div class="mb-4">
                        <img src="assets/img/n1.png" alt="..." class="rounded-circle">
                    </div>
                    <h4 class="sub-info">Global Reach, Local Impact</h4>
                    <p class="display-30 mb-0 text-justify">{!!$about->choose1!!}</p><br><br>
                </div>
                <div class="text-center text-sm-right">
                    <div class="mb-4">
                        <img src="assets/img/n3.png" alt="..." class="rounded-circle">
                    </div>
                    <h4 class="sub-info">Seamless, Fast & Easy Connection</h4>
                    <p class="display-30 mb-0 text-justify">{!!$about->choose3!!}</p><br><br>
                </div>
                <div class="text-center text-sm-right">
                    <div class="mb-4">
                        <img src="assets/img/n5.png" alt="..." class="rounded-circle">
                    </div>
                    <h4 class="sub-info">Free to Use</h4>
                    <p class="display-30 mb-0 text-justify">{!!$about->choose5!!}</p><br><br>
                </div>
                
            </div>
        </div>
        <div class="col-lg-4 d-none d-lg-block">
            <div class="why-choose-center-image">
                <img src="assets/img/wcu.png" alt="..." class="rounded-circle">
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="pl-md-3">
                <div class="text-center text-sm-left mb-2-9">
                    <div class="mb-4">
                        <img src="assets/img/n2.png" alt="..." class="rounded-circle">
                    </div>
                    <h4 class="sub-info">Well-Researched Product Categories</h4>
                    <p class="display-30 mb-0 text-justify">{!!$about->choose2!!}</p><br><br>
                </div>

                <div class="text-center text-sm-left">
                    <div class="mb-4">
                        <img src="assets/img/n4.png" alt="..." class="rounded-circle">
                    </div>
                    <h4 class="sub-info">Verified & Trusted Suppliers</h4>
                    <p class="display-30 mb-0 text-justify">{!!$about->choose4!!}</p><br><br>
                </div>
                
                <div class="text-center text-sm-left">
                    <div class="mb-4">
                        <img src="assets/img/n6.png" alt="..." class="rounded-circle">
                    </div>
                    <h4 class="sub-info">Secure and Transparent Business Communication</h4>
                    <p class="display-30 mb-0 text-justify">{!!$about->choose6!!}</p><br><br>
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br>
                       <!----------Why Choose Us End------------>                   
        <!-- Team-->
        <!---<section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/1.jpg" alt="..." />
                            <h4>Parveen Anand</h4>
                            <p class="text-muted">Lead Designer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/2.jpg" alt="..." />
                            <h4>Diana Petersen</h4>
                            <p class="text-muted">Lead Marketer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/3.jpg" alt="..." />
                            <h4>Larry Parker</h4>
                            <p class="text-muted">Lead Developer</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p></div>
                </div>
            </div>
        </section>
        <!-- Clients-->
        <!---<div class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/microsoft.svg" alt="..." aria-label="Microsoft Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/google.svg" alt="..." aria-label="Google Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/facebook.svg" alt="..." aria-label="Facebook Logo" /></a>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="assets/img/logos/ibm.svg" alt="..." aria-label="IBM Logo" /></a>
                    </div>
                </div>
            </div>
        </div>------>

            <!-------------About Content End--------------------->
    
                       
                       
                       
                       
                    </div>                    
                </div>
            </div>
        </div>
</section>
@endsection
