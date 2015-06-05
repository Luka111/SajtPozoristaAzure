<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><span class="glyphicon-pencil"></span> Dodaj predstavu za pozoriste - <?php echo $NazivPozorista ?></h1>
            </div>

        </div>

        <br/>

        <div class="row">

            <?php echo validation_errors(); ?>

            <?php
            if (isset($error)) {
                echo "<div>$error</div>";
            }
            ?>

            <?php echo form_open_multipart('predstave/dodajPredstavu','',array('pozID' => $PozID)) ?>
            <div class="form-group">
                <label for="naziv">Naziv<font color="red"> * </font></label>
                <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo set_value('naziv'); ?>" maxlength="20">
            </div>
            <div class="form-group">
                <label for="glumci">Glumci</label>
                <textarea class="form-control" id="glumci" name="glumci" rows="3"><?php echo set_value('glumci'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="reziser">Režiser</label>
                <input type="text" class="form-control" id="reziser" name="reziser" value="<?php echo set_value('reziser'); ?>" maxlength="30">
            </div>
            <div class="form-group">
                <label for="slika">Slika</label>
                <input type="file" id="slika" name="slika">
            </div>
            <input type="submit" value="Dodaj" name="button" id="dodajPredstavu" class="button"/>
            <?php echo form_close() ?>

        </div>
    </div>
</div>