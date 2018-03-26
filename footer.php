    </div><!-- .site-content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info">
            <?php
            /**
             * Fires before the Twenty Fifteen footer text for footer customization.
             *
             * @since Twenty Fifteen 1.0
             */
            do_action( 'twentyfifteen_credits' );
            ?>
            Copyright &copy; <?php echo date( 'Y' ); ?> Chenggang Wang | Hosted on <a href="https://m.do.co/c/50614500d0db" target="_blank">Digital Ocean</a>
        </div><!-- .site-info -->
    </footer><!-- .site-footer -->

</div><!-- .site -->
<?php wp_footer(); ?>

</body>
</html>
