<?php

function contact_page_theme_support() {
	add_theme_support( 'custom-logo', [
		'height'      => 50,
		'width'       => 84,
		'flex-width'  => false,
		'flex-height' => false,
		'header-text' => '',
	] );

	add_image_size( 'page-image', 629, 466, false );


	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
}

add_action( 'after_setup_theme', 'contact_page_theme_support' );

function enqueue_admin_styles() {
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'plugin-script', get_template_directory_uri() . '/dist/admin.js', array('wp-color-picker'), false, true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles' );

function test_contact_page_scripts() {
	wp_enqueue_style( 'test_contact_page-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'test_contact_page-base-style', get_template_directory_uri() . '/dist/base.css', array( 'test_contact_page-style' ), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'test_contact_page-frontend-script', get_template_directory_uri() . '/dist/frontend.js', array(), wp_get_theme()->get( 'Version' ), true );

	$translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
	wp_localize_script( 'test_contact_page-base-script', 'object_name', $translation_array );
}

add_action( 'wp_enqueue_scripts', 'test_contact_page_scripts' );


/** Customizer */
function test_contact_page_customize_register( $wp_customize ) {

	$transport = 'postMessage';
	$wp_customize->add_panel( 'contacts', [
		'title'    => esc_html__( 'Page Options', 'test_contact_page' ),
		'priority' => 210,
	] );

	$wp_customize->add_section( 'section_form', [
		'title'    => esc_html__( 'New account form', 'test_contact_page' ),
		'priority' => 10,
		'panel'    => 'contacts'
	] );

	/* Main Title */
	$setting = 'mod_main_title';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'This is the main title placed in h1 tag', 'test_contact_page' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_form',
		'label'   => esc_html__( 'Main Title', 'test_contact_page' ),
		'type'    => 'textarea',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.main_title',
	] );


	/* Text after title */
	$setting = 'mod_after_title';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.', 'test_contact_page' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_form',
		'label'   => esc_html__( 'Text after main title', 'test_contact_page' ),
		'type'    => 'textarea',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.after_title',
	] );


	/* Image */
	$setting = 'mod_form_image';
	$wp_customize->add_setting( $setting, [
		'transport' => $transport,
		'width'     => 740
	] );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'feature_product_one_control', array(
		'label'    => esc_html__( 'Image', 'test_contact_page' ),
		'section'  => 'section_form',
		'settings' => 'mod_form_image',
	) ) );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.form_image',
	] );


	/* Form Title */
	$setting = 'mod_form_title';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'If I did it, so can you!', 'test_contact_page' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_form',
		'label'   => esc_html__( 'Form Title', 'test_contact_page' ),
		'type'    => 'textarea',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.form_title h3',
	] );


	/* Form After Title */
	$setting = 'mod_form_after_title';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'Open account', 'test_contact_page' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_form',
		'label'   => esc_html__( 'Sub Title', 'test_contact_page' ),
		'type'    => 'textarea',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.form_after_title h3',
	] );


	/* Form Terms */
	$setting = 'mod_form_terms';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'I agree with all shit that you have proposed me', 'test_contact_page' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_form',
		'label'   => esc_html__( 'Terms Text', 'test_contact_page' ),
		'type'    => 'textarea',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.form_terms',
	] );


	/* Content Section */
	$wp_customize->add_section( 'section_content', [
		'title'    => esc_html__( 'Content section', 'test_contact_page' ),
		'priority' => 11,
		'panel'    => 'contacts'
	] );


	/* Text */
	$setting = 'mod_cont_text';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.', 'test_contact_page' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_content',
		'label'   => esc_html__( 'Text', 'test_contact_page' ),
		'type'    => 'textarea',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.cont_text',
	] );


	/* Button */
	$setting = 'mod_cont_button';
	$wp_customize->add_setting( $setting, [
		'default'           => esc_html__( 'Let’s try it', 'test_contact_page' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => $transport
	] );
	$wp_customize->add_control( $setting, [
		'section' => 'section_content',
		'label'   => esc_html__( 'Button title', 'test_contact_page' ),
		'type'    => 'text',
	] );
	$wp_customize->selective_refresh->add_partial( $setting, [
		'selector' => '.scroll_to',
	] );

}

add_action( 'customize_register', 'test_contact_page_customize_register' );


function slides_register() {

	$labels = array(
		'name'               => esc_attr__( 'Slides', 'test_contact_page' ),
		'singular_name'      => esc_attr__( 'Slide Item', 'test_contact_page' ),
		'add_new'            => esc_attr__( 'Add New', 'test_contact_page' ),
		'add_new_item'       => esc_attr__( 'Add New Slide Item', 'test_contact_page' ),
		'edit_item'          => esc_attr__( 'Edit Slide Item', 'test_contact_page' ),
		'new_item'           => esc_attr__( 'New Slide Item', 'test_contact_page' ),
		'view_item'          => esc_attr__( 'View Slide Item', 'test_contact_page' ),
		'search_items'       => esc_attr__( 'Search Slide Items', 'test_contact_page' ),
		'not_found'          => esc_attr__( 'Nothing Found', 'test_contact_page' ),
		'not_found_in_trash' => esc_attr__( 'Nothing Found in Trash', 'test_contact_page' ),
		'parent_item_colon'  => ''
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' ),
		'rewrite'            => array( 'slug' => 'slides', 'with_front' => false )
	);

	register_post_type( 'slides', $args );
}

