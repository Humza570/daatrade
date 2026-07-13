@extends('layouts.admin')
<style>
    .form-row {
        margin-bottom: 10px;
    }

    .error {
        color: red;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    p {
        margin-bottom: 0 !important;
    }

    .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .upload__btn {
        display: inline-block;
        font-weight: 600;
        color: #fff;
        text-align: center;
        min-width: 116px;
        padding: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        background-color: #4045ba;
        border-color: #4045ba;
        border-radius: 10px;
        line-height: 26px;
        font-size: 14px;
    }

    .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
    }

    .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 20px auto;
    }

    .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
    }

    .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
    }

    .upload__btn-box label {
        margin-bottom: 0 !important;
    }

    .upload__img-close:after {
        content: "✖";
        font-size: 14px;
        color: white;
    }

    .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

@section('content')
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
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            @if (session('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            @if (session('error'))
            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" method="post" action="{{ route('saveproduct') }}" enctype="multipart/form-data">
                <div class="card">
                    @csrf
                    <input type="hidden" name="id" id="id" value="">
                    <div class="card-body">
                        <h4 class="card-title">Choose Product Category</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="category_id" class="text-right control-label col-form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                <span class="error text-danger error-category"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sub_category_id" class="text-right control-label col-form-label">Sub
                                    Category</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control" required></select>
                                <span class="error text-danger error-sub-category"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sub_child_category_id" class="text-right control-label col-form-label">Sub
                                    Child Category</label>
                                <select name="sub_child_category_id" id="sub_child_category_id" class="form-control" required></select>
                                <span class="error text-danger error-sub-child-category"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="productname" class="text-right control-label col-form-label">Product
                                    Name</label>
                                <input type="text" class="form-control" name="productname" required id="productname">
                                <div class="error text-danger" id="productname-error"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="price" class="text-right control-label col-form-label">Product
                                    Description</label>
                                <textarea name="description" id="description" col="12" rows="10" required class="form-control"></textarea>
                                <script>
                                    CKEDITOR.replace('description');
                                </script>
                                <div class="error text-danger" id="description-error"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="tags-input" class="text-right control-label col-form-label">Product
                                    Keywords</label>
                                <input type="text" class="form-control" required id="tags-input" placeholder="Enter tags" name="tags[]">
                                <div class="error text-danger" id="tags-input-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Composition</h4>
                        <div id="attribute_fields"></div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="attribute">Attribute<span class="text-danger">*</span></label>
                                <input type="text" placeholder="Attribute" required id="attribute" class="form-control" name="attribute[]" value="">
                                <div class="error text-danger" id="attributes-error"></div>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="details">Details<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="details" placeholder="Details" required name="details[]" value="">
                                <div class="error text-danger" id="details-error"></div>
                            </div>
                            <div class="form-group col-md-1 pt-1">
                                <div class="input-group-btn mt-4">
                                    <button class="btn btn-success" type="button" onclick="attribute_fields();">
                                        <span class="fa fa-plus" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="form-row">
                                <!-- Image Upload Section -->
                                <div class="form-group">
                                    <label for="images">Product Images (up to 6)</label>
                                    <input type="file" class="form-control-file" name="images[]" id="images"
                                        multiple accept="image/*">
                                    <small class="form-text text-muted">Max file size: 2MB per image</small>
                                    <div id="image-preview"></div>
                                </div>
                                @if ($errors->has('images'))
                                    <div class="error text-danger">{{ $errors->first('images') }}
                    </div>
                    @endif
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="video" class="text-right control-label col-form-label">Video</label>
                            <input type="url" name="video" id="video" class="form-control">
                        </div>
                    </div>
                </div> --}}
                <h4 class="card-title">Upload Product Images</h4>
                <div class="form-row">
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <label class="upload__btn">
                                <p>Upload images</p>
                                <input type="file" multiple="" data-max_length="6" class="upload__inputfile">

                            </label>
                            <span class="text-secondary mt-2 float-left">
                                <p> Image file size should be less than 5MB. Supported formats: .jpeg .jpg .png
                                    <br>
                                    Recommended image size is more than 640px * 640px. Images should be clear
                                    and easy for buyers to view at a glance.
                                </p>
                            </span>
                        </div>
                        <div class="upload__img-wrap  float-left"></div>
                        <input type="hidden" id="imageList" name="imageList" value="">

                        <div class="error text-danger error-imageList" id="attributes-error"></div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <label for="video" class="text-right control-label col-form-label">Video</label>
                        <input type="url" name="video" id="video" class="form-control">
                    </div>
                </div>
        </div>
    </div>
    <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="vendorname" class="text-right control-label col-form-label">Supplier Name</label>
                                <input type="text" class="form-control" name="vendorname" required id="vendorname">
                                <div class="error text-danger" id="vendorname-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product Price</h4>
            <div class="form-row">
                <div class="col-md-12">
                    <label for="price" class="text-right control-label col-form-label">Price
                        setting</label>
                </div>
                <div class="col-md-12">
                    <label class="radio-inline" style="margin-right: 50px;">
                        <input type="radio" name="price_setting" value="variable" checked onclick="toggleFields('variable')"> Set variable price according to MOQ
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="price_setting" value="uniform" onclick="toggleFields('uniform')"> Set uniform price
                    </label>

                </div>
            </div>
            <div class="form-row">
                <div class="col-md-5">
                    <label for="unit" class="text-right control-label col-form-label">Select a
                        Unit:</label>
                    <select name="unit" id="unit" class="form-control select2" required>
                        <option value="">Select a unit...</option>
                        <!-- Weight Units -->
                        <optgroup label="Weight">
                            <option value="kg">Kilogram (kg)</option>
                            <option value="g">Gram (g)</option>
                            <option value="mg">Milligram (mg)</option>
                            <option value="tonne">Metric Ton (tonne)</option>
                            <option value="lb">Pound (lb)</option>
                            <option value="oz">Ounce (oz)</option>
                            <!-- Add more weight units as needed -->
                        </optgroup>

                        <!-- Length Units -->
                        <optgroup label="Length">
                            <option value="m">Meter (m)</option>
                            <option value="cm">Centimeter (cm)</option>
                            <option value="in">Inch (in)</option>
                            <option value="ft">Foot (ft)</option>
                            <!-- Add more length units as needed -->
                        </optgroup>

                        <!-- Liquid Volume Units -->
                        <optgroup label="Liquid Volume">
                            <option value="L">Liter (L)</option>
                            <option value="mL">Milliliter (mL)</option>
                            <option value="gal">Gallon (gal)</option>
                            <option value="floz">Fluid Ounce (fl oz)</option>
                            <option value="pt">Pint (pt)</option>
                            <option value="qt">Quart (qt)</option>
                            <option value="bbl">Barrel (bbl)</option>
                            <!-- Add more liquid volume units as needed -->
                        </optgroup>

                        <!-- Area Units -->
                        <optgroup label="Area">
                            <option value="acres">Acres (ac)</option>
                            <option value="sqyd">Square Yards (sq yd)</option>
                            <option value="sqm">Square Meters (sq m)</option>
                            <option value="sqft">Square Feet (sq ft)</option>
                            <option value="sqin">Square Inches (sq in)</option>
                            <option value="hectares">Hectares (ha)</option>
                            <option value="sqmi">Square Miles (sq mi)</option>
                            <!-- Add more area units as needed -->
                        </optgroup>

                        <!-- Time Units -->
                        <optgroup label="Time">
                            <option value="s">Second (s)</option>
                            <option value="min">Minute (min)</option>
                            <option value="hr">Hour (hr)</option>
                            <option value="day">Day (day)</option>
                            <option value="wk">Week (wk)</option>
                            <option value="mo">Month (mo)</option>
                            <option value="yr">Year (yr)</option>
                            <!-- Add more time units as needed -->
                        </optgroup>

                        <!-- Temperature Units -->
                        <optgroup label="Temperature">
                            <option value="C">Celsius (°C)</option>
                            <option value="F">Fahrenheit (°F)</option>
                            <option value="K">Kelvin (K)</option>
                            <!-- Add more temperature units as needed -->
                        </optgroup>

                        <!-- Speed and Velocity Units -->
                        <optgroup label="Speed and Velocity">
                            <option value="m/s">Meters per Second (m/s)</option>
                            <option value="km/h">Kilometers per Hour (km/h)</option>
                            <option value="mph">Miles per Hour (mph)</option>
                            <option value="kt">Knot (kt)</option>
                            <!-- Add more speed and velocity units as needed -->
                        </optgroup>

                        <!-- Pressure Units -->
                        <optgroup label="Pressure">
                            <option value="Pa">Pascal (Pa)</option>
                            <option value="kPa">Kilopascal (kPa)</option>
                            <option value="bar">Bar (bar)</option>
                            <option value="atm">Atmosphere (atm)</option>
                            <option value="Torr">Torr (Torr)</option>
                            <!-- Add more pressure units as needed -->
                        </optgroup>

                        <!-- Volume Units (Other than Liquid) -->
                        <optgroup label="Volume (Other than Liquid)">
                            <option value="m³">Cubic Meter (m³)</option>
                            <option value="cm³">Cubic Centimeter (cm³)</option>
                            <option value="in³">Cubic Inch (in³)</option>
                            <option value="ft³">Cubic Foot (ft³)</option>
                            <option value="yd³">Cubic Yard (yd³)</option>
                            <!-- Add more volume units as needed -->
                        </optgroup>

                        <!-- Energy Units -->
                        <optgroup label="Energy">
                            <option value="J">Joule (J)</option>
                            <option value="cal">Calorie (cal)</option>
                            <option value="kcal">Kilocalorie (kcal)</option>
                            <option value="BTU">British Thermal Unit (BTU)</option>
                            <!-- Add more energy units as needed -->
                        </optgroup>

                        <!-- Power Units -->
                        <optgroup label="Power">
                            <option value="W">Watt (W)</option>
                            <option value="kW">Kilowatt (kW)</option>
                            <option value="hp">Horsepower (hp)</option>
                            <!-- Add more power units as needed -->
                        </optgroup>

                        <!-- Force Units -->
                        <optgroup label="Force">
                            <option value="N">Newton (N)</option>
                            <option value="dyn">Dyne (dyn)</option>
                            <option value="lbf">Pound-Force (lbf)</option>
                            <!-- Add more force units as needed -->
                        </optgroup>
                        <!-- More Units can be added here... -->
                    </select>
                    <div class="error text-danger w-100" id="unit_error"></div>


                </div>
            </div>
            <div class="form-row" id="variable">
                <div class="form-group col-md-3 float-left">
                    <label for="variablemoq">MOQ (unit)<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="variablemoq" placeholder="MOQ (unit)" name="variablemoq[]" value="">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="variableprice">Price (US $)<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="variableprice" placeholder="Price (US $)" name="variableprice[]">
                </div>
                <div class="form-group col-md-2 pt-2 float-left">
                    <div class="input-group-btn mt-4" id="add_button_container">
                        <button class="btn btn-success" type="button" onclick="add_unit_fields();">
                            <span class="fa fa-plus" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="clear"></div>
                <div id="unit_fields"></div>
            </div>
            <div class="form-row">
                <div class="error text-danger" id="variablemoq-error"></div>
            </div>
            <div id="uniform" style="display: none">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="uniform_moq" class="text-right control-label col-form-label">MOQ</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="uniform_moq" id="uniform_moq">
                            <div class="input-group-append">
                                <span class="input-group-text">Unit</span>
                            </div>
                            <div class="error text-danger w-100" id="uniform_moq_error"></div>
                        </div>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="FOBprice" class="text-right control-label col-form-label">Currency<span class="text-danger">*</span></label>
                        <select data-placeholder="FOB Price" class="form-control" id="FOBprice" name="FOBprice">
                            <option value="">Currency</option>
                            @foreach ($currencies as $currencyGroup)
                            <option value="{{ $currencyGroup->currency }}">
                                {{ $currencyGroup->currency }}
                            </option>
                            @endforeach
                        </select>
                        <div class="error text-danger" id="FOBprice_error"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="uniform_moq_price" class="text-right control-label col-form-label">Price</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="uniform_moq_min_price" placeholder="Min MOQ Price" name="uniform_moq_min_price">
                            <div class="input-group-prepend">
                                <span class="input-group-text">-</span>
                            </div>
                            <input type="text" class="form-control" id="uniform_moq_max_price" placeholder="Max MOQ Price" name="uniform_moq_max_price">
                        </div>
                        <div class="error text-danger" id="uniform_moq_min_price_error"></div>
                        <div class="error text-danger" id="uniform_moq_max_price_error"></div>
                        <div id="price_error" class="text-danger"></div> <!-- Error message container -->
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary float-right" id="submit-button">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#category_id').change(function() {
        if ($(this).val() != '') {
            $.ajax({
                type: "GET",
                url: "{{ route('getsubcategories') }}",
                data: {
                    category_id: $(this).val(),
                },
                success: function(res, code) {
                    var resultSet = res.subcategories;
                    $('#sub_category_id').html('');
                    $('#sub_category_id').append('<option value="">Select Sub Category</option>');
                    for (var i = 0; i < resultSet.length; i++) {
                        var subcategoryid = resultSet[i].id;
                        var subcategory = resultSet[i].subcategory;
                        $('#sub_category_id').append('<option value="' + subcategoryid + '">' +
                            subcategory + '</option>');
                    };
                }
            })
        }
    })
    $('#sub_category_id').change(function() {
        if ($(this).val() != '') {
            $.ajax({
                type: "GET",
                url: "{{ route('getsubchildcategories') }}",
                data: {
                    subcategory_id: $(this).val(),
                },
                success: function(res, code) {
                    var resultSet = res.subchildcategories;
                    $('#sub_child_category_id').html('');
                    $('#sub_child_category_id').append(
                        '<option value="">Select Sub Child Category</option>');
                    for (var i = 0; i < resultSet.length; i++) {
                        var subchildcategoryId = resultSet[i].id;
                        var subchildcategory = resultSet[i].subchildcategory;
                        $('#sub_child_category_id').append('<option value="' + subchildcategoryId +
                            '">' +
                            subchildcategory + '</option>');
                    };
                }
            })
        }
    });
