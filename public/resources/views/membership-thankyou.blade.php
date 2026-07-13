@extends('layouts.common')
@section('content')

<link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>
<style>
    @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);

    body {
        font-family: 'Lato', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .site-header {
        text-align: center;
        padding: 50px 0;
        color: #fff;
    }

    .site-header__title {
        font-size: 3rem;
        margin: 0;
    }

    .main-content {
        text-align: center;
        margin-top: 20px;
    }

    .main-content__checkmark {
        color: #27ae60;
        font-size: 3rem;
    }

    .main-content__body {
        font-size: 1.2rem;
        color: #333;
        margin: 20px 0;
    }

    .bank-details {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px 0;
    }

    .bank-details strong {
        color: #333;
    }

    .contact-info {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .site-header__title {
            font-size: 2.5rem;
        }

        .main-content__body {
            font-size: 1rem;
        }
    }
</style>

<header class="site-header" id="header">
    <h1 class="site-header__title" data-lead-id="site-header-title">Please Deposit</h1>
</header>

<div class="container">
    <div class="main-content">
        <p class="main-content__body" data-lead-id="main-content-body">
            To unlock exclusive benefits, consider purchasing the {{$plan}} membership plan for $ {{$price}}. Deposit your membership fee in our designated bank account listed here.
        </p>
        <div class="bank-details">
            <p><strong>Bank Account Details</strong></p>
            <p><strong>Bank Name:</strong> United Bank Limited</p>
            <p><strong>Account Title:</strong> Saremco Tech (Pvt.) Ltd.</p>
            <p><strong>Branch code:</strong> 1346</p>
            <p><strong>IBAN:</strong> PK87 UNIL 0109 0002 2873 2983</p>
        </div>
        <p class="contact-info">
           After deposit share deposit slip via email to <a href="mailto:info@daatrade.com">info@daatrade.com</a> or WhatsApp at: +923411115888, +92341111599.
        </p>
    </div>
</div>

@endsection