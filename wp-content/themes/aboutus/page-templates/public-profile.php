<?php
/**
 * Template Name: Public Profile
 * Not used anymore
 */

get_header(); ?>

	<div id="profile-primary" class="site-content">
		<div class="bus-intro">
			<h1 id="business-name" class="logo" style="background: url(<?php echo get_template_directory_uri(); ?>/images/logo-chorus.png) no-repeat;">Chorus</h1>
			<p class="tagline">Welcome to your fibre future</p>
		</div>

		<div class="promo">
			<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/promo.png" /></a>
		</div>

		<div class="contact-details">
			<div class="oneoftwo">
				<div class="address">
					level 8<br>
					Datacom House<br>
					68 - 86 Jervois Quay<br>
					Wellington
				</div>
				<a href="#" class="btn map-btn">View map</a>
			</div>

			<div class="twooftwo">
				<div class="phone">0800 222 638</div>
				<a href="#" class="btn email-btn">Email us</a>
				<a href="#" class="btn skype-btn">Skype us</a>
				<a href="#" class="weblink" target="_blank">Visit our website</a>
			</div>
		</div>

		<div class="follow-links">
			<h2>Follow us</h2>
			<ul>
				<li class="twitter-btn"><a href="#">Twitter</a></li>
				<li class="facebook-btn"><a href="#">Facebook</a></li>
				<li class="youtube-btn"><a href="#">Youtube</a></li>
				<li class="google-btn"><a href="#">GooglePlus</a></li>
				<li class="linkedIN-btn"><a href="#">linkedIN</a></li>
			</ul>
		</div>

		<div class="summary">
			<p>Our name says a lot. It describes a large group performing in concert. It’s about working in harmony; each of us playing our part in achieving what we set out to achieve. We don’t make a song and dance about it. We’re in the background providing the support that helps connect New Zealanders with each other – and the world.</p>
		</div>

		<div class="promo2">
			<a href="#"><img src="#" /></a>
		</div>
	</div><!-- #profile-primary -->

<?php get_footer(); ?>