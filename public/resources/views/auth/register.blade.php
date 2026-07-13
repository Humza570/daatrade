@extends('layouts.common')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body register-form">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="firstname">{{ __('First Name') }}</label>
                                    <input id="firstname" type="text"
                                        class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                        value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname">{{ __('Last Name') }}</label>
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="email">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="contact_numer">{{ __('Contact No') }}</label>
                                    <input id="contact_numer" type="tel"
                                        class="form-control @error('contact_numer') is-invalid @enderror" name="contact_numer"
                                        value="{{ old('contact_numer') }}" required autocomplete="email">
                                    @error('contact_numer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">


                                <div class="col-md-6">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                @php
                                    $countries = App\Models\Country::all();
                                @endphp
                                <div class="col-md-6">
                                    <label for="country">{{ __('Country/Region') }}</label>
                                    <select id="country" class="form-control @error('country') is-invalid @enderror"
                                        name="country" required>
                                        <option value="">Select Country/Region</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="city">{{ __('City') }}</label>
                                    <select id="city" class="form-control @error('city') is-invalid @enderror"
                                        name="city" required>
                                    </select>
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="company_name">{{ __('Company Name') }}</label>
                                    <input id="company_name" type="text"
                                        class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                                        value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label
                                        for="company_registration_number">{{ __('Company Registration Number') }}</label>
                                    <input id="company_registration_number" type="text"
                                        class="form-control @error('company_registration_number') is-invalid @enderror"
                                        name="company_registration_number" value="{{ old('company_registration_number') }}"
                                        required autocomplete="company_registration_number" autofocus>
                                    @error('company_registration_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="role">{{ __('Please select trade role') }}</label>
                                    <select id="role" class="form-control @error('role') is-invalid @enderror"
                                        name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="supplier">Supplier</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Rest of the fields -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script>
        $('#country').change(function() {
            if ($(this).val() != '') {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getcontactcities') }}",
                    data: {
                        countryid: $(this).val(),
                    },
                    success: function(res, code) {
                        var resultSet = res.getcontactcities;
                        $('#city').html('');
                        $('#city').append('<option value="">Select City</option>');
                        for (var i = 0; i < resultSet.length; i++) {
                            var cityname = resultSet[i].name;
                            $('#city').append('<option value="' + cityname + '">' + cityname +
                                '</option>');
                        };
                    }
                })
            }
        })
    </script>
@endsection
