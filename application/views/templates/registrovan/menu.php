<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo route_url('')?>">Sajt Pozorišta</a>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo route_url('vesti/view')?>">Vesti</a>
                </li>
                <li><a href="<?php echo route_url('pozorista/view')?>">Pozorišta</a>
                </li>
                <li><a href="<?php echo route_url('login/logout')?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>