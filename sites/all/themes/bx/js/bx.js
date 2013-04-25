$(function(){
	// validate webforms
	$('.webform-client-form').validate();
	
	/**
	 * content sliders
	 */
	$('#slider .view-content').bxSlider({
		speed:250
	});
	
	var teamSlider = $('#block-views-team_member-block_2 .view-content').bxSlider({
		speed:200
	});
	
	// initiate fancybox
	$('.fancy-trigger').fancybox();
		
	// blog/twitter switch (homepage)
	$('#home-bottom .view-blog li a').click(function() {
		
		// remove all active classes
		$('#home-bottom .view-blog li').removeClass('active');
		
		// apply active class to clicked tab
		$(this).parent().addClass('active');
		
		// if book tab is clicked
		if($(this).parent().attr('id') == 'book-tab'){
			$('#twitter-switch').removeClass('visible');
			$('#blog-switch').removeClass('visible');
			$('#book-switch').addClass('visible');			
		// if blog tab is clicked
		}else if($(this).parent().attr('id') == 'blog-tab'){
			$('#blog-switch').addClass('visible');
			$('#twitter-switch').removeClass('visible');
			$('#book-switch').removeClass('visible');
		// if twitter tab is clicked
		}else if($(this).parent().attr('id') == 'twitter-tab'){
			$('#twitter-switch').addClass('visible');
			$('#blog-switch').removeClass('visible');
			$('#book-switch').removeClass('visible');
		}
		return false;
	});
	
	/**
	 * meet our team
	 */
	// hover over a pic, turns to color	
	var team_color_speed = 200;
	$('#block-views-team_member-block_1 .views-row').hover(function() {
		$(this).find('.team-member-image-color').fadeTo(team_color_speed, 1);
	}, function() {
		$(this).find('.team-member-image-color').stop().fadeTo(team_color_speed, 0);
	});
	
	// click a team member pic
	$('.team-trigger').click(function() {
		var index = $(this).parent().parent().parent().prevAll().length;
		teamSlider.goToSlide(index);
		// this code would never so sloppy if it wasn't for our dinosaur friend IE
		$('#block-views-team_member-block_2 .views-row, #block-views-team_member-block_2 .bx-prev, #block-views-team_member-block_2 .bx-next, #block-views-team_member-block_2 .team-close').fadeTo(0, 0);
		$('#block-views-team_member-block_2').css('left', '0');
		$('#block-views-team_member-block_2 .views-row, #block-views-team_member-block_2 .bx-prev, #block-views-team_member-block_2 .bx-next, #block-views-team_member-block_2 .team-close').fadeTo(500, 1, function(){
			if(jQuery.browser.msie){
				$(this).get(0).style.removeAttribute('filter');
			}
		});
		return false;
	});
	
	// close the full bio
	$('.team-close').click(function() {
		// $('#block-views-team_member-block_2 .views-row').fadeTo(500, 0);
		$('#block-views-team_member-block_2 .views-row, #block-views-team_member-block_2 .bx-prev, #block-views-team_member-block_2 .bx-next, #block-views-team_member-block_2 .team-close').fadeTo(500, 0, function(){
			$('#block-views-team_member-block_2').css('left', '-999999px');
		});
		return false;
	});
	
	// twitter feed
	// if($('#page-front').length > 0){
	// 	$('#twitter-switch .inner').getTwitter({
	// 		userName:'marketwerks',
	// 		showHeading: false,
	// 		numTweets: 1
	// 	})
	// }
	
	// testimonial workaround
	if($('#block-views-testimonials-block_2').length > 0 || $('#block-views-testimonials-block_1').length > 0){
		$('.view-testimonials .views-row').each(function(index) {
		  if($('.views-field-field-testimonial-primary-name-value', $(this)).length == 0){
				$(this).css({'paddingBottom':0, 'borderBottom':0});
			}
		});
	}
	
	/**
	 * reader tools
	 */
	// click a download link
	$('#block-views-reader_tools-block_1 a').click(function(){
		var href = $(this).attr('href');
		// check if the password session has been set
		$.get('/admin/reader-tools/check-session', function(data){
			// if the password session has not been set
			if(data == 'fail'){
				var output = '<div class="password-wrap"><h2>Please enter your Daring Caution password:</h2>'
				output += '<input type="password" id="reader-tools-password" />';
				output += '<div class="password-error">Incorrect password</div>';
				output += '<a href="' + href + '" class="btn-cta" id="reader-tools-password-submit">Submit</a></div>';
				$.fancybox({
					content: output,
					autoDimensions: false,
					width: 500,
					height: 160,
					padding: 0
				});
			// if session has been set
			}else{
				window.location = href;
			}
		});
		return false;
	});
	
	// password submit
	$('#reader-tools-password-submit').live('click', function(event) {
		// get the password
		var password = $('#reader-tools-password').val();
		// get the file location
		var href = $(this).attr('href');
		// check the password
		$.get('/admin/reader-tools/check-password/' + password, function(data){
			// if successful password
			if(data == 'success'){
				// fade out error message
				$('.password-error').fadeOut(200);
				// close the fancybox
				$.fancybox.close();
				// redirect to the file
				window.location = href;
			// if unsuccessful password
			}else{
				// fadeout password error
				$('.password-error').fadeOut(200, function(){
					// fadein password error
					$('.password-error').fadeIn(200);
				});
			}
		});
		return false;
	});
	
	/**
	 * Tweets
	 */

	$.getJSON("https://api.twitter.com/1/statuses/user_timeline/marketwerks.json?count=1&include_rts=1&callback=?", function(data) {
			var twitters = data;
			
				var statusHTML = [];
			  for (var i=0; i<twitters.length; i++){
			    var username = twitters[i].from_user;
			    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
			      return '<a href="'+url+'">'+url+'</a>';
			    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
			      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
			    });
			    statusHTML.push('<li><span>'+status+'</span> <a style="font-size:85%" href="http://twitter.com/'+username+'/statuses/'+twitters[i].id_str+'">'+relative_time(twitters[i].created_at)+'</a></li>');
			  }
				$('#twitter_update_list').html(statusHTML.join(' '));
				// give first list item a special class
				$("ul#twitter_update_list li:first").addClass("firstTweet");
			
				// give last list item a special class
				$("ul#twitter_update_list li:last").addClass("lastTweet");

	});
	
function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}
	
});
