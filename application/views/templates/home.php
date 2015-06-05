<div id="myCarousel" class="carousel slide">

    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-indicators" style="top:60px; opacity:0.95;">
        <h1>Aktuelne predstave</h1>
    </div>
    <div class="carousel-inner">
        <?php
        //echo print_r($predstave);
        for ($i = 0; $i < sizeof($predstave); $i++) {
            echo '<div class="item' . ($i == 0 ? ' active' : '') . '">';
            echo '<a href="' . route_url('predstave/predstava/' . $predstave[$i]['PredID']) . '">';
            echo '<div class="fill" style="background-image:url(' . display_image('predstave', $predstave[$i]['Slika'], '1900x1080.gif') . ');"></div>';
            echo '</a>';
            echo '<div class="carousel-caption">';
            echo '<h1 style="z-index:16;">';
            echo $predstave[$i]['Naziv'];
            echo '</h1>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>
<div class="container">
    <div class="col-md-7">
        <br/><br/><br/>
        <h3>
            Činjenica je da su sve veće predstave rasprodate najmanje mesec dana pre
            njihovog izvođenja što pokazuje da kultura i nije toliko zapostavljena i da bi ovaj servis
            mogao biti više od školskog projekta.
        </h3>
    </div>
    <div class="col-md-5">
        <br/>
        <img class="img-responsive" src="<?php echo display_image('icons', 'theater-icon.png', '750x450.gif') ?>">
            
    </div>
    <div class="col-md-4">
        <br/>
        <img class="img-responsive" src="<?php echo display_image('icons', 'comments-icon.png', '750x450.gif') ?>">
    </div>
    <div class="col-md-offset-1 col-md-7">
        <br/>
        <h3>
            Gosti ovog servisa imaju mogućnost da pregledaju
            pozorišta, vesti, predstave koje se tamo održavaju kao i komentare vezane za njih. Osim
            toga registrovani korisnici imaju mogućnost da pregledaju profesionalne kritike u vezi
            željenjih predstava kao i da odaberu da li žele da primaju email-ove o aktuelnim
            predstavama.
        </h3>
    </div>
</div>