</script>
<script>
    // $(document).ready(function() {
    // Track the total number of uploaded images
    var totalUploadedImages = 0;

    // Attach change event handler to file input
    $('.upload__inputfile').change(function() {
        $('.upload__inputfile').each(function() {
            totalUploadedImages += this.files.length;
        });
        validateFileUpload($('.error-imageList'));
    });

    // Function to validate file uploads
    function validateFileUpload($errorDiv) {
        if (totalUploadedImages < 6) {
            $errorDiv.html('Please upload at least 6 images');
        } else {
            $errorDiv.html(''); // Clear the error message
        }
    }

    // Add a submit event handler to the form
    $('form').submit(function(event) {

        var isValid = true;
        // Product Name validation (you can add your own validation logic)
        var productName = $('#productname').val();
        if (productName.trim() === '') {
            $('#productname-error').text('Product Name is required');
            isValid = false;
        } else {
            $('#productname-error').text('');
        }

        // Product Description validation (you can add your own validation logic)
        var description = CKEDITOR.instances.description.getData();
        var plainText = description.replace(/<\/?[^>]+(>|$)/g, "");
        if (plainText === '') {
            $('#description-error').text('Product Description is required');
            isValid = false;
        } else {
            $('#description-error').text('');
        }

        // Product Keywords validation (you can add your own validation logic)
        var tagsInput = $('#tags-input').val();
        if (tagsInput.trim() === '') {
            $('#tags-input-error').text('Product Keywords are required');
            isValid = false;
        } else {
            $('#tags-input-error').text('');
        }

        // Attributes validation - Ensure at least 4 sets of attributes
        var attributeCount = $('[name="attribute[]"]').length;
        var detailsCount = $('[name="details[]"]').length;
        if (attributeCount < 4) {
            $('#attributes-error').text('Please add at least 4 sets of attributes');
            isValid = false;
        } else {
            var allInputs = document.querySelectorAll('input[name="details[]"], input[name="attribute[]"]');
            var isEmpty = false;

            allInputs.forEach(function(input) {
                if (input.value === '') {
                    isEmpty = true;
                    return;
                }
            });
            if (isEmpty) {
                return false
            }
            $('#attributes-error').text('');
        }
        if (detailsCount < 4) {
            $('#details-error').text('Please add at least 4 sets of Details');
            isValid = false;
        } else {
            $('#details-error').text('');
        }

        if (totalUploadedImages < 6) {
            $('.error-imageList').text('Please upload at least 6 images');
            isValid = false;
        } else {
            $('.error-imageList').text('');
        }

        if (selectionType == 'variable') {
            var unit = $('#unit').val();
            if (unit === '') {
                $('#unit_error').text('MOQ is required');
                isValid = false;
            } else {
                $('#unit_error').text('');
            }
            var getVariablePriceFields = document.querySelectorAll(
                'input[name="variablemoq[]"], input[name="variableprice[]"]');
            var isEmpty = false;

            getVariablePriceFields.forEach(function(input) {
                if (input.value === '') {
                    isEmpty = true;
                    return;
                }
            });
            if (isEmpty) {
                $('#variablemoq-error').text('Please fill all required MOQ fields');
                return false
            } else {
                $('#variablemoq-error').text('');
            }
        } else {
            var unit = $('#unit').val();
            if (unit === '') {
                $('#unit_error').text('MOQ is required');
                isValid = false;
            } else {
                $('#unit_error').text('');
            }
            var uniform_moq = $('#uniform_moq').val();
            var FOBprice = $('#FOBprice').val();
            var uniform_moq_min_price = $('#uniform_moq_min_price').val();
            var uniform_moq_max_price = $('#uniform_moq_max_price').val();
            if (uniform_moq === '') {
                $('#uniform_moq_error').text('MOQ is required');
                isValid = false;
            } else {
                $('#uniform_moq_error').text('');
            }
            if (FOBprice === '') {
                $('#FOBprice_error').text('Currency is required');
                isValid = false;
            } else {
                $('#FOBprice_error').text('');
            }
            if (uniform_moq_min_price === '') {
                $('#uniform_moq_min_price_error').text('Minimum Order Price is required');
                isValid = false;
            } else {
                $('#uniform_moq_min_price_error').text('');
            }
            if (uniform_moq_max_price === '') {
                $('#uniform_moq_max_price_error').text('Maximum Order Price is required');
                isValid = false;
            } else {
                $('#uniform_moq_max_price_error').text('');
            }
        }
        if (!isValid) {

            event.preventDefault(); // Prevent form submission if validation fails
        }
        // Disable the submit button
       // $('#submit-button').prop('disabled', true);
        var $submitButton = $('#submit-button');
        $submitButton.prop('disabled', true);
        $submitButton.text('Please wait...');
    });
    // });
