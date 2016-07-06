<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Clean Blog
 */

if ( ! function_exists( 'cleanblog_social' ) ) :
/**
 * Adds the social profile links into the theme's footer.php file
 */
function cleanblog_social() { ?>

	<ul class="list-inline text-center">
        <?php if ( get_theme_mod( 'cleanblog_social_linkedin' ) !='' ) { ?>
            <li id="social-linkedin">
                <a href="<?php echo get_theme_mod( 'cleanblog_social_linkedin' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
				</span>
                </a>
            </li>
        <?php } ?>
        <?php if ( get_theme_mod( 'cleanblog_social_wordpress' ) !='' ) { ?>
            <li id="social-github">
                <a href="<?php echo get_theme_mod( 'cleanblog_social_wordpress' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-wordpress fa-stack-1x fa-inverse"></i>
				</span>
                </a>
            </li>
        <?php } ?>
        <?php if ( get_theme_mod( 'cleanblog_social_stackoverflow' ) !='' ) { ?>
            <li id="social-github">
                <a href="<?php echo get_theme_mod( 'cleanblog_social_stackoverflow' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-stack-overflow fa-stack-1x fa-inverse"></i>
				</span>
                </a>
            </li>
        <?php } ?>
        <?php if ( get_theme_mod( 'cleanblog_social_github' ) !='' ) { ?>
            <li id="social-github">
                <a href="<?php echo get_theme_mod( 'cleanblog_social_github' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-github fa-stack-1x fa-inverse"></i>
				</span>
                </a>
            </li>
        <?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_twitter' ) !='' ) { ?>
		<li id="social-twitter">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_twitter' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_facebook' ) !='' ) { ?>
		<li id="social-facebook">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_facebook' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_google' ) !='' ) { ?>
		<li id="social-google">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_google' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-google fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_pinterest' ) !='' ) { ?>
		<li id="social-pinterest">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_pinterest' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_instagram' ) !='' ) { ?>
		<li id="social-instagram">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_instagram' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_medium' ) !='' ) { ?>
		<li id="social-medium">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_medium' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-medium fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_vine' ) !='' ) { ?>
		<li id="social-vine">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_vine' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-vine fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_tumblr' ) !='' ) { ?>
		<li id="social-tumblr">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_tumblr' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-tumblr fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
		<?php if ( get_theme_mod( 'cleanblog_social_youtube' ) !='' ) { ?>
		<li id="social-youtube">
			<a href="<?php echo get_theme_mod( 'cleanblog_social_youtube' ); ?>" target="_blank">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i>
					<i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
				</span>
			</a>
		</li>
		<?php } ?>
	</ul>
<?php }
endif;
