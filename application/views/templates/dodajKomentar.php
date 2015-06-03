<div class="container">

    <div class="row">

        <div class="col-lg-12">
            <h2 class="page-header">Unesite komentar</h2>
        </div>

    </div>

    <br/>

    <div class="row">
        
        <div id="inputError">
            <?php echo validation_errors(); ?>
        </div><br/>

        <?php echo form_open('predstave/dodajKomentar', '', array('PredID' => $PredID)) ?>
        <div class="form-group">
            <label for="tekst">Tekst <font color="red"> * </font></label>
            <textarea id="tekst" class="form-control" name="tekst" rows="5"></textarea>
        </div>
        <!-- Replacing standard submit with AJAX request
        <input type="submit" value="Dodaj" name="button" id="dodajKomentar" class="button"/>
        -->
        <a id="dodajKomentar" href="#"><button type="button" class="btn btn-warning">Dodaj komentar</button></a>
        <script type="text/javascript">
            $(function(){
            $('#dodajKomentar').on('click', function(e){
                e.preventDefault();
                $.ajax({
                url: '<?php echo route_url('predstave/dodajKomentar') ?>',
                type: 'post',
                data: {
                    'PredID': '<?php echo $PredID ?>',
                    'Tekst': $('#tekst').val()
                },
                success: function(data, status) {
                        if (data.status == "ok"){
                            $('#komentari').append(
                                '<div class = "row comment">' +
                                '<div class = "col-sm-12 comment-content">' +
                                '<p>' + $('#tekst').val() + '</p>' +
                                '</div>' +
                                '<div class = "comment-footer">' +
                                '<div class = "col-sm-8 small-font">' +
                                '<p>' + '<?php echo $Username ?>' + '</p>' +
                                '</div>' +
                                '<div class = "col-sm-4 small-font">' +
                                '<div class = "right-col">' +
                                '<a href="' + '<?php echo route_url('predstave/obrisiKomentar/') ?>' + data.KomID + '/' + '<?php echo $Username ?>' + '/' + '<?php echo $PredID?>' + '"><button type="button" class="btn btn-danger">Obriši</button></a>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            );
                        } else {
                            $('#inputError').append("Field Tekst is required")
                        }
                    },
                error: function(xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                    }
                }); // end ajax call
            });
            });
        </script>
        <?php echo form_close() ?>

    </div>
</div>
<div class="container">