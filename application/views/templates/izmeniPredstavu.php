<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Izmeni predstavu</h1>
            </div>

        </div>

        <br/>

        <div class="row">

            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('predstave/izmeniPredstavu/', '', array('PredID' => $predstava['PredID'])) ?>
            <div class="form-group">
                <label for="naziv">Naziv<font color="red"> * </font></label>
                <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo $predstava['Naziv']; ?>" maxlength="20">
            </div>
            <div class="form-group">
                <label for="pozID">Pozorište<font color="red"> * </font></label>
                <select id="pozID" name="pozID" class="form-control">
                    <?php
                    for ($i = 0; $i < sizeof($pozorista); $i++) {
                        $selected = '';
                        if ($pozorista[$i]['PozID'] === $predstava['PozID'])
                            $selected = ' selected="selected"';
                        echo '<option value="' . $pozorista[$i]['PozID'] . '"' . $selected . '>' . $pozorista[$i]['Naziv'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="glumci">Glumci</label>
                <textarea class="form-control" id="glumci" name="glumci" rows="3"><?php echo $predstava['Glumci']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="reziser">Režiser</label>
                <input type="text" class="form-control" id="reziser" name="reziser" value="<?php echo $predstava['Reziser']; ?>" maxlength="30">
            </div>
            <div class="row">
                <div class="col-md-6 portfolio-item">
                    <div class="form-group">
                        <label for="slika">Nova slika</label>
                        <p><i>(Ako ne izaberete sliku trenutna nece biti promenjena)</i></p>
                        <input type="file" id="slika" name="slika">
                    </div>
                    <input type="submit" value="Izmeni" name="button" id="izmeniPredstavu" class="button"/>
                </div>
                <div class="col-md-6 portfolio-item">
                    <label for="slika">Trenutna slika</label>
                    <a href="#">
                        <img class="img-responsive" src="<?php echo display_image('predstave', $predstava['Slika'], '750x450.gif') ?>">
                    </a>
                </div>
            </div>
            <?php echo form_close() ?>

        </div>
    </div>
</div>