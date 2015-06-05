<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">
                    <span class="glyphicon-cloud"></span> Vesti
                </h1>
            </div>


        </div>

        <?php
        for ($i = 0; $i < sizeof($vesti); $i++) {
            if ($i % 4 === 0) {
                if ($i !== 0) {
                    echo '</div><br/>';
                }
                echo '<div class="row">';
            }
            echo '<div class="col-md-3 portfolio-item">';
            echo '<a href="' . route_url('vesti/vest/') . $vesti[$i]['VestID'] . '">';
            echo '<img class="img-responsive" src="' . display_image('vesti',$vesti[$i]['Slika'],'750x450.gif') . '">';
            echo '<h3>' . $vesti[$i]['Naslov'] . '</h3>';
            echo '</a>';
            echo '</div>';
        }
        if ($i > 0) {
            echo '</div>';
        }
        ?>

    </div>
</div>