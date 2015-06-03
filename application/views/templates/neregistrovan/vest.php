<div class="container">
    <div class="section">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $vest['Naslov'] ?></h1>
            </div>

        </div>
        <br>

        <div class="row">
            <div class="col-md-6 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="<?php echo display_image('vesti',$vest['Slika'],'750x450.gif')?>">
                </a>
            </div>

            <div class="img-responsive pull-right">
                <img class="img-responsive" src="<?php echo asset_url('img/200x500.gif')?>">
            </div>


        </div>
        <br>
        <div class="row">

            <div class="col-md-8 text-justify">
                <?php echo $vest['Sadrzaj'] ?>

            </div>

            <div class="img-responsive pull-right">
                <img class="img-responsive" src="<?php echo asset_url('img/200x300.gif')?>">
            </div>


        </div>
    </div>
</div>