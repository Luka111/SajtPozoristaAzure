<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Izmeni pozoriste</h1>
            </div>

        </div>

        <br/>

        <div class="row">

            <?php echo validation_errors(); ?>

            <?php echo form_open_multipart('pozorista/izmeniPozoriste/', '', array('PozID' => $pozoriste['PozID'])) ?>
            <div class="form-group">
                <label for="naziv">Naziv<font color="red"> * </font></label>
                <input type="text" class="form-control" name="naziv" id="naziv" value="<?php echo htmlspecialchars($pozoriste['Naziv']); ?>" maxlength="30">
            </div>
             <div class="form-group">
                <label for="adresa">Adresa <font color="red"> * </font></label>
                <input type="text" id="adresa" name="adresa" value="<?php echo htmlspecialchars($pozoriste['Adresa']); ?>" class="form-control" maxlength="40">
            </div>
            <div class="form-group">
                <label for="telefon">Telefon <font color="red"> * </font></label>
                <input type="text" id="telefon" name="telefon" value="<?php echo htmlspecialchars($pozoriste['Telefon']); ?>" class="form-control" pattern="\d*" maxlength="15">
            </div>
            <div class="form-group">
                <label for="email">Email <font color="red"> * </font></label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($pozoriste['Email']); ?>" class="form-control" pattern="[^ @]+@[^ @]+.[a-z]+">
            </div>
            <div class="form-group">
                <label for="Opis">Opis <font color="red"> * </font></label>
                <textarea class="form-control" id="opis" name="opis" rows="3"><?php echo $pozoriste['Opis']; ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 portfolio-item">
                    <div class="form-group">
                        <label for="slika">Nova slika</label>
                        <p><i>(Ako ne izaberete sliku trenutna nece biti promenjena)</i></p>
                        <input type="file" id="slika" name="slika">
                    </div>
                    <input type="submit" value="Izmeni" name="button" id="izmeniPozoriste" class="button"/>
                </div>
                <div class="col-md-6 portfolio-item">
                    <label for="slika">Trenutna slika</label>
                    <a href="#">
                        <img class="img-responsive" src="<?php echo display_image('pozorista', $pozoriste['Slika'], '750x450.gif') ?>">
                    </a>
                </div>
            </div>
            <?php echo form_close() ?>

        </div>
    </div>
</div>