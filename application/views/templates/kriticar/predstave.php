<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><span class="glyphicon-cloud"></span> Predstave</h1>
            </div>

        </div><br/>

        <?php
        for ($i = 0; $i < sizeof($predstave); $i++) {
            if ($i % 3 === 0) {
                if ($i !== 0) {
                    echo '</div><br/>';
                }
                echo '<div class="row">';
            }
            echo '<div class="col-md-4 portfolio-item">';
            echo '<a href="' . route_url('predstave/predstava/') . $predstave[$i]['PredID'] . '">';
            echo '<img class="img-responsive" src="' . display_image('predstave', $predstave[$i]['Slika'], '750x450.gif') . '">';
            echo '<h3>' . $predstave[$i]['Naziv'] . '</h3>';
            echo '</a>';
            echo '</div>';
        }
        if ($i > 0) {
            echo '</div>';
        }
        ?>

    </div>
</div>