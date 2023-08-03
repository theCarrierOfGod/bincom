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
                                    Delta state election results - LGAs
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
                $("#electionResults").empty();
                return false;
            }
            $.ajax({
                url: '/localgovernments.php?votes=' + lga,
                type: 'get',
                success: function(data) {
                    $("#electionResults").empty();
                    $.each(data, function(index, result) {
                        $('#electionResults').append('<li > '+ result.party_abbreviation + ' ' + result.party_score + ' @ polling unit ' + result.polling_unit_uniqueid + '</option>');
                    })
                }
            });
        });
    })
</script>

<?php require('./footer.php'); ?>