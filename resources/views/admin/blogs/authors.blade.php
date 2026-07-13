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
  border-radius: 20px;
  padding: 10px;
  text-align: center;
  background: #fff;
}

.box1 {
  margin-top: 10px;
}

.content {
  margin: 15px 2px;
}

.image img {
  height: auto;
  width: 120px;
  border-radius: 50%;

  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 5px;
}

.level {
  font-size: 0.7em;
  background-color: rgb(164, 189, 183, 0.5);
  width: 50px;
  padding: 3px;
  border-radius: 5px;
  font-weight: bolder;
  letter-spacing: 1px;

  display: block;
  margin: 0px auto 10px;
}

.name {
  font-size: 1.25em;
  font-weight: bolder;
  letter-spacing: 1px;
}

.job_title {
  font-size: 0.65em;
  font-weight: bolder;
  color: gray;
  margin-top: -2px;
}

.job_discription {
  font-size: 0.7em;
  color: gray;
  margin: 10px 30px 20px;
}

button {
  width: 130px;
  height: 40px;
  border-radius: 10px;
  font-weight: bolder;
}

.button {
  display: flex;
  justify-content: space-around;
  flex-direction: row;
  margin: 20px 30px 0px;
}

.button .message {
  background: #fff;
  border: 2px solid #000;
}

.button .connect {
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
.switch input[type=checkbox] {
  height: 0;
  width: 0;
  visibility: hidden;
}

.switch label {
  cursor: pointer;
  width: 56px;
  height: 28px;
  background: lightgray;
  display: block;
  border-radius: 7px;
  position: relative;
}

.switch label:before {
  content: attr(data-off);
  position: absolute;
  top: 1.4px;
  right: 0;
  font-size: 8.4px;
  padding: 7px 7px;
  color: white;
}

.switch input:checked + label:before {
  content: attr(data-on);
  position: absolute;
  left: 0;
  font-size: 8.4px;
  padding-left: 7px;
  color: white;
}

.switch label:after {
  content: "";
  position: absolute;
  top: 1.4px;
  left: 1.4px;
  width: 25.2px;
  height: 25.2px;
  background: #fff;
  border-radius: 5.6px;
}

.switch input:checked + label {
  background: #007bff;
}

.switch input:checked + label:after {
  transform: translateX(28px);
}
/* Content-1:End */

    </style>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Form Basic</h4>
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
    @livewire('authors')
@endsection
