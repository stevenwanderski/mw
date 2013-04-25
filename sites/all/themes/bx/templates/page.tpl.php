<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <?php print $head ?>
    <?php print $styles ?>
		<?php print $scripts ?>
    <title><?php print $head_title ?></title>
		<meta name="google-site-verification"	content="tsAFRG-_AZyTFoOf5I8ZdHMl3aM2xVNvOVW1Gy7UJ2M" />
		<meta name="verify-v1" content="4FT4/f9JrF4k3WNW2novsqGEW4bhQzrtYFd0qnmalbQ=" />
  </head>
  <body<?php print phptemplate_body_attributes($is_front, $layout); ?>>

	<div id='page' class="<?php if($node){ print "page-node-" . $node->nid; } ?>"><div class='limiter clear-block'>		
		
		<!-- header -->
		<?php if ($header): ?>
	    <div id='header'><div class='limiter clear-block inner'>
	      <?php print $header; ?>
	    </div></div>
	  <?php endif; ?>
	
		<!-- messages -->
	  <?php if ($help || ($show_messages && $messages)): ?>
	    <div id='console'><div class='limiter clear-block'>
	      <?php print $help; ?>
	      <?php if ($show_messages && $messages): print $messages; endif; ?>
	    </div></div>
	  <?php endif; ?>
		
		<!-- sidebar left -->
    <?php if ($left): ?>
      <div id='left' class='clear-block'><?php print $left ?></div>
    <?php endif; ?>

    <div id='main' class='clear-block'>
	
				<?php if ($tabs) print $tabs ?>
	      <?php if ($tabs2) print $tabs2 ?>
	
				<!-- if "solutions" interior page -->
				<?php if(preg_match('/^solutions\/.+/', $node->path)): ?>
	
					<div id="content-top"><div class="inner">
						<div class="content-top-value">
							<?php if ($title): ?><h1 class='page-title'><?php print $title ?></h1><?php endif; ?>
							<?php print $node->field_page_content_top[0]['value'] ?>
						</div>
					</div></div>
					
	        <div id='content' class='clear-block solutions-content'>
						<?php if($node->field_page_header_image[0]['filepath']): ?>
							<div class="header-image"><img src="/<?php print $node->field_page_header_image[0]['filepath'] ?>" /></div>
						<?php endif; ?>
						<?php print $content ?>
					</div>
					
					<!-- if "pricing optimization" page, print slider view -->
					<?php	if($node->nid == 9): ?>
							<div id="slider">
							<?php print views_embed_view('slider'); ?>
							</div>
					<?php endif; ?>
	
				<!-- if "services" interior page -->
				<?php elseif(preg_match('/^services\/.+/', $node->path)): ?>
					
					<div id="content-top"><div class="inner">
						<div class="content-top-value">
							<?php if ($title): ?><h1 class='page-title'><?php print $title ?></h1><?php endif; ?>
							<?php print $node->field_page_content_top[0]['value'] ?>
						</div>
					</div></div>
					
	        <div id='content' class='clear-block services-content'>
						<?php if($node->field_page_header_image[0]['filepath']): ?>
							<div class="header-image"><img src="/<?php print $node->field_page_header_image[0]['filepath'] ?>" /></div>
						<?php endif; ?>
						<?php print $content ?>
					</div>
					
					<!-- if "pricing optimization" page, print slider view -->
					<?php	if($node->nid == 9): ?>
							<div id="slider">
							<?php print views_embed_view('slider'); ?>
							</div>
					<?php endif; ?>
	        
				<!-- all other pages -->
				<?php else: ?>
										
					<div id="content-top"><div class="inner">
						<div class="content-top-value">
							
							<!-- if blog content type -->
							<?php if ($node->type == 'blog'): ?>
								<div class="blog-post-date"><?php print date('F j, Y', $node->field_blog_datestamp[0]['value']) ?></div>
							<?php endif; ?>
							
							<!-- if blog landing page -->
							<?php if(preg_match('/^\/blog$/', $_SERVER['REQUEST_URI'])): ?>
								<h1 class='page-title'><?php print variable_get('blog_landing_title_data', ''); ?></h1>
							<?php else: ?>
								<?php if ($title): ?><h1 class='page-title'><?php print $title ?></h1><?php endif; ?>
							<?php endif; ?>
							<!-- end if blog landing page -->
							
							<?php if($is_front): ?>
								<a href="/online-store" class="book-link"></a>
							<?php endif; ?>
							
							<?php print $node->field_page_content_top[0]['value'] ?>
						</div>
						<?php if($node->field_page_header_image[0]['filepath']): ?>
							<div class="header-image"><img src="/<?php print $node->field_page_header_image[0]['filepath'] ?>" /></div>
						<?php endif; ?>
						<div class="clear"></div>
					</div></div>

        	<?php if(!$is_front): ?>
		        <div id='content' class='clear-block'>
		        	<?php print $content ?>
		        </div>
		      <?php endif; ?>

					<!-- "services" blocks -->
					<?php if ($service_blocks): ?>
						<div id="service-blocks" class="clearfix">
							<?php print $service_blocks; ?>
							<div class="clear"></div>
						</div>
					<?php endif; ?>				

				<?php endif; ?>
				
				<?php if($content_bottom): ?>
					<div id="content-bottom"><div class="inner">
						<?php print $content_bottom; ?>
						<div class="clear"></div>
					</div></div>
				<?php endif; ?>
				
				<!-- sidebar right -->
		    <?php if ($right): ?>
		      <div id='right' class='clear-block'><?php print $right ?></div>
		    <?php endif; ?>
		
				<div class="clear"></div>

    </div>

		<div class="clear"></div>
		
  </div></div>

	<!-- home bottom -->
  <?php if ($home_bottom): ?>
    <div id='home-bottom' class='clear-block'><div id="home-bottom-inner" class="clearfix"><?php print $home_bottom ?></div></div>
  <?php endif; ?>

	<!-- footer -->
	<div id="footer"><div class='limiter clear-block inner'>
    <?php print $footer ?>
  </div></div>

	<?php	if($is_front): ?>
			<div style="display:none;"><div id="home-video"><?php print variable_get('homepage_video_code_data', ''); ?></div></div>
	<?php endif; ?>
	
	<?php if($hidden): ?>
		<div style="display:none;">
			<?php print $hidden ?>
		</div>
	<?php endif; ?>

  <?php print $closure ?>
	
	<!-- google analytics code -->
	<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-7635873-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
		'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
		})();

	</script>

  </body>
</html>
