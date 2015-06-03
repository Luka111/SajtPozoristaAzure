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
            echo '<h1>';
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