</script>
<script>
    var selectionType = 'variable';

    function toggleFields(selection) {
        selectionType = selection
        $('#uniform_moq').val('');
        $('#FOBprice').val('');
        $('#uniform_moq_min_price').val('');
        $('#uniform_moq_max_price').val('');
        const variablemoq = document.querySelectorAll('input[name="variablemoq[]"]');
        const variableprice = document.querySelectorAll('input[name="variableprice[]"]');
        variablemoq.forEach(inputField => {
            inputField.value = '';
        });
        variableprice.forEach(inputField => {
            inputField.value = '';
        });
        // Remove the dynamically generated rows when switching to 'uniform'
        const unitFields = document.getElementById('unit_fields');
        unit_count = 1;
        while (unitFields.firstChild) {
            unitFields.removeChild(unitFields.firstChild);
        }

        $('#unit_error-error').text('');
        $('#variablemoq-error').text('');
        if (selection === 'variable') {
            document.getElementById('variable').style.display = 'block';
            document.getElementById('uniform').style.display = 'none';
            // Clear any error messages related to the 'uniform' section
            document.getElementById('uniform_moq_error').innerHTML = '';
            document.getElementById('FOBprice_error').innerHTML = '';
            document.getElementById('uniform_moq_min_price_error').innerHTML = '';
            document.getElementById('uniform_moq_max_price_error').innerHTML = '';
        } else if (selection === 'uniform') {
            document.getElementById('variable').style.display = 'none';
            document.getElementById('uniform').style.display = 'block';
            // Clear any error messages related to the 'variable' section
            document.getElementById('variablemoq_error').innerHTML = '';
            document.getElementById('variableprice_error').innerHTML = '';

        }
    }
