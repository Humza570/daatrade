@extends('layouts.admin')

@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: "Nunito", sans-serif;
        }

        :root {
            --green: #58a497;
            --yellow: #e09449;
            --lightgreen1: #a4bdb7;
            --brown: #8b4448;
            --gray: gray;
            --lightgreen2: rgb(164, 189, 183, 0.5);
            --box: #fff;
        }



        /* Content-1:Start */
        .box {
            width: auto;
            height: fit-content;
            text-align: center;
            background: #fff;
            padding: 0;
        }

        .box1 {
            margin-top: 10px;
        }

        .content {
            margin: 0px;
        }

        .image img {
            height: auto;
            width: 100%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 5px;
        }

        .level {
            width: auto;
            padding: 3px;
            font-size: 1.25em;
            font-weight: bolder;
            letter-spacing: 1px;
            display: block;
            margin: 0px auto 10px;
        }
        .postbutton button {
            width: 130px;
            height: 40px;
            border-radius: 10px;
            font-weight: bolder;
        }

        .postbutton {
            display: flex;
            justify-content: space-around;
            flex-direction: row;
            margin: 20px 30px 0px;
        }

        .postbutton .message {
            background: #fff;
            border: 2px solid #000;
        }

        .postbutton .connect {
            background-color: #000;
            color: #fff;
            border: none;
        }

        button.connect:hover {
            letter-spacing: 1px;
            transition: 0.5s;
        }

        button.message:hover {
            letter-spacing: 1px;
            transition: 0.5s;
            background: rgba(88, 164, 151, 0.5);
        }
    </style>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">All Posts</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @livewire('all-posts')
@endsection
