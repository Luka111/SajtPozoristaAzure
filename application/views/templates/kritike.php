<div class="col-sm-offset-2 col-md-5">

    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">Kritike
                <?php
                if (checkPermission(array('admin', 'kriticar'), $Role)) {
                    echo '<a href="' . route_url('predstave/dodajKritiku/') . $PredID . '"><button type="button" class="btn btn-lg btn-primary">Dodaj kritiku</button></a> ';
                }
                ?>
            </h1>
        </div>

    </div>

    <?php
    foreach ($kritike as $kritika) {
        echo '<h3><a href="' . route_url('predstave/kritika/' . $kritika['KritID'] . '/' . $PredID) . '">' . $kritika['Naslov'] . '</a> <small> ' . $kritika['Username'] . '</small></h3><hr>';
    }
    ?>


</div>
</div>