</script>

<script>
    var room = 1;

    function attribute_fields() {
        room++;
        var objTo = document.getElementById('attribute_fields');
        if (objTo) {
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-row removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML =
                '<div class="form-group col-md-4"><label for="attribute">Attribute<span class="text-danger">*</span></label><input type="text" placeholder="Attribute" id="attribute" class="form-control" name="attribute[]" value=""></div><div class="form-group col-md-4"><label for="details">details<span class="text-danger">*</span></label><input type="text" class="form-control" id="details" placeholder="Details" name="details[]" value=""></div><div class="form-group col-md-1 pt-1"><div class="input-group-btn mt-4"><button class="btn btn-danger" type="button" onclick="remove_attribute_fields(this)"><span class="fa fa-times" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
            objTo.appendChild(divtest);
        }
    }

    function remove_attribute_fields(element) {
        $(element).closest('.form-row').remove();
    }
</script>
<script>
    var unit_count = 1; // Initial unit count
    var max_units = 4; // Maximum units allowed

    function toggleAddButton() {
        if (unit_count < max_units) {
            document.getElementById('add_button_container').style.display = 'block';
        } else {
            document.getElementById('add_button_container').style.display = 'none';
        }
    }

    function add_unit_fields() {
        if (unit_count < max_units) {
            unit_count++;
            var objTo = document.getElementById('unit_fields');
            if (objTo) {
                var divUnit = document.createElement("div");
                divUnit.setAttribute("class", "form-row removeclass" + unit_count);
                var rdiv = 'removeclass' + unit_count;
                divUnit.innerHTML =
                    '<div class="form-group col-md-5"><label for="variablemoq">MOQ (unit)<span class="text-danger">*</span></label><input type="text" class="form-control" id="variablemoq" placeholder="MOQ (unit)" name="variablemoq[]"></div><div class="form-group col-md-5"><label for="variableprice">Price (US $)<span class="text-danger">*</span></label><input type="number" class="form-control" id="variableprice" placeholder="Price (US $)" name="variableprice[]"></div><div class="form-group col-md-2 pt-2"><div class="input-group-btn mt-4"><button class="btn btn-danger" type="button" onclick="remove_unit_fields(this)"><span class="fa fa-times" aria-hidden="true"></span></button></div></div><div class="clear"></div>';
                objTo.appendChild(divUnit);
                toggleAddButton();
            }
        }
    }

    function remove_unit_fields(element) {
        unit_count--;
        $(element).closest('.form-row').remove();
        toggleAddButton(); // Call the function to check if the "Add" button should be displayed
    }
    // Initially, hide the "Add" button if the maximum units are reached
    toggleAddButton();
