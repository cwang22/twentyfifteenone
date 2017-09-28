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
			&copy; seewang <?php echo date('Y'); ?>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .site -->
<?php wp_footer(); ?>

</body>
</html>
