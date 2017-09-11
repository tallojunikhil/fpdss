<?php
    include 'header.php';
?>
<div class="container">
    <form method="post" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-3">From date :</label>
            <div class="col-sm-4">
                <input class="form-control picker" id="from" name="from_date"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">To Date :</label>
            <div class="col-sm-4">
                <input class="form-control picker" id="to" name="to_date"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4"></div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-4">
                <button type="submit"  class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        function getDates(start, end) {
            var datesArray = [];
            var startDate = new Date(start);
            while (startDate <= end) {
                datesArray.push(new Date(startDate));
                startDate.setDate(startDate.getDate() + 1);
            }
            return datesArray;
        }
        $('#to').on("change",function () {
            var from = $("#from").val();
            var to = $(this).val();
            console.log(getDates(from,to));
        });
    });
</script>