</script>

<script>
    // Add an event listener for the "Max MOQ Price" input field losing focus
    $('#uniform_moq_max_price').on('blur', function() {
        var minPrice = parseFloat($('#uniform_moq_min_price').val());
        var maxPrice = parseFloat($(this).val());

        if (isNaN(minPrice) || isNaN(maxPrice) || minPrice <= maxPrice) {
            // Hide the error message if minPrice is not NaN, maxPrice is not NaN, and minPrice is less than or equal to maxPrice
            $('#price_error').text('');
        } else {
            // Show the error message if minPrice is NaN, maxPrice is NaN, or minPrice is greater than maxPrice
            $('#price_error').text('Cutoff value must be greater than the initial value');
            // Reset only the "Max MOQ Price" input field
            $(this).val('');
        }
    });

    // Allow only numeric input
    $('#uniform_moq_min_price, #uniform_moq_max_price').on('input', function() {
        this.value = this.value.replace(/[^0-9.]/g, ''); // Allow only digits and a decimal point
    });
</script>

<script>
    jQuery(document).ready(function() {
        ImgUpload();
    });

    function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').on('change', function(e) {
            imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
            var maxLength = $(this).data('max_length');

            var files = e.target.files;
            var filesArr = Array.from(files);

            filesArr.forEach(function(file) {
                if (!file.type.match('image.*')) {
                    return;
                }

                if (imgArray.length >= maxLength) {
                    return false;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.src = e.target.result;

                    img.onload = function() {
                        if (img.width < 640 || img.height < 640 || img.width !== img.height) {
                            // Display an error message for image dimensions
                            alert(
                                'Image dimensions must be at least 640x640 pixels and square.'
                            );
                            return;
                        }

                        var imgData = {
                            name: file.name,
                            base64: e.target.result
                        };

                        imgArray.push(imgData);
                        var html = `
                                <div class='upload__img-box'>
                                    <div style='background-image: url(${e.target.result})' data-number='${$(".upload__img-close").length}' data-file='${file.name}' class='img-bg'>
                                        <div class='upload__img-close'></div>
                                    </div>
                                </div>`;
                        imgWrap.append(html);

                        // Update the hidden input with the image list
                        getIdsOfImages();
                    }
                }
                reader.readAsDataURL(file);
            });
        });

        // Function to convert image to base64 when clicked or swiped
        $('body').on('click swipe', ".img-bg", function(e) {
            var imgElement = $(this);
            var imgFile = imgArray.find(img => img.name === imgElement.data('file'));

            if (imgFile) {
                var base64Data = imgFile.base64 || imgFile.base64Data; // Use the existing base64 if available
                if (!base64Data) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        base64Data = e.target.result;
                        imgFile.base64 = base64Data; // Store base64 data for future use
                        console.log('Base64 Image Data:', base64Data);
                    }
                    reader.readAsDataURL(getImageBlob(imgFile));
                } else {
                    console.log('Base64 Image Data:', base64Data);
                }
            }
        });

        $('body').on('click', ".upload__img-close", function(e) {
            var file = $(this).parent().data("file");
            for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i].name === file) {
                    imgArray.splice(i, 1);
                    break;
                }
            }
            $(this).parent().parent().remove();

            // Update the hidden input with the image list after removing an image
            getIdsOfImages();
        });

        function getImageBlob(imgFile) {
            return dataURItoBlob(imgFile.base64Data);
        }

        function dataURItoBlob(dataURI) {
            var byteString = atob(dataURI.split(',')[1]);
            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);

            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            return new Blob([ab], {
                type: mimeString
            });
        }
    }
</script>
@endsection