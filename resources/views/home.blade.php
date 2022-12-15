<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>METCON</title>
    <link href="{{ asset('assets/css/front.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container" style="background-color:#48789b">
        <div class="header">
            <a style="text-decoration:none" href="{{ route('home') }}"><img
                    src="{{ asset('assets/images/login_steel.png') }}" class="logo">
                <div class="title_col">
                    <h1>METCON</h1>
                </div>
            </a>
            <nav>
                <ul>
                    {{-- <li><a href="">Home</a></li>
                    <li><a href="">Products</a></li>
                    <li><a href="">Community</a></li>
                    <li><a href="">Contact</a></li> --}}
                </ul>
            </nav>
            <a href="{{ route('home') }}" class="btn" id="btn2">Home</a>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h2 class="text_white text-centre">Tick a check box to add the quantities</h2>
                <a href="{{ route('home') }}" class="btn" id="btn1">Reset All</a>
                <table class="mt-5">
                    <thead>
                        <tr>
                            <td></td>
                            <td><label class="radio_check">
                                    <input id="radio1" name="radio_data" type="radio">
                                    <span class="checkmark"></span>
                                </label></td>
                            <td><label class="radio_check">
                                    <input id="radio2" name="radio_data" type="radio">
                                    <span class="checkmark"></span>
                                </label></td>
                            <td colspan=2><label class="radio_check">
                                    <input id="radio3" name="radio_data" type="radio">
                                    <span class="checkmark"></span>
                                </label></td>
                            <td><label class="radio_check">
                                    <input id="radio4" name="radio_data" type="radio">
                                    <span class="checkmark"></span>
                                </label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th class="text_white">Size in mm</th>
                            <th class="text_white">Weight in Kgs</th>
                            <th class="text_white">No. of Rods</th>
                            <th scope="col" colspan=2 class="text_white text-centre"> No. of
                            </th>
                            <th class="text_white">Rate in Kgs(Rs)</th>
                            <th class="text_white">Total Amt.</th>
                        </tr>
                        <tr>
                            <th scope="row">&nbsp;</th>
                            <th scope="row">&nbsp;</th>
                            <th scope="row">&nbsp;</th>
                            <!-- The following two cells will appear under the same header -->
                            <td class="text_white text-centre">Bundles</td>
                            <td class="text_white text-centre">Rods</td>
                            <th scope="row">&nbsp;</th>
                            <th scope="row">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sizes->count() > 0)
                            <input type="hidden" name="size_count" id="size_count" value="{{ $sizes->count() }}">
                            @foreach ($sizes as $key => $size)
                                <input type="hidden" name="size_id_{{ $key }}"
                                    id="size_id_{{ $key }}" value="{{ $size->id }}">
                                <tr>
                                    <td id="size" class="text_white text-size">{{ $size->size }}</td>
                                    <td class="text_white"><input min="0" id="weight_{{ $key }}"
                                            onkeyup="weight_change('{{ $key }}');" type="number" disabled
                                            class="form-control text-size btn-st" name="weight_{{ $key }}">
                                    </td>
                                    <td class="text_white "><input min="0" id="rods_{{ $key }}"
                                            onkeyup="rod_change('{{ $key }}');" type="number" disabled
                                            class="form-control text-size btn-st" name="rods_{{ $key }}"></td>
                                    <td class="text_white "><input min="0" id="bundles_{{ $key }}"
                                            onkeyup="bundle_change('{{ $key }}');" type="number" disabled
                                            class="form-control text-size btn-st" name="bundles_{{ $key }}">
                                    </td>
                                    <td class="text_white "><input min="0" id="rods_new_{{ $key }}" type="number"
                                            disabled class="form-control text-size btn-st"
                                            name="rods_new_{{ $key }}"></td>
                                    <td class="text_white "><input min="0" id="rate_{{ $key }}"
                                            onkeyup="rate_change('{{ $key }}')" type="number" disabled
                                            class="form-control text-size btn-st" name="rate_{{ $key }}">
                                    </td>
                                    <td class="text_white "><input min="0" id="amt_{{ $key }}" type="number"
                                            disabled class="form-control text-size btn-st text-right"
                                            name="amt_{{ $key }}"></td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <th class="text_white"></th>
                            <th class="text_white"><span id="foot_weight"></span>Kgs</th>
                            <th class="text_white"><span id="foot_rods"></span>Rods</th>
                            <th class="text_white"><span id="foot_bundles"></span>Bundles</th>
                            <th class="text_white"><span id="foot_extra_rods"></span>Rods</th>
                            <th class="text_white text-right"><span id="foot_amt">0.00</span></th>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-centre text_white">Total Amount(Rs)</th>
                            <th class="text-right text_white">
                                <h2><span id="total_amount"></span></h2>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-centre text_white text-op">
                                @if ($gst)
                                    {{ $gst->gst }}
                                @else
                                    18
                                @endif % GST Amount (Rs)
                            </th>
                            <input type="hidden"
                                value="@if ($gst) {{ $gst->gst }} @else 18 @endif"
                                id="gst_val">
                            <th class="text-right text_white">
                                <h2><span id="gst_amount"></span></h2>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-centre text_white">Grand Total(Rs)</th>
                            <th class="text-right text_white">
                                <h2><span id="final_amount"></span></h2>
                            </th>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="content">
                    <div class="text mb-5 text-center text_white">
                        © 2022 VSM Hospital. All Rights Reserved. Digitally Empowered by <a href="https://www.netventure.in/"> NetVenture Digital Solutions Pvt. Ltd. </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script>
        $('#radio1').change(function(event) {
            var count = $('#size_count').val();
            for (var i = 0; i <= count; i++) {
                $('#weight_' + i).removeAttr('disabled');
                $('#weight_' + i).val('');
                $('#rods_' + i).val('');
                $('#bundles_' + i).val('');
                $('#rods_new_' + i).val('');
                $('#rate_' + i).val('');
                $('#rods_' + i).attr('disabled', 'disabled');
                $('#bundles_' + i).attr('disabled', 'disabled');
                $('#rate_' + i).attr('disabled', 'disabled');
                $("#foot_rods").html("");
                $("#foot_weight").html("");
                $("#foot_bundles").html("");

            }
        });
        $('#radio2').change(function(event) {
            var count = $('#size_count').val();
            for (var i = 0; i <= count; i++) {
                $('#rods_' + i).removeAttr('disabled');
                $('#weight_' + i).val('');
                $('#rods_' + i).val('');
                $('#bundles_' + i).val('');
                $('#rate_' + i).val('');
                $('#rods_new_' + i).val('');
                $('#weight_' + i).attr('disabled', 'disabled');
                $('#bundles_' + i).attr('disabled', 'disabled');
                $('#rate_' + i).attr('disabled', 'disabled');
                $("#foot_rods").html("");
                $("#foot_weight").html("");
                $("#foot_bundles").html("");

            }
        });
        $('#radio3').change(function(event) {
            var count = $('#size_count').val();
            for (var i = 0; i <= count; i++) {
                $('#bundles_' + i).removeAttr('disabled');
                $('#weight_' + i).val('');
                $('#rods_' + i).val('');
                $('#bundles_' + i).val('');
                $('#rods_new_' + i).val('');
                $('#rate_' + i).val('');
                $('#weight_' + i).attr('disabled', 'disabled');
                $('#rods_' + i).attr('disabled', 'disabled');
                $('#rate_' + i).attr('disabled', 'disabled');
                $("#foot_rods").html("");
                $("#foot_weight").html("");
                $("#foot_bundles").html("");

            }
        });
        $('#radio4').change(function(event) {
            var count = $('#size_count').val();
            for (var i = 0; i <= count; i++) {
                $('#rate_' + i).removeAttr('disabled');

            }
        });

        // rod change
        function rod_change(key) {
            delay(function(){
                var rod = $('#rods_' + key).val();
                var size_val = $('#size_id_' + key).val();
                var count = $('#size_count').val();
                var total_rods = 0;
                var total_weight = 0;
                var total_bundles = 0;
                var total_new_rods = 0;
                $("#foot_rods").html("");
                $("#foot_weight").html("");
                $("#foot_bundles").html("");
                $("#foot_extra_rods").html("");
                $.ajax({
                    url: "{{ route('rod_calc') }}",
                    type: "GET",
                    data: {
                        rod: rod,
                        size_val: size_val,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#weight_' + key).val(result.total_weight);
                        $('#bundles_' + key).val(result.bundle);
                        $('#rods_new_' + key).val(result.rem);
                        // $('#city-dd').html('<option value="">City</option>');
                        for (var i = 0; i <= count; i++) {
                            var rod_value = $('#rods_' + i).val();
                            if (rod_value) {
                                total_rods = parseInt(total_rods) + parseInt(rod_value);

                            }
                        }
                        var html = '<span>' + total_rods + '  </span>';
                        $('#foot_rods').append(html);

                        for (var j = 0; j <= count; j++) {
                            var weight_value = $('#weight_' + j).val();
                            if (weight_value) {
                                total_weight = parseInt(total_weight) + parseInt(weight_value);

                            }
                        }
                        var html1 = '<span>' + total_weight + '  </span>';
                        $('#foot_weight').append(html1);

                        for (var k = 0; k <= count; k++) {
                            var bundle_value = $('#bundles_' + k).val();
                            if (bundle_value) {
                                total_bundles = parseInt(total_bundles) + parseInt(bundle_value);

                            }
                        }
                        var html2 = '<span>' + total_bundles + '  </span>';
                        $('#foot_bundles').append(html2);

                        for (var m = 0; m <= count; m++) {
                            var rods_new_value = $('#rods_new_' + m).val();
                            if (rods_new_value) {
                                total_new_rods = parseInt(total_new_rods) + parseInt(rods_new_value);

                            }
                        }
                        var html3 = '<span>' + total_new_rods + '  </span>';
                        $('#foot_extra_rods').append(html3);
                    }
                });
            }, 100 );
           
        }

        // bundle change
        function bundle_change(key) {
            delay(function(){
                var bundle = $('#bundles_' + key).val();
                var size_val = $('#size_id_' + key).val();
                var count = $('#size_count').val();
                var total_bundles = 0;
                var total_rods = 0;
                var total_weight = 0;
                $("#foot_bundles").html("");
                $("#foot_rods").html("");
                $("#foot_weight").html("");
                $.ajax({
                    url: "{{ route('bundle_calc') }}",
                    type: "GET",
                    data: {
                        bundle: bundle,
                        size_val: size_val,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#weight_' + key).val(result.total_weight);
                        $('#rods_' + key).val(result.rods);
                        for (var k = 0; k <= count; k++) {
                            var bundle_value = $('#bundles_' + k).val();
                            if (bundle_value) {
                                console.log(bundle_value);
                                total_bundles = parseInt(total_bundles) + parseInt(bundle_value);

                            }
                        }
                        var html1 = '<span>' + total_bundles + '  </span>';
                        $('#foot_bundles').append(html1);

                        for (var i = 0; i <= count; i++) {
                            var rod_value = $('#rods_' + i).val();
                            if (rod_value) {
                                console.log(rod_value);
                                total_rods = parseInt(total_rods) + parseInt(rod_value);

                            }
                        }
                        var html = '<span>' + total_rods + '  </span>';
                        $('#foot_rods').append(html);

                        for (var j = 0; j <= count; j++) {
                            var weight_value = $('#weight_' + j).val();
                            if (weight_value) {
                                console.log(weight_value);
                                total_weight = parseInt(total_weight) + parseInt(weight_value);

                            }
                        }
                        var html2 = '<span>' + total_weight + '  </span>';
                        $('#foot_weight').append(html2);
                        // $('#city-dd').html('<option value="">City</option>');
                    }
                });
            }, 100 );
        }

        // weight change
        function weight_change(key) {
            delay(function(){
                var weight = $('#weight_' + key).val();
                var size_val = $('#size_id_' + key).val();
                var total_weight = 0;
                var total_rods = 0;
                var total_bundles = 0;
                var count = $('#size_count').val();
                $("#foot_weight").html("");
                $("#foot_rods").html("");
                $("#foot_bundles").html("");
                $.ajax({
                    url: "{{ route('weight_calc') }}",
                    type: "GET",
                    data: {
                        weight: weight,
                        size_val: size_val,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result)
                        console.log(result.total_weight)
                        $('#bundles_' + key).val(result.bundle);
                        $('#rods_' + key).val(result.rods);
                        $('#rods_new_' + key).val(result.rem);
                        // $('#city-dd').html('<option value="">City</option>');
                        for (var i = 0; i <= count; i++) {
                            var weight_value = $('#weight_' + i).val();
                            if (weight_value) {
                                console.log(weight_value);
                                total_weight = parseInt(total_weight) + parseInt(weight_value);

                            }
                        }
                        var html = '<span>' + total_weight + '  </span>';
                        $('#foot_weight').append(html);

                        for (var j = 0; j <= count; j++) {
                            var rod_value = $('#rods_' + j).val();
                            if (rod_value) {
                                console.log(rod_value);
                                total_rods = parseInt(total_rods) + parseInt(rod_value);

                            }
                        }
                        var html = '<span>' + total_rods + '  </span>';
                        $('#foot_rods').append(html);

                        for (var k = 0; k <= count; k++) {
                            var bundle_value = $('#bundles_' + k).val();
                            if (bundle_value) {
                                console.log(bundle_value);
                                total_bundles = parseInt(total_bundles) + parseInt(bundle_value);

                            }
                        }
                        var html2 = '<span>' + total_bundles + '  </span>';
                        $('#foot_bundles').append(html2);
                    }
                });
            }, 100 );
        }

        // rate chnage
        function rate_change(key) {
            delay(function(){
                var rate = $('#rate_' + key).val();
                var weight = $('#weight_' + key).val();
                var count = $('#size_count').val();
                var total_amt = 0;
                var percentage = $('#gst_val').val();
                var gst_amount = 0;
                var gst_only = 0;
                $('#total_amount').html("");
                $('#final_amount').html("");
                $('#gst_amount').html("");
                $.ajax({
                    url: "{{ route('rate_calc') }}",
                    type: "GET",
                    data: {
                        weight: weight,
                        rate: rate,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#amt_' + key).val(result.total_amount);
                        for (var k = 0; k <= count; k++) {
                            var amt_value = $('#amt_' + k).val();
                            if (amt_value) {
                                // console.log(amt_value);
                                total_amt = parseInt(total_amt) + parseInt(amt_value);

                            }
                        }
                        var html = '<span>' + total_amt + '  </span>';
                        $('#total_amount').append(html);
                        if (total_amt) {
                            gst_amount = (parseInt(total_amt) * (100 + parseInt(percentage)) / 100);
                            gst_amount = Math.ceil(gst_amount);
                            gst_only =  gst_amount - total_amt;
                        }
                        var html1 = '<span>' + gst_amount + '  </span>';
                        var html2 = '<span>' + gst_only + '  </span>';
                        $('#final_amount').append(html1);
                        $('#gst_amount').append(html2);
                        // $('#rods_new_'+key).val(result.rem);
                        // $('#city-dd').html('<option value="">City</option>');
                    }
                });
            }, 100 );
        }
        $("input[type=number]").on("keydown", function(e) {
            var invalidChars = ["-", "+", "e", " "]; //include "." if you only want integers
            if (invalidChars.includes(e.key)) {
                e.preventDefault();
            }
        });

        var delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
            })();
    </script>
</body>

</html>
