<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><span class="glyphicon-cloud"></span> Pozorista</h1>
            </div>

        </div>
        <div class="row">

            <div class="col-lg-12">
                <a href="<?php echo route_url('pozorista/dodaj') ?>"><button type="button" class="btn btn-lg btn-primary">Dodaj</button></a>
            </div>

        </div><br/>

        <?php
        for ($i = 0; $i < sizeof($pozorista); $i++) {
            if ($i % 3 === 0) {
                if ($i !== 0) {
                    echo '</div><br/>';
                }
                echo '<div class="row">';
            }
            echo '<div class="col-md-4 portfolio-item">';
            echo '<a href="' . route_url('pozorista/pozoriste/') . $pozorista[$i]['PozID'] . '">';
            echo '<img class="img-responsive" src="' . display_image('pozorista', $pozorista[$i]['Slika'], '750x450.gif') . '">';
            echo '<h3>' . $pozorista[$i]['Naziv'] . '</h3>';
            echo '</a>';
            echo '</div>';
        }
        if ($i > 0) {
            echo '</div>';
        }
        ?>

    </div>
</div>