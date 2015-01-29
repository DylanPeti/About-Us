




// TODO ##

// NATIVE STYLE ON AJAX LOAD POSTS
// REARRANGE HEIGHT ON NEW POST SECTION

// API V3 LOGIN ALTERNATIVE. LEAVE LOGGED OUT, MAKE USER OPTION IS STASHED IN CONTROLLER + FIND CONTROLLER. 

// AJAX IE VERSION SORT 



jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);
	
	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;
	
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('.adder')
			.append('<div class="pbd-alp-placeholder-'+ pageNum + ' one left-section masonry" id="filter-container" style="-webkit-column-count: 3; -moz-column-count: 3; column-count: 3;"></div>')
			.append('<p id="pbd-alp-load-posts"><a href="#">Load More Posts</a></p>');
			
		// Remove the traditional navigation.
		// $('.navigation').remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#pbd-alp-load-posts a').click(function() {
	
		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$(this).text('Loading posts...');
			
			$('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .bottom-section-one',
				function() {
					// Update page number and nextLink.
					pageNum++;
					nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
				
					
					// Add a new placeholder, for when user clicks again.
					$('#pbd-alp-load-posts')
						.before('<div class="pbd-alp-placeholder-'+ pageNum + 'one left-section masonry" id="filter-container" style="-webkit-column-count: 3; -moz-column-count: 3; column-count: 3;></div>')
					
					// Update the button message.
					if(pageNum <= max) {
						$('#pbd-alp-load-posts a').text('Load More Posts');
					} else {
						//$('#pbd-alp-load-posts a').text('No more posts to load.');
						$('#pbd-alp-load-posts').remove();
					}
				}
			);
		} else {
			$('#pbd-alp-load-posts a').append('.');
		}	
		
		return false;
	});
});
