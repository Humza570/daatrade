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
        text-transform: uppercase;
        font-size: 21px;
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
    }

    .pricingTable .subtitle {
        color: #82919f;
        display: block;
        font-size: 15px;
        margin-top: 15px;
        font-weight: 100;
    }

    .pricingTable .pricingContent ul {
        padding: 0;
        list-style: none;
        margin-bottom: 0;
    }

    .pricingTable .pricingContent ul li {
        padding: 20px 0;
    }

    .pricingTable .pricingContent ul li:nth-child(odd) {
        background-color: #fff;
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
                <h1 class="heading-title">Payment Details</h1>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-6">
                    <div class="pricingTable">
                        <div class="pricingTable-header">
                            <span class="heading">
                                @if($type=='basic')
                                Basic Listing
                                @elseif($type=='enhanced')
                                Enhanced
                                @else
                                Premium Showcase
                                @endif
                            </span>
                        </div>
                        <div class="pricing-plans">
                            <span >Price : <i class="fa fa-usd"></i><span>{{$price}}</span></span>
                            <p>Please Select Payment Method and Submit. Our Team Contact With You Soon... </p>
                        </div>
                        <label>
                            <input type="radio" name="paymentMethod" value="easypaisa" id="easypaisaRadio"> EasyPaisa/JazzCash
                        </label>
                        <label>
                            <input type="radio" name="paymentMethod" value="bankTransfer" id="bankTransferRadio"> Bank Transfer
                        </label>
                        <div id="easypaisaDetails" style="display:none;">
                            <h6>Easypaisa</h6>
                            <p>Account Number: 000000000</p>
                            <p>Account Holder Nmae: Daatrade</p>
                            <h6>JazzCash</h6>
                            <p>Account Number: 000000000</p>
                            <p>Account Holder Nmae: Daatrade</p>
                        </div>
                        <div id="bankTransferDetails" style="display:none;">
                            <p>Bank Name: Meezan</p>
                            <p>Account Title: Daatrade</p>
                            <p>Account Number: 0123375</p>
                            <p>IBAN: 923yge6fd</p>
                        </div>
                        <div class="pricingTable-sign-up">
                            <a href="#" class="btn btn-block btn-default">Submit</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    // Add JavaScript code to toggle the display of information boxes based on selected payment method
    document.addEventListener('DOMContentLoaded', function() {
        var easypaisaRadio = document.getElementById('easypaisaRadio');
        var easypaisaDetails = document.getElementById('easypaisaDetails');

        var bankTransferRadio = document.getElementById('bankTransferRadio');
        var bankTransferDetails = document.getElementById('bankTransferDetails');

        easypaisaRadio.addEventListener('change', function() {
            if (easypaisaRadio.checked) {
                easypaisaDetails.style.display = 'block';
                bankTransferDetails.style.display = 'none';
            }
        });

        bankTransferRadio.addEventListener('change', function() {
            if (bankTransferRadio.checked) {
                bankTransferDetails.style.display = 'block';
                easypaisaDetails.style.display = 'none';
            }
        });
    });
</script>
@endsection