<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><span class="glyphicon-pencil"></span> Dodaj vest</h1>
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

            <?php echo form_open_multipart('vesti/dodajVest') ?>
            <div class="form-group">
                <label for="naslov">Naslov <font color="red"> * </font></label>
                <input type="text" id="naslov" name="naslov" value="<?php echo set_value('naslov'); ?>" class="form-control" maxlength="20">
            </div>
            <div class="form-group">
                <label for="sadrzaj">Sadrzaj <font color="red"> * </font></label>
                <textarea class="form-control" id="sadrzaj" name="sadrzaj" rows="3"><?php echo set_value('sadrzaj'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="slika">Slika</label>
                <input type="file" id="slika" name="slika">
            </div>
            <input type="submit" value="Dodaj" name="button" id="dodajVest" class="button"/>
            <?php echo form_close() ?>

        </div>
    </div>
</div>