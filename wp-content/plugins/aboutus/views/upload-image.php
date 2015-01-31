<?php
/**
 * Upload image form page
 *
 */

get_template_part('header', 'newsroom'); ?>

    <div class="section default container">
      <div class="container">
      	<?php get_sidebar('profile'); ?>
		<div class="content">

			<header class="entry-header">
				<h1 class="entry-title">Edit Images</h1>
			</header>

			<h3>Logo</h3>
			<div class="entry-content">
				<!-- <p>Upload your business logo here. We'll display it on your profile for customers and other business owners to see.</p>
				<p>Your logo should be JPG or PNG format.<br/><em>Optimal dimensions for your Logo are 220x220px.</em></p> -->
				<p>Upload your business logo to your About Us page here. Click select file, choose your logo then hit the Upload Logo button.<br />
                </p>
                <br />
                <em>You can use JPEG or PNG images. The ideal image size for your logo is 220x220px.</em>
                <br/>

				<div class="upload-wrapper">
					<form id="upload-image" class="upload-image" method="post" action="/upload-image">
						<div class="load-upload-progress">
							<div id="logo-progress" class="progress">
								<div class="bar" style="width: 0%;"></div>
							</div>
						</div>
						<div class="file-upload">
							<span class="btn btn-success fileinput-button">
								<i class="icon-plus icon-white"></i>
								<span>Select file...</span>
								<input id="fileupload" type="file" name="image" data-url="/upload-image">
							</span>
							<span id="logo-upload-filename"></span>
						</div>
						<button id="logo-upload-button" type="submit" class="btn disabled">Upload Logo</button> <span class="logo-upload-message" id="logo-upload-message"></span>
					</form>
					<div id="logo-delete" class="upload-delete-button<?php if($logo): ?> enabled<?php endif ?>" data-url="/upload-image?delete=logo">x</div>
					<div id="logo-preview" class="logo-preview">
						<?php if($logo != ''): ?><img src="<?php echo $logo ?>" alt="Logo" /><?php endif ?>
					</div>
				</div>
			</div>

			<div style="clear: both; padding: 0 0 40px 0;"></div>

			<h3>Background Image</h3>
			<div class="entry-content">
				<!-- <p>You can upload an optional background image to customise your profile. If you upload one, we'll display it as the background when visitors land on your public profile. They will still be able to view the map for your business at any time by clicking the map button.</p>
				<p>Your background should be JPG or PNG format. It must be a large image.<br/>
				</p>-->
				<p>Complete your About Us page with a great background pic. If you have a great shot of your business, upload it here. If you don't have a pic right now, no problem: your About Us page will use a map of your neighbourhood as the default background.</p>
		
				<br />
				<em>You can use JPEG or PNG images. The ideal image size for your background is 1920x1100px.</em>
				<br />
				<div class="upload-wrapper">
					<form id="upload-background" class="upload-image" method="post" action="/upload-image?bg=true">
						<div class="load-upload-progress">
							<div id="background-progress" class="progress">
								<div class="bar" style="width: 0%;"></div>
							</div>
						</div>
						<div class="file-upload">
							<span class="btn btn-success fileinput-button">
								<i class="icon-plus icon-white"></i>
								<span>Select file...</span>
								<input id="fileupload-background" type="file" name="image" data-url="/upload-image?bg=true">
							</span>
							<span id="background-upload-filename"></span>
						</div>
						<button id="background-upload-button" type="submit" class="btn disabled">Upload Background</button> <span class="logo-upload-message" id="background-upload-message"></span>
					</form>
					<div id="background-delete" class="upload-delete-button<?php if($background): ?> enabled<?php endif ?>" data-url="/upload-image?delete=background">x</div>
					<div id="background-preview" class="logo-preview">
						<?php if($background != ''): ?><img src="<?php echo $background ?>" alt="Background" /><?php endif ?>
					</div>
				</div>
			</div>

			<div id="finished-editing"></div>

		</div>
      </div>
    </div>


<?php get_footer();