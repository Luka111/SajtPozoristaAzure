<div class="container">
    <div class="section">

        <br/><br/>
        <?php
            if(isset($successEmail)){
                echo "<div>$successEmail</div>";
            }
        ?>
        <h3><a href="<?php echo route_url('admin/listaKorisnika') ?>">Lista korisnika</a></h3><hr>
        <h3><a href="<?php echo route_url('admin/dodajKorisnika') ?>">Dodaj novog korisnika</a></h3><hr>
        <h3><a href="<?php echo route_url('admin/sendEmails') ?>">Posalji E-mail svim pretplacenim korisnicima</a></h3><hr>
        <h2><a style="color:green" href="<?php echo route_url('tests/view') ?>">Testing</a></h2><hr>


    </div>
</div>