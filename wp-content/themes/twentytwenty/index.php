<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php

	$archive_title    = '';
	$archive_subtitle = '';

	if (is_search()) {
		global $wp_query;

		$archive_title = sprintf(
			'%1$s %2$s',
			'<span class="color-accent">' . __('Search:', 'twentytwenty') . '</span>',
			'&ldquo;' . get_search_query() . '&rdquo;'
		);

		if ($wp_query->found_posts) {
			$archive_subtitle = sprintf(
				/* translators: %s: Number of search results. */
				_n(
					'We found %s result for your search.',
					'We found %s results for your search.',
					$wp_query->found_posts,
					'twentytwenty'
				),
				number_format_i18n($wp_query->found_posts)
			);
		} else {
			$archive_subtitle = __('We could not find any results for your search. You can give it another try through the search form below.', 'twentytwenty');
		}
	} elseif (is_archive() && !have_posts()) {
		$archive_title = __('Nothing Found', 'twentytwenty');
	} elseif (!is_home()) {
		$archive_title    = get_the_archive_title();
		$archive_subtitle = get_the_archive_description();
	}

	if ($archive_title || $archive_subtitle) {
	?>

		<header class="archive-header has-text-align-center header-footer-group">

			<div class="archive-header-inner section-inner medium">

				<?php if ($archive_title) { ?>
					<h1 class="archive-title"><?php echo wp_kses_post($archive_title); ?></h1>
				<?php } ?>

				<?php if ($archive_subtitle) { ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
				<?php } ?>

			</div><!-- .archive-header-inner -->

		</header><!-- .archive-header -->

	<?php
	}



	if (have_posts()) {

		if (is_search()) {
			while (have_posts()) {

				if (have_posts()) {
					the_post();
					// l???y b??i vi???t.
					$_post = get_post();

					// l???y ti??u ????? b??i vi???t.
					$_new_string_title = $_post->post_title;

					// l???y ng??y-th??ng-n??m c???a b??i vi???t.
					$_new_post_date = $_post->post_date;
					$time = strtotime($_new_post_date);
					$new_format = date('Y-m-d', $time);
					$_explode = explode("-", $new_format);
					$_day = $_explode[2];
					$_month = $_explode[1];
					$_year = $_explode[0];

					// l???y n???i dung ch??nh b??i vi???t.
					$_new_string_content = substr(
						$_post->post_content,
						strpos($_post->post_content, "<!-- wp:paragraph -->"),
						strpos($_post->post_content, "<!-- /wp:paragraph -->")
					);

					// l???y ???nh b??i vi???t.
					// $_new_string_image = substr(
					// 	$_post->post_content,
					// 	strpos($_post->post_content, "<!-- wp:image -->"),
					// 	strpos($_post->post_content, "<!-- /wp:image -->")
					// );
					// Get post content:
					$content = $_post->post_content;
					preg_match('/src="([^"]*)"/', $content, $matches);
					preg_match('/(?<!_)src=([\'"])?(.*?)\\1/', $content, $matches);
					$post_img_element = "";
					if (count($matches) != 0) {
						$post_img_element = "<img $matches[0]>";
					}

					// l???y ???????ng d???n ?????n trang chi ti???t b??i vi???t.
					// $_new_string_guid = $_post->guid;
					$_new_string_guid = get_permalink();

					// hi???n th??? n???i dung ch???nh s???a theo y??u c???u.
					echo "
					<div class='list_new_view'>
						<div class='row vu-class-center'>
							<div class='col-md-7 top_news_block_desc'>
								<div class='row'>
									<div class='col-md-4 col-xs-4'>
										$post_img_element	
									</div>
									<div class='col-md-2 col-xs-2 topnewstime'>
										<span class='topnewsdate'>$_day</span><br>
										<span class='topnewsmonth'>Th??ng $_month</span><br>
									</div>
									<div class='col-md-6 col-xs-6 shortdesc'>
										<h4>
											<a href='$_new_string_guid'>$_new_string_title</a>
										</h4>
										$_new_string_content <a href='$_new_string_guid'>[...]</a>
									</div>
			
								</div>
							</div>
						</div>
					</div>
					";
				}
			}
		} else {
			while (have_posts()) {

				if (have_posts()) {
					the_post();
					// l???y b??i vi???t.
					$_post = get_post();

					// l???y ti??u ????? b??i vi???t.
					$_new_string_title = $_post->post_title;

					// l???y ng??y-th??ng-n??m c???a b??i vi???t.
					$_new_post_date = $_post->post_date;
					$time = strtotime($_new_post_date);
					$new_format = date('Y-m-d', $time);
					$_explode = explode("-", $new_format);
					$_day = $_explode[2];
					$_month = $_explode[1];
					$_year = $_explode[0];

					// l???y n???i dung ch??nh b??i vi???t.
					$_new_string_content = substr(
						$_post->post_content,
						strpos($_post->post_content, "<!-- wp:paragraph -->"),
						strpos($_post->post_content, "<!-- /wp:paragraph -->")
					);

					// l???y ???nh b??i vi???t.
					$_new_string_image = substr(
						$_post->post_content,
						strpos($_post->post_content, "<!-- wp:image -->"),
						strpos($_post->post_content, "<!-- /wp:image -->")
					);

					// l???y ???????ng d???n ?????n trang chi ti???t b??i vi???t.
					// $_new_string_guid = $_post->guid;
					$_new_string_guid = get_permalink();

					// hi???n th??? n???i dung ch???nh s???a theo y??u c???u.
					echo "
					<div class='list_new_view'>
						<div class='row vu-class-center'>
							<div class='col-md-7 top_news_block_desc'>
								<div class='row'>
									<div class='col-md-3 col-xs-3 topnewstime'>
										<span class='topnewsdate'>$_day</span><br>
										<span class='topnewsmonth'>Th??ng $_month</span><br>
									</div>
									<div class='col-md-9 col-xs-9 shortdesc'>
										<h4>
											<a href='$_new_string_guid'>$_new_string_title</a>
										</h4>
										$_new_string_content <a href='$_new_string_guid'>[...]</a>
									</div>
			
								</div>
							</div>
						</div>
					</div>
					";
				}
			}
		}
	} elseif (is_search()) {
	?>

		<div class="no-search-results-form section-inner thin search-wap">

			<?php
			get_search_form(
				array(
					'aria_label' => __('search again', 'twentytwenty'),
				)
			);
			?>

		</div><!-- .no-search-results -->

	<?php
	}
	?>

	<?php get_template_part('template-parts/pagination'); ?>

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
