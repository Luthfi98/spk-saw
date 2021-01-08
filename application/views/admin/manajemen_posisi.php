<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary panel-line">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Manajemen <?= $title ?>
                </h3>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body" id="posisi">
                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script>
    $(document).ready(function(){
        $.ajax({
            url: base+"getPosisiMenu",
            type: "POST",
            dataType: "JSON",
            success: function(response){
                $("#posisi").html(response);
            }
        });

    });
</script>
