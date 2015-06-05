<div class="container">
    <div class="section">
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><span class="glyphicon-pencil"></span> Dodavanje kritike za predstavu <?php echo $predstava['Naziv'] ?></h1>
            </div>

        </div>

        <div class="row">

            <?php echo validation_errors(); ?>

            <?php echo form_open('predstave/dodajKritikuSubmit', '', array('PredID' => $predstava['PredID'])) ?>
            <div class="form-group">
                <label for="naslov">Naslov<font color="red"> * </font></label>
                <input type="text" class="form-control" name="naslov" id="naslov" value="<?php echo set_value('naslov'); ?>" maxlength="30">
            </div>
            <div class="form-group">
                <label for="sadrzaj">Sadrzaj<font color="red"> * </font></label>
                <textarea class="form-control" id="sadrzaj" name="sadrzaj" rows="3"><?php echo set_value('sadrzaj'); ?></textarea>
            </div>
            <input type="submit" value="Dodaj" name="button" id="dodajKritiku" class="btn btn-default"/>
            <?php echo form_close() ?>

        </div>

    </div>
</div>
<!-- /.container -->