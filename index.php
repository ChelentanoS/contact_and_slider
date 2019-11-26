<?php get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">


            <div id="slides">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
						<?php
						$temp     = $wp_query;
						$args     = array(
							'post_type'      => 'slides',
							'orderby'        => 'date',
							'order'          => 'ASC',
							'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
							'posts_per_page' => - 1
						);
						$wp_query = new WP_Query( $args );

						if ( have_posts() ) : while ( $wp_query->have_posts() ) :
							$wp_query->the_post();
							?>

                            <div class="swiper-slide" style="background-color: <?php echo get_post_meta( $post->ID, 'slides_meta_color', true ); ?>">
								<?php the_post_thumbnail( 'full', array( 'alt' => '', 'title' => '' ) ); ?>
                                <div class="slide_cont_wrapper">
                                    <div class="secondary_title"><?php echo get_post_meta( $post->ID, 'slides_meta_title', true ); ?></div>
                                    <div class="description"><?php echo get_post_meta( $post->ID, 'slides_meta_description', true ); ?></div>
                                </div>
                            </div>


						<?php endwhile; else: ?>
						<?php endif;
						wp_reset_query();
						$wp_query = $temp;

						?>
                    </div>
                </div>
            </div>


			<?php
			$main_title       = get_theme_mod( 'mod_main_title', esc_html__( 'This is the main title placed in h1 tag', 'test_contact_page' ) );
			$after_title      = get_theme_mod( 'mod_after_title', esc_html__( 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.', 'test_contact_page' ) );
			$form_title       = get_theme_mod( 'mod_form_title', esc_html__( 'If I did it, so can you!', 'test_contact_page' ) );
			$form_image       = get_theme_mod( 'mod_form_image' );
			$form_image_id    = attachment_url_to_postid( $form_image );
			$form_image_new   = wp_get_attachment_image( $form_image_id, 'page-image' );
			$form_after_title = get_theme_mod( 'mod_form_after_title', esc_html__( 'Open account', 'test_contact_page' ) );
			$form_terms       = get_theme_mod( 'mod_form_terms', esc_html__( 'I agree with all shit that you have proposed me', 'test_contact_page' ) );
			$cont_text        = get_theme_mod( 'mod_cont_text', esc_html__( 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.', 'test_contact_page' ) );
			$cont_button      = get_theme_mod( 'mod_cont_button', esc_html__( 'Let’s try it', 'test_contact_page' ) );

			?>

            <div id="row-contact">
                <div class="container">
                    <div class="rows">
                        <div class="coll-left">
                            <h1><?php echo $main_title; ?></h1>
                            <div class="wrap_with_bg">
                                <div class="after_title"><?php echo $after_title; ?></div>
                            </div>
                        </div>
                        <div class="coll-center">
                            <div class="form_image">
								<?php echo $form_image_new; ?>
                            </div>
                        </div>
                        <div class="сoll-right">
                            <div class="wrap_with_bg">
                                <div class="form_title"><h3><?php echo $form_title; ?></h3></div>
                                <div class="form_after_title"><h3><?php echo $form_after_title; ?></h3></div>
                                <form>
                                    <div class="form_row">
                                        <input type="text" name="name" id="contact_name" placeholder="Full name"/>
                                    </div>
                                    <div class="form_row">
                                        <input type="email" name="email" id="contact_email" placeholder="E-mail"/>
                                    </div>
                                    <div class="form_row">
                                        <label for="contact_tel">+345</label>
                                        <input type="tel" name="tel" id="contact_tel"/>
                                    </div>
                                    <div class="form_row">
                                        <select name="country" id="contact_country">
                                            <option value="default" selected>Select country</option>
                                            <option value="ua">Ukraine</option>
                                            <option value="us">United States of America</option>
                                            <option value="gb">Great Britain</option>
                                        </select>
                                        <div class="select_icon"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                    <input id="submit" type="submit"
                                           value="<?php esc_attr_e( 'Register Here', 'test_contact_page' ); ?>"/>
                                    <div class="form_row flex-row">
                                        <span class="img_terms"></span>
                                        <input type="checkbox" name="terms" id="contact_terms">
                                        <label class="form_terms" for="contact_terms"><?php echo $form_terms; ?></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="row-content">
                <div class="container">
                    <div class="wrapper_content">
                        <div class="content-side">
                            <p class="cont_text"><?php echo $cont_text; ?></p>
                        </div>
                        <div class="button-side">
                            <a class="scroll_to" href="#"><?php echo $cont_button; ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php



            /*if ( have_posts() ) {
	            the_content();
            }

            wp_link_pages(
	            array(
		            'before' => '<div class="page-links">' . __( 'Pages:', 'test_contact_page' ),
		            'after'  => '</div>',
	            )
            );*/
            ?>
            ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();
