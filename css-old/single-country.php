<?php
/**
 * The template for displaying Category pages
 *
 * 
 *
 * @package WordPress
 * @subpackage Telstra-child
 * @since Twenty Thirteen 1.0
 */
get_header();

?>

<?php while ( have_posts() ) : the_post(); ?>

            <h1><?php the_field('custom_title'); ?></h1>

    <?php endwhile; // end of the loop.  ?>
        <?php
            $category_id = !empty(wp_get_post_categories(get_the_ID())) ? reset( wp_get_post_categories(get_the_ID()) ) : 0;
            $category = get_category($category_id); 
            $postCountry = get_post(get_the_ID());
                if ($category_id === 10) {
    ?>

        <section id="heroindustry" class="hero-image">
            <?php
                $file = get_field("header_video", get_the_ID());
                $filetype = wp_check_filetype($file);
            ?>  
            <div class="background">
	            <!-- <?php if ($filetype['ext'] == 'png' || $filetype['ext'] == 'jpg') { ?>
	               <img src="<?php echo get_field("header_video", get_the_ID()); ?>" alt="" />
	            <?php }else{ ?>
	                <video autoplay muted loop>
	                    <source src="<?php echo get_field("header_video", get_the_ID()); ?>" type="video/mp4">
	                </video>
	            <?php } ?> -->
                <img src="<?php the_field('city_hero');  ?>">
            </div>

            <div class="container">
                <div id="browse-menu-bar" class='browse-menu' style='opacity: 1;'>
                    <div class="bar-content-wrapper">
                        <div class="browse-trigger">
                            <div class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <span>Browse</span>
                        </div>
                        <nav id="browse-main-menu" class='browse-menu-main'>
                            <?php echo wp_nav_menu(array(
                                'container' => 'ul',
                                'menu' => '3',
                                'menu_id' => 'new-main-menu'
                            )); ?>
                        </nav>
                    </div>
                </div>
                <div class="nav-button-wrapper">
                    <a href="<?php echo get_site_url() ;?>/article/connecting-commerce" class="nav-button">Connecting Commerce
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="10" height="10" viewBox="0 0 10 10">
                        <defs>
                            <style>
                            .cls-1, .cls-2 {
                                font-size: 14px;
                            }

                            .cls-2 {
                                fill: #fefefe;
                                font-family: "CenturyGothic-Bold";
                                font-weight: bold;
                            }
                            </style>
                        </defs>
                        <text transform="translate(-2 10) scale(0.99 0.99)" class="cls-1"><tspan class="cls-2">▼</tspan></text>
                        </svg>
                    </a>
                    <a href="<?php echo get_site_url() ;?>/article/connecting-capabilities/" class="nav-button">Connecting Capabilities</a>
                    <a href="<?php echo get_site_url() ;?>/article/connecting-companies/" class="nav-button">Connecting Companies</a>
                </div>

                <div class="animation-element bounce-up header-content-wrapper">
                    <div class='header-text-wrapper-article bg-none'>
											<div class="hero-top-title subject delay-2 text-left text-uppercase">
													<h3 class="text-uppercase bold"><?php echo isset($category) ? $category->name : ''; ?></h3>
											</div>
											<div class="hero-title animation-element bounce-up">
                        <h1 class="subject delay-1"><?php the_field('city_name', get_the_ID()); ?></h1>
                    	</div>
											<div class="hero-subtitle subject delay-2 text-left">
											<div class="violet-separator"></div>
													<p class="margin-top-20 subheading"><?php the_field('city_subheading'); ?></p>
													<div class="cta-wrapper">
															<?php if(get_field('city_pdf')) : ?>
																	<a href="<?php echo get_field("city_pdf",get_the_ID()); ?>" class="margin-top-20 article-cta download-pdf" download>Download PDF <span class="cta-arrow">></span></a>
															<?php endif ?>
															<?php if(get_field('city_xls')) : ?>
																	<a href="<?php echo get_field("city_xls",get_the_ID()); ?>" class="margin-top-20 article-cta download-xls" download>Download XLS <span class="cta-arrow">></span></a>
															<?php endif ?>
													</div>
                            
                    	</div>
										
											</div>
		
											<div class="telstra-logo-article subject">
													<a href="#" onclick="" class="text-left">
															<p class="text-black">DEVELOPED BY</p>
															<img width="135" class="text-left" src="<?php echo get_field("featured_logo",get_the_ID()); ?>" alt="" />
													</a>
											</div>  
                    
          
								
							</div>
        </section>                

        <div class="social-button">
                <?php dynamic_sidebar( 'mobile-social' ); ?>
        </div>

        <section id="section-1" class="white-section">
					<!-- start here -->
					<div class="article-wrapper container">
						<?php if ( !empty( get_field("article_image_content_1",get_the_ID()) || get_field("article_content_beside_image_1",get_the_ID()) ) ) : ?>
							<div class="row">
								<div class='left-image'>
									<div class="flex-item-wrapper">
										<div class="img-wrap">
											<img src="<?php echo get_field("article_image_content_1",get_the_ID()); ?>" alt="">
										</div>
									</div>
									<div class="flex-item-wrapper">
										<div class="text-wrap">
											<p class='article-heading'><?php echo get_field("article_heading_beside_image_1",get_the_ID()); ?></p>
											<p class='article-content'><?php the_field("article_content_beside_image_1",get_the_ID()); ?></p>
										</div>
									</div>
								</div>
							<?php endif; ?>
								<?php if( !empty( get_field('second_article_content_subheading') && get_field('second_article_content'))) :?>
									<div class="row text-left">
										<div class="col-md-12">
											<p class="article-subheading"><?php the_field('second_article_content_subheading', get_the_ID()); ?></p>
											<p class="article-content"><?php the_field('second_article_content', get_the_ID()); ?></p>
										</div>
									</div>
								<?php endif; ?>
								<?php if ( !empty( get_field("article_graph_image",get_the_ID()) ) ) : ?>
									<div class="row">
										<div class="graph">
											<div class="col-md-12">
												<div class="img-wrap">
													<img src="<?php echo get_field("article_graph_image",get_the_ID()); ?>" alt="">
												</div>
											</div>
										</div>
									</div>
								 <?php endif; ?>
								 
								 <?php if ( !empty( get_field("mid_article_content",get_the_ID()) ) ) : ?>
										<div class="row">
											<div class="col-md-12">
												<div class="text-wrap">
													<p class="article-subheading"><?php the_field('mid_article_subheading', get_the_ID()); ?></p>
													<p class="article-content"><?php echo get_field("mid_article_content",get_the_ID()); ?></p>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if ( !empty( get_field("article_image_content_2",get_the_ID()) || get_field("article_heading_beside_image_2",get_the_ID()) ) ) : ?>
									<div class="row">
										<div class='right-image'>
										<div class="flex-item-wrapper">
												<div class="text-wrap">
													<p class='article-content'><?php the_field("article_heading_beside_image_2",get_the_ID()); ?></p>
												</div>
											</div>
											<div class="flex-item-wrapper">
												<div class="img-wrap">
													<img src="<?php echo get_field("article_image_content_2",get_the_ID()); ?>" alt="">
												</div>
											</div>
										</div>
							<?php endif; ?>
				
							</div>
					
						<?php if ( !empty(get_field("file_upload",get_the_ID())) && !empty(get_field("title_download",get_the_ID())) && !empty(get_field("download_description",get_the_ID())) ) { ?>
						<div class="row download-btn-wrapper">
							<div class="col-md-12">
								<h1 class="margin-bottom-10"><?php echo get_field("title_download",get_the_ID()); ?></h1>
								<p><?php echo get_field("download_description",get_the_ID()); ?></p>
								<a href="<?php echo get_field("file_upload",get_the_ID()); ?>" class="btn margin-top-20" download>Download PDF <span class="btn-arrow"></span></a>
							</div>
						</div>
						<?php } ?>
						<div class="row back-to-top-wrapper">
							<div class="col-md-12 scrollup">
								<a href="" class="margin-top-20  scrollup">Back To Top</a>
							</div>
						</div>
					</div>
					</div>
					<!--  -->
					
						
        </section>
        <section id="section-2" class="gray-section related-content">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="text-wrap">
                            <h4 class="text-blue text-left text-uppercase">Related Content</h4>
                        </div>
                        <div class="article-carousel multiple-items">
                            <?php
                                $featured_post_ids = array();
                                $featured_query = new WP_Query( array(
                                    'category__in' => 10, 
                                    'posts_per_page' => 12,
                                    'post_type' => 'country'
                                ));

                                if ( $featured_query->have_posts() ) { 
                                    while ( $featured_query->have_posts() ) { 
                                        $featured_query->the_post();
                                        $featured_post_ids[] = get_the_ID();
                                        $category_id = !empty(wp_get_post_categories(get_the_ID())) ? reset( wp_get_post_categories(get_the_ID()) ) : 0;
                                        $category = get_category($category_id); 
                                    ?>   
                                <div class="slick-item">
                                    <div class="slick-item-wrapper">
                                        <a href="<?php the_permalink(); ?> " >
                                            <?php
                                                if(!empty(get_post_thumbnail_id())){ 
                                                    $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true); 
                                            ?>
                                            <img class="margin-bottom-20 box-shadow" src="<?php echo reset($thumb_url_array); ?>">
                                            <?php } ?>
                                        </a>
                                            <div class="image-wrapper">
                                            	<img src="<?php echo get_field("featured_logo",get_the_ID()); ?>" alt="">
                                            </div>
                                        <p class="subheading bold text-black margin-bottom-10">
                                            <?php echo isset($category) ? $category->name : ''; ?>
                                        </p>
                                        	<a href="<?php the_permalink(); ?>"><p class="text-violet"><?php the_title(); ?></p></a>
                                        <p class="subheading bold text-black margin-bottom-10">
                                            <?php echo get_field("article_description",get_the_ID()); ?>
                                        </p>
                                    </div>
                                </div>


                            <?php      
                                    }
                                }
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } else { ?>
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">

                <header class="page-header">
                    <h1 class="page-title"><?php _e( 'Not Found', 'Telstra-child' ); ?></h1>
                </header>

                <div class="page-wrapper">
                    <div class="page-content">
                        <h2><?php _e( 'This is somewhat embarrassing, isn’t it?', 'Telstra-child' ); ?></h2>
                        <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'Telstra-child' ); ?></p>

                        <?php get_search_form(); ?>
                    </div><!-- .page-content -->
                </div><!-- .page-wrapper -->

            </div><!-- #content -->
        </div><!-- #primary -->

        <?php }  ?>
<?php get_footer(); ?>