
<div class="col-md-5">

    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">Komentari</h1>
        </div>

    </div>

    <div id="komentari">
        <?php
        foreach ($komentari as $komentar) {
            echo '<div class = "row comment">';
            echo '<div class = "col-sm-12 comment-content">';
            echo '<p>' . $komentar['Tekst'] . '</p>';
            echo '</div>';
            echo '<div class = "comment-footer">';
            echo '<div class = "col-sm-8 small-font">';
            echo '<p>' . $komentar['Username'] . '</p>';
            echo '</div>';
            echo '<div class = "col-sm-4 small-font">';
            echo '<div class = "right-col">';
            if ((checkPermission(array('moderator', 'admin'), $Role)) || $Username === $komentar['Username']) {
                echo '<a href="' . route_url('predstave/obrisiKomentar/') . $komentar['KomID'] . '/' . $komentar['Username'] . '/' . $PredID . '"><button type="button" class="btn btn-danger">Obriši</button></a>';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

</div>