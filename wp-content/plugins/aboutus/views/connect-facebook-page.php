<?php $pages = $fb->getPages(); if(count($pages)): ?>
	<p>Select the Facebook business page to link to your About Us account.<p>
	<form method="post" action="/connect-facebook-page" id="connect-facebook-page-form" class="form-horizontal">
		<select name="page_id">
<?php foreach($pages as $page): ?>
			<option value="<?php echo $page['id'] ?>"><?php echo $page['name'] ?></option>
<?php endforeach ?>	
			<option value="">Do not connect a Facebook Business page</option>
		</select>
		<input type="submit" class="btn" value="Save">
		<span class="message"></span>
	</form>
<script type="text/javascript">
$("#connect-facebook-page-form").on('submit', function(e){
	e.preventDefault();
	$("#connect-facebook-page-form").find('.btn')
		.val('Saving...')
		.addClass('disabled')
		.attr('disabled', 'disabled');
	$.ajax({
		url: $(this).attr('action'),
		data: $(this).serialize(),
		success: function(data) {
			$("#connect-facebook-page-modal").modal('hide');
			//window.location = '/dash';
		}
	});
});
</script>
<?php else: ?>
	<p>Great, you have connected your personal Facebook account to About Us.<p>
	<p>The next step is to set up a Facebook page for your business.<br />You can find out more about how do that here:<br />
	<a href="https://www.facebook.com/business/build"  target="_blank">How to create a Facebook business page</a><br /><p>
	<p>When you're ready, you can set up the page here:<br /><a href="https://www.facebook.com/pages/create/" target="_blank">Create a page</a></p>
<?php endif ?>