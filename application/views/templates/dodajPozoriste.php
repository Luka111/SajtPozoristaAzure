<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Dodaj pozoriste</h1>
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

            <?php echo form_open_multipart('pozorista/dodajPozoriste') ?>
            <div class="form-group">
                <label for="naziv">Naziv <font color="red"> * </font></label>
                <input type="text" id="naziv" name="naziv" value="<?php echo set_value('naziv'); ?>" class="form-control" maxlength="30">
            </div>
            <div class="form-group">
                <label for="adresa">Adresa <font color="red"> * </font></label>
                <input type="text" id="adresa" name="adresa" value="<?php echo set_value('adresa'); ?>" class="form-control" maxlength="40">
            </div>
            <div class="form-group">
                <label for="telefon">Telefon <font color="red"> * </font></label>
                <input type="text" id="telefon" name="telefon" value="<?php echo set_value('telefon'); ?>" class="form-control" pattern="\d*" maxlength="15">
            </div>
            <div class="form-group">
                <label for="email">Email <font color="red"> * </font></label>
                <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" pattern="[^ @]+@[^ @]+.[a-z]+">
            </div>
            <div class="form-group">
                <label for="slika">Slika</label>
                <input type="file" id="slika" name="slika">
            </div>
            <div class="form-group">
                <label for="Opis">Opis <font color="red"> * </font></label>
                <textarea class="form-control" id="opis" name="opis" rows="3"><?php echo set_value('opis'); ?></textarea>
            </div>
            <input type="submit" value="Dodaj" name="button" id="dodajPozoriste" class="button"/>
            <?php echo form_close() ?>

        </div>
    </div>
</div>