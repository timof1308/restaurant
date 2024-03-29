<?php ob_start(); ?>
<div id="footer">
    <div class="container">
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <h4><?php translate('name') ?></h4>
                    <small class="d-block mb-3 text-muted">&copy; 2018</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Social Media</h5>
                    <ul class="list-unstyled text-small">
                        <li>
                            <a class="text-muted" href="https://facebook.com" target="_blank" id="fb_link">
                                <i class="fab fa-facebook-square"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a class="text-muted" href="https://twitter.com" target="_blank" id="twitter_link">
                                <i class="fab fa-twitter-square"></i> Twitter
                            </a>
                        </li>
                        <li>
                            <a class="text-muted" href="https://instagram.com" target="_blank" id="insta_link">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5><?php translate('footer.help') ?></h5>
                    <ul class="list-unstyled text-small">
                        <li>
                            <?php if (\App\Auth::check()): ?>
                                <a class="text-muted" href="<?php asset('/kueche'); ?>">
                                    <?php echo \App\Auth::name(); ?>
                                </a>
                            <?php else: ?>
                                <a class="text-muted" href="<?php asset('/login'); ?>">Login</a>
                            <?php endif; ?>
                        </li>
                        <li>
                            <a class="text-muted" href="<?php asset('/impressum') ?>">
                                <?php translate('footer.imprint') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</div>
