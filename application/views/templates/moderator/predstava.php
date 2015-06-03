<div class = "container" >
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $predstava['Naziv']; ?></h1>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-12">
                <a href="<?php echo route_url('predstave/obrisi/' . $predstava['PredID']) ?>"><button type="button" class="btn btn-lg btn-danger">Obriši</button></a>
                <a href="<?php echo route_url('predstave/izmeni/' . $predstava['PredID']) ?>"><button type="button" class="btn btn-lg btn-success">Izmeni</button></a>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="<?php echo display_image('predstave', $predstava['Slika'], '750x450.gif') ?>">
                </a>
            </div>
            <div class="col-md-4">

                <h3><b>Glumci</b>: <?php echo $predstava['Glumci']; ?></h3>
                <h3><b>Reziser</b>: <?php echo $predstava['Reziser']; ?></h3>
                <h3><b>Pozoriste</b>: <?php echo '<a href="' . route_url('pozorista/pozoriste/' . $predstava['PozID']) . '">' . $nazivPozorista . '</a>'; ?></h3>

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