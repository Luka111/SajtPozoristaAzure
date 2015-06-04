<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Izmeni vest</h1>
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

            <?php echo form_open_multipart('vesti/izmeniVest/', '', array('VestID' => $vest['VestID'])) ?>
            <div class="form-group">
                <label for="naslov">Naslov <font color="red"> * </font></label>
                <input type="text" id="naslov" name="naslov" value="<?php echo htmlspecialchars($vest['Naslov']); ?>" class="form-control" maxlength="20">
            </div>
            <div class="form-group">
                <label for="sadrzaj">Sadrzaj <font color="red"> * </font></label>
                <textarea class="form-control" id="sadrzaj" name="sadrzaj" rows="15"><?php echo $vest['Sadrzaj']; ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 portfolio-item">
                    <div class="form-group">
                        <label for="slika">Nova slika</label>
                        <p><i>(Ako ne izaberete sliku trenutna nece biti promenjena)</i></p>
                        <input type="file" id="slika" name="slika">
                    </div>
                    <input type="submit" value="Izmeni" name="button" id="izmeniVest" class="button"/>
                </div>
                <div class="col-md-6 portfolio-item">
                    <label for="slika">Trenutna slika</label>
                    <a href="#">
                        <img class="img-responsive" src="<?php echo display_image('vesti', $vest['Slika'], '750x450.gif') ?>">
                    </a>
                </div>
            </div>

            <?php echo form_close() ?>

        </div>
    </div>
</div>