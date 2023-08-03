<?php require('./header.php'); ?>

<main>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div>
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="mb-3">
                                    Delta state election results
                                </h2>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="form-group mb-4">
                                    <label for="lga" class="form-label">
                                        Local Government Area
                                    </label>
                                    <select name="LGA" id="lga" class="form-select">
                                        <option value="">Select LGA</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="wards" class="form-label">
                                        Ward
                                    </label>
                                    <select name="ward" id="wards" class="form-select">
                                        <option value="">Select Ward</option>
                                    </select>
                                </div>
                            
                                <div class="form-group mb-4">
                                    <label for="pollingUnit" class="form-label">
                                        Polling Unit
                                    </label>
                                    <select name="pollingUnit" id="pollingUnit" class="form-select">
                                        <option value="">Select Polling Unit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <h3 id="title">
                                    Election result
                                </h3>
                                <ol id="electionResults">
                                    
                                </ol>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/localgovernments.php?all',
            type: 'get',
            success: function(data) {
                $("#lga").empty();
                $("#lga").append('<option value="">Select LGA</option>');
                $.each(data, function(index, lga) {
                    $('#lga').append('<option id="' + lga.lga_id + '" value="' + lga.lga_id + '"> '+ lga.lga_name + '</option>');
                })
            }
        })
        $('#lga').on('change', function(e) {
            var lga = e.target.value;
            if(lga == "") {
                $("#wards").empty();
                $('#wards').html('<option value=""> Please select ward</option>');
                return false;
            }
            $.get('/wards.php?lga=' + lga, function(data) {
                $('#wards').empty();
                $('#wards').append('<option value="0" disable="true" selected="true">Select Ward</option>');
                $.each(data, function(index, ward) {
                    $('#wards').append('<option id="' + ward.ward_id + '" value="' + ward.ward_id + '"> '+ ward.ward_name + '</option>');
                })
            });
        });
        $('#wards').on('change', function(e) {
            var ward = e.target.value;
            if(ward == "") {
                $("#pollingUnit").empty();
                $('#pollingUnit').html('<option value=""> Select polling unit</option>');
                return false;
            }
            $.get('/polling_unit.php?ward=' + ward, function(data) {
                $('#pollingUnit').empty();
                $('#pollingUnit').append('<option value="0" disable="true" selected="true">Select polling unit</option>');
                $.each(data, function(index, puint) {
                    $('#pollingUnit').append('<option id="' + puint.polling_unit_id + '" value="' + puint.uniqueid + '"> '+ puint.polling_unit_name + '</option>');
                })
            });
        });
        $('#pollingUnit').on('change', function(e) {
            var pollingUnit = e.target.value;
            if(pollingUnit == "") {
                $("#electionResults").empty();
                return false;
            }
            $.ajax({
                url: '/electionResults.php?pollingUnit=' + pollingUnit,
                type: 'get',
                success: function(data) {
                    $('#electionResults').empty();
                    if(data.error) {
                        $('#electionResults').append('<li> Election results for this units are unannounced</li>');
                        return;
                    }
                    $.each(data, function(index, ElectionResults) {
                        $('#electionResults').append('<li> '+ ElectionResults.party_abbreviation + ' ' + ElectionResults.party_score + '</li>');
                    });
                }
            })
        });
    })
</script>

<?php require('./footer.php'); ?>