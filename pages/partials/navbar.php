<nav class="navbar navbar-expand-md navbar-dark bg-dark" id="nav">
    <a class="navbar-brand" href="<?php asset('/') ?>"><?php translate('name') ?></a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php asset('/') ?>">
                <?php translate('nav.home') ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php asset('/tisch') ?>">
                <?php translate('nav.order') ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php asset('/rechnung') ?>">
                <?php translate('nav.bill') ?>
            </a>
        </li>
    </ul>
    <!-- navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown dropleft">
            <a class="nav-link dropdown-toggle" href="#" id="nav_dd_lang" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <?php translate('lang.lang') ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="nav_dd_lang">
                <a class="dropdown-item" href="<?php asset('/de') ?>">
                    <?php translate('lang.de') ?>
                </a>
                <a class="dropdown-item" href="<?php asset('/en') ?>">
                    <?php translate('lang.en') ?>
                </a>
            </div>
        </li>
    </ul>
</nav>

<div class="menu hidden-sm-down" id="toggleNav">
    <div></div>
</div>

<div class="mobileMenu" id="mobileMenu">
    <nav class="overlay-menu">
        <ul>
            <li><a href="<?php asset('/') ?>"><?php translate('nav.home') ?></a></li>
            <li><a href="<?php asset('/tisch') ?>"><?php translate('nav.order') ?></a></li>
            <li><a href="<?php asset('/rechnung') ?>"><?php translate('nav.bill') ?></a></li>
            <li><a href="<?php asset('/de') ?>"><?php translate('lang.de') ?></a></li>
            <li><a href="<?php asset('/en') ?>"><?php translate('lang.en') ?></a></li>
        </ul>
    </nav>
</div>
