<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo route_url('') ?>">Sajt Pozorišta</a>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo route_url('admin/view') ?>">Admin panel</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dodaj<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo route_url('pozorista/dodaj')?>">Dodaj pozorište</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo route_url('vesti/dodaj')?>">Dodaj vest</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo route_url('vesti/view') ?>">Vesti</a>
                </li>
                <li><a href="<?php echo route_url('pozorista/view')?>">Pozorišta</a>
                </li>
                <li><a href="<?php echo route_url('login/logout') ?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>