<?php
/**
 * Upload logo form page
 *
 */

get_template_part('header', 'newsroom'); ?>

    <div class="section default container">
      <div class="container">
      	<?php get_sidebar('profile'); ?>
		<div class="content">

		<div class="article-content">

		<?php echo do_shortcode("[gravityform id='5' name='Profile' title='false' description='false']"); ?>

		</div>	

			<header class="entry-header">
				<h2 id="social-media-connections-title">Social Media Connections</h2>
			</header>


			<div class="entry-content">
<?php if(count($providers)): ?>
				<p>You have connected the services below to About Us.</p	>
				<p>If you wish to disconnect a service, click the corresponding button below.</p>
				<p>Should you wish to change an account used by a service, you can disconnect it, then connect a new service from your <a href="/dash">Dashboard</a>.</p>
				<br />
				<div id="privacy-settings-message" class="hidden">
					<div class="alert">
						
					</div>
				</div>
				<div id="disconnect-buttons" class="well">
<?php foreach($providers as $provider): ?>
					<a data-id="<?php echo $provider->provider_name() ?>" class="btn primary" href="/social-settings?disconnect=<?php echo $provider->provider_name() ?>">Disconnect <?php echo $provider->provider_name() ?></a>
<?php endforeach ?>					
				</div>
<?php else: ?>	
				<p>You have not connected any social media services with your account.</p>
				<p>When you do, you'll be able to disconnect access to your accounts from this page at any time</p>
<?php endif ?>

<button id="back-to-dash">Go to your Dashboard</button>
				</div>
			</div>

		</div>
		
      </div>
      <?php get_footer(); ?>
    </div>
<script>
$(function () {

	$("#upload-image").on('submit', function(e){
		e.preventDefault();
	});



	var messageContainer = $("#privacy-settings-message");
	var message = messageContainer.find('.alert');

	$("#disconnect-buttons").on('click', 'a', function(e){
		e.preventDefault();
		messageContainer.removeClass('hidden');
		message.html('Loading...');
		$.ajax({
			url: $(this).attr('href'),
			success: function(data) {
				message.attr('class', 'alert ' + data.status)
					   .html(data.message);

				if(data.status === 'success') {
					$("#disconnect-buttons").find('a[data-id="' + data.service + '"]').fadeOut(500);
				}
			}
		});
	});

});
</script>

