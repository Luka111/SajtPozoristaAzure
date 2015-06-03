<div class = "container" >
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $pozoriste['Naziv']; ?></h1>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-12">
                <a href="<?php echo route_url('pozorista/obrisi/' . $pozoriste['PozID']) ?>"><button type="button" class="btn btn-lg btn-danger">Obriši</button></a>
                <a href="<?php echo route_url('pozorista/izmeni/' . $pozoriste['PozID']) ?>"><button type="button" class="btn btn-lg btn-success">Izmeni</button></a>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="<?php echo display_image('pozorista', $pozoriste['Slika'], '750x450.gif') ?>">
                </a>
            </div>
            <div class="col-md-4">

                <h3><b>Naziv</b>: <?php echo $pozoriste['Naziv']; ?></h3>
                <h3><b>Adresa</b>: <?php echo $pozoriste['Adresa']; ?></h3>
                <h3><b>Email</b>: <?php echo $pozoriste['Email']; ?></h3>
                <h3><b>Telefon</b>: <?php echo $pozoriste['Telefon']; ?></h3>
                <h3><b>Opis</b>: <?php echo $pozoriste['Opis']; ?></h3>

            </div>
            <div class="col-md-2">

                <div class="img-responsive pull-right">
                    <img class="img-responsive" src="<?php echo asset_url('img/200x500.gif') ?>">
                </div>


            </div>

        </div>
        <br>

        <hr>

    </div>
</div>