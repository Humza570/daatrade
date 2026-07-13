@extends('layouts.common')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/privacy.css') }}" type="text/css">
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('assets/img/breadcrumb.jpg') }}" style="background-image: url('{{ asset('assets/img/breadcrumb.jpg') }}');">
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
                    <h2>How to Post your Buying Inquiry</h2>
                </div>
            </div>
        </div>
    </div>
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner bg-faded text-center rounded">
                    <p class="mb-0">{!!$data->welcome!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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