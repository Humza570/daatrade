@extends('layouts.common')

@section('content')


<style>
    .row {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .col-md-4 {
        flex: 0 0 calc(33.333% - 30px);
        /* Adjust the width of each column */
        max-width: calc(33.333% - 30px);
    }

    @media (max-width: 992px) {
        .col-md-4 {
            flex: 0 0 calc(50% - 30px);
            /* Adjust the width for smaller screens */
            max-width: calc(50% - 30px);
        }
    }

    @media (max-width: 576px) {
        .col-md-4 {
            flex: 0 0 100%;
            /* Full width for screens smaller than 576px */
            max-width: 100%;
        }
    }

    .demo {
        padding: 50px 0;
    }

    .heading-title {
        margin-bottom: 50px;
    }

    .pricingTable {
        border: 1px solid #dbdbdb;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.14);
        margin: 0 -15px;
        text-align: center;
        transition: all 0.4s ease-in-out 0s;
    }

    .pricingTable:hover {
        border: 2px solid #7fad39;
        margin-top: -30px;
    }

    .pricingTable .pricingTable-header {
        padding: 30px 10px;
    }

    .pricingTable .heading {
        display: block;
        color: #000;
        font-weight: 900;
        font-size: 25px;
        text-decoration: underline gray;
        /* You can adjust the color as needed */
        font-family: 'Your Preferred Font', sans-serif;
        /* Replace 'Your Preferred Font' with the actual font you want to use */
    }


    .pricingTable .pricing-plans {
        padding-bottom: 25px;
        border-bottom: 1px solid #d0d0d0;
        color: #000;
        font-weight: 900;
    }

    .pricingTable .price-value {
        color: #474747;
        display: block;
        font-size: 25px;
        font-weight: 800;
        line-height: 35px;
        padding: 0 10px;
    }

    .pricingTable .price-value span {
        font-size: 50px;
        color: #7fad39;
    }

    .pricingTable .subtitle {
        color: gray;
        display: block;
        font-size: 20px;
        margin-top: 15px;
        font-weight: 100;
    }

    .pricingTable .pricingContent ul {
        padding: 0;
        list-style: none;
        margin-bottom: 0;
    }

    .pricingTable .pricingContent ul li {
        padding: 10px 0;
    }


    .pricingTable .pricingContent ul li:last-child {
        border-bottom: 1px solid #dbdbdb;
    }

    .pricingTable .pricingTable-sign-up {
        padding: 25px 0;
    }

    .pricingTable .btn-block {
        width: 50%;
        margin: 0 auto;
        background: #7fad39;
        border: 1px solid transparent;
        padding: 10px 5px;
        color: #fff;
        text-transform: capitalize;
        border-radius: 5px;
        transition: 0.3s ease;
    }

    .pricingTable .btn-block:after {
        content: "\f090";
        font-family: 'FontAwesome';
        padding-left: 10px;
        font-size: 15px;
    }

    .pricingTable:hover .btn-block {
        background: #fff;
        color: #7fad39;
        border: 1px solid #7fad39;
    }
</style>
<div class="container">
    <div class="demo">
        <div class="container">
            <div class="row text-center">
                <h1 class="heading-title">Grow your Business with us!</h1>
            </div>
            <div class="row text-center">
                <h3 class="heading-title">We have exciting plans to offer for each type of Exporter. Have a look on it.</h3>
            </div>
            <form id="membershipForm" method="post" action="{{ route('membershipplantype') }}">
                @csrf
                <input type="hidden" name="type" id="membershipTypeInput">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="pricingTable">
                            <div class="pricingTable-header">
                                <span class="heading">
                                    Basic Listing
                                </span>
                                Up to 10 product listings.
                            </div>
                            <div class="pricing-plans">
                                <span class="price-value"><i style="color: #7fad39;" class="fa fa-usd"></i><span>299/year</span></span>
                                <span class="subtitle">Verified</span>
                            </div>
                            <div class="pricingContent">
                                <ul>
                                    <ul>
                                        <li>&#10004; Product listing on Daatrade platform.</li>
                                        <li>&#10004; Up to 10 product listings.</li>
                                        <li>&#10004; Standard exposure in relevant categories.</li>
                                        <li>&#10004; Starting from $299 per annum.</li>
                                    </ul>

                                </ul>
                            </div><!-- /  CONTENT BOX-->

                            <div class="pricingTable-sign-up"><!-- BUTTON BOX-->
                                <a  onclick="submitForm('basic')" class="btn btn-block btn-default">Buy Membership</a>
                            </div><!-- BUTTON BOX-->
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="pricingTable">
                            <div class="pricingTable-header">
                                <span class="heading">
                                    Enhanced Visibility
                                </span>
                                Up to 20 product listings.
                            </div>
                            <div class="pricing-plans">
                                <span class="price-value"><i style="color: #7fad39;" class="fa fa-usd"></i><span>599/year</span></span>
                                <span class="subtitle">Verified & Trusted</span>
                            </div>
                            <div class="pricingContent">
                                <ul>
                                    <ul>
                                        <li>&#10004; Product listing on Daatrade platform.</li>
                                        <li>&#10004; Up to 20 product listings.</li>
                                        <li>&#10004; Featured placement in selected categories.</li>
                                        <li>&#10004; Monthly promotion on Daatrade's social media channels (YouTube, Instagram, Facebook & LinkedIn) - 4 posts/month.</li>
                                        <li>&#10004; Starting from $599 per annum.</li>
                                    </ul>

                                </ul>
                            </div><!-- /  CONTENT BOX-->

                            <div class="pricingTable-sign-up"><!-- BUTTON BOX-->
                                <a  onclick="submitForm('enhanced')" class="btn btn-block btn-default">Buy Membership</a>
                            </div><!-- BUTTON BOX-->
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="pricingTable">
                            <div class="pricingTable-header">
                                <span class="heading">
                                    Premium Showcase
                                </span>
                                Up to 45 product listings.
                            </div>
                            <div class="pricing-plans">
                                <span class="price-value"><i style="color: #7fad39;" class="fa fa-usd"></i><span>999/year</span></span>
                                <span class="subtitle">Verified, Trusted & Premium</span>
                            </div>
                            <div class="pricingContent">
                                <ul>
                                    <ul>
                                        <li>&#10004; Product listing on Daatrade platform.</li>
                                        <li>&#10004; Up to 45 product listings.</li>
                                        <li>&#10004; Priority placement in all relevant categories.</li>
                                        <li>&#10004; Featured homepage display.</li>
                                        <li>&#10004; Weekly promotion on Daatrade's social media channels (10 posts/month).</li>
                                        <li>&#10004; Dedicated email newsletter feature to Daatrade subscribers.</li>
                                        <li>&#10004; Access to advanced analytics and insights.</li>
                                        <li>&#10004; Starting from $999 per annum.</li>
                                    </ul>

                                </ul>
                            </div>

                            <div class="pricingTable-sign-up"><!-- BUTTON BOX-->
                                <a  onclick="submitForm('premium')" class="btn btn-block btn-default">Buy Membership</a>
                            </div><!-- BUTTON BOX-->
                        </div>
                    </div>
                </div>
            </form>
            <script>
                function submitForm(type) {
                    document.getElementById('membershipTypeInput').value = type;
                    document.getElementById('membershipForm').submit();
                }
            </script>
        </div>
    </div>
</div>

@endsection