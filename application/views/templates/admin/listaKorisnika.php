<div class="container">
    <div class="section">

        <div class="col-md-6">
            
            <?php
            foreach($korisnici as $korisnik){
                echo '<h3>';
                echo $korisnik['Username'];
                echo ' [' . $korisnik['Role'] . ']';
                echo '<a href="' . route_url('admin/obrisiKorisnika/') . $korisnik['Username'] . '">';
                echo '<button type="button" class="btn btn-danger right-col">Obriši</button>';
                echo '</a>';
                echo '</h3>';
                echo '<hr>';
            }
            ?>       
            
          </div>
        
    </div>
</div>