add_action( 'init', 'slides_register' );


class slidesMetaBox {
	function __construct( $options ) {
		$this->options = $options;
		$this->prefix  = $this->options['id'] . '_';
		add_action( 'add_meta_boxes', array( &$this, 'create' ) );
		add_action( 'save_post', array( &$this, 'save' ), 1, 2 );
	}

	function create() {
		foreach ( $this->options['post'] as $post_type ) {
			if ( current_user_can( $this->options['cap'] ) ) {
				add_meta_box( $this->options['id'], $this->options['name'], array(
					&$this,
					'fill'
				), $post_type, $this->options['pos'], $this->options['pri'] );
			}
		}
	}

	function fill() {
		global $post;
		$ID = $post->ID;
		wp_nonce_field( $this->options['id'], $this->options['id'] . '_wpnonce', false, true );
		?>
        <table class="form-table">
        <tbody><?php
        foreach ( $this->options['args'] as $param ) {
	        if ( current_user_can( $param['cap'] ) ) {
		        ?>
                <tr><?php

		        $value = get_post_meta( $ID, $this->prefix . $param['id'], true );
		        if ( ! $value && isset( $param['std'] ) ) {
			        $value = $param['std'];
		        }
		        switch ( $param['type'] ) {
			        case 'text':
			        { ?>
                        <th scope="row"><label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
                        </th>
                        <td>
                            <input name="<?php echo $this->prefix . $param['id'] ?>"
                                   type="<?php echo $param['type'] ?>"
                                   id="<?php echo $this->prefix . $param['id'] ?>"
						        <?php echo isset($value) ? 'value="' . $value . '" ' : '' ?>
						        <?php echo isset($param['placeholder']) ? 'placeholder="' . $param['placeholder'] . '" ' : '' ?>
                                   class="regular-text"/><br/>
					        <?php echo isset($param['desc']) ? '<span class="description">' . $param["desc"] . '</span>' : '' ?>
                        </td>
				        <?php
				        break;
			        }
			        case 'textarea':
			        { ?>
                        <th scope="row"><label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
                        </th>
                        <td>
                            <textarea name="<?php echo $this->prefix . $param['id'] ?>"
                                      type="<?php echo $param['type'] ?>"
                                      id="<?php echo $this->prefix . $param['id'] ?>"
                                      <?php echo isset($value) ? 'value="' . $value . '" ' : '' ?>
	                            <?php echo isset($param['placeholder']) ? 'placeholder="' . $param['placeholder'] . '" ' : '' ?>
                                      class="large-text"/><?php echo isset($value) ? $value : '' ?></textarea>
                            <br/>
					        <?php echo isset($param['desc']) ? '<span class="description">' . $param["desc"] . '</span>' : '' ?>
                        </td>
				        <?php
				        break;
			        }
			        case 'color':
			        { ?>
                        <th scope="row"><label for="<?php echo $this->prefix . $param['id'] ?>"><?php echo $param['title'] ?></label>
                        </th>
                        <td>
                            <label for="<?php echo $this->prefix . $param['id'] ?>"><input
                                        name="<?php echo $this->prefix . $param['id'] ?>"
                                        type="<?php echo $param['type'] ?>"
                                        id="<?php echo $this->prefix . $param['id'] ?>"
							        <?php echo isset($value) ? 'value="' . $value . '" ' : '' ?>/>
						        <?php echo isset($param['desc']) ? '<span class="description">' . $param["desc"] . '</span>' : '' ?>
                            </label>
                        </td>
				        <?php
				        break;
			        }
		        }
		        ?></tr><?php
	        }
        }
        ?></tbody></table><?php
	}

	function save( $post_id, $post ) {
		if ( isset($_POST[ $this->options['id'] . '_wpnonce' ]) && ! wp_verify_nonce( $_POST[ $this->options['id'] . '_wpnonce' ], $this->options['id'] ) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		if ( ! in_array( $post->post_type, $this->options['post'] ) ) {
			return;
		}
		foreach ( $this->options['args'] as $param ) {
			if ( current_user_can( $param['cap'] ) ) {
				if ( isset( $_POST[ $this->prefix . $param['id'] ] ) && trim( $_POST[ $this->prefix . $param['id'] ] ) ) {
					update_post_meta( $post_id, $this->prefix . $param['id'], trim( $_POST[ $this->prefix . $param['id'] ] ) );
				} else {
					delete_post_meta( $post_id, $this->prefix . $param['id'] );
				}
			}
		}
	}
}

$options = array(
	array(
		'id'   => 'slides_meta',
		'name' => 'Custom Properties',
		'post' => array( 'slides' ),
		'pos'  => 'normal',
		'pri'  => 'high',
		'cap'  => 'edit_posts',
		'args' => array(
			array(
				'id'    => 'color',
				'title' => 'Color',
				'type'  => 'color',
				'cap'   => 'edit_posts'
			),
			array(
				'id'          => 'title',
				'title'       => 'Secondary Title',
				'type'        => 'text',
				'cap'         => 'edit_posts'
			),
			array(
				'id'          => 'description',
				'title'       => 'Description',
				'type'        => 'textarea',
				'cap'         => 'edit_posts'
			)
		)
	),
);

foreach ( $options as $option ) {
	$slidesmetabox = new slidesMetaBox( $option );
}


