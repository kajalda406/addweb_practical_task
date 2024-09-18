<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


function codex_car_init(){
    $args = array(
                'public' => true,
                'labels'  => array(
                                'name' => __('Cars'),
                                'edit_item' => __('Edit Car'),
                            ),
                'menu_position' => 5,

                'supports' => array('editor', 'thumbnails', 'title', 'excerpt'),

            );
    register_post_type('car', $args);
    register_taxonomy(
            'make',
            'car',
                array(
                    'labels' => array(
                                    'name' => __('Make Category'),
                                    'singular_name' => __('Make Category'),
                                    'edit_item' => __('Edit Make Category'),
                                    'all_items' => __('All Make Category'),
                                    'update_item' => __('Update Make Category'),
                                    'search_items' => __('Search Make Category'),
                                    'parent_item' => __('Parent Make Category'),
                                    'parent_item_colon' => __('Parent Make Category'),
                                    'add_new_item' => __('New Make Category'),
                                    'new_item_name' => __('New Make Category Name'),
                                    'menu_name' => __('Make'),
                                ),
                    'hierarchical' => true,
                    'rewrite' => array( 'slug' => 'make'),
                    ),
            );

    register_taxonomy(
    'model',
    'car',
        array(
            'labels' => array(
                            'name' => __('Model'),
                            'singular_name' => __('Model'),
                            'edit_item' => __('Edit Model'),
                            'all_items' => __('All Models'),
                            'update_item' => __('Update Model'),
                            'search_items' => __('Search Model'),
                            'parent_item' => __('Parent Model'),
                            'parent_item_colon' => __('Parent Model'),
                            'add_new_item' => __('New Model'),
                            'new_item_name' => __('New Model Name'),
                            'menu_name' => __('Model'),
                        ),
            'hierarchical' => true,
            'rewrite' => array( 'slug' => 'model'),
            ),
    );

    register_taxonomy(
    'year',
    'car',
        array(
            'labels' => array(
                            'name' => __('Year'),
                            'singular_name' => __('Year'),
                            'edit_item' => __('Edit Year'),
                            'all_items' => __('All Years'),
                            'update_item' => __('Update Year'),
                            'search_items' => __('Search Year'),
                            'parent_item' => __('Parent Year'),
                            'parent_item_colon' => __('Parent Year'),
                            'add_new_item' => __('New Year'),
                            'new_item_name' => __('New Year Name'),
                            'menu_name' => __('Year'),
                        ),
            'hierarchical' => true,
            'rewrite' => array( 'slug' => 'Year'),
            ),
    );

    register_taxonomy(
    'fuel_type',
    'car',
        array(
            'labels' => array(
                            'name' => __('Fuel Type'),
                            'singular_name' => __('Fuel Type'),
                            'edit_item' => __('Edit Fuel Type'),
                            'all_items' => __('All Fuel Types'),
                            'update_item' => __('Update Fuel Type'),
                            'search_items' => __('Search Fuel Type'),
                            'parent_item' => __('Parent Fuel Type'),
                            'parent_item_colon' => __('Parent Fuel Type'),
                            'add_new_item' => __('New Fuel Type'),
                            'new_item_name' => __('New Fuel Type Name'),
                            'menu_name' => __('Fuel Type'),
                        ),
            'hierarchical' => true,
            'rewrite' => array( 'slug' => 'fuel_type'),
            ),
    );
}
add_action('init', 'codex_car_init');

// Shortcode for Car Entry Form
function car_entry_form_shortcode() {
    ob_start(); ?>
    
    <form class="form" id="ajax-contact-form" action="#">  

    	<label for="name">Car Name:</label>                          
        <input type="text" name="name" id="name" placeholder="Name" required="">

        <label for="make">Make:</label>
        <select id="make" name="make">
            <?php 
            $makes = get_terms(array('taxonomy' => 'make', 'hide_empty' => false));
            foreach ($makes as $make) {
                echo '<option value="'.$make->term_id.'">'.$make->name.'</option>';
            }
            ?>
        </select>

        <label for="model">Model:</label>
        <select id="model" name="model">
            <?php 
            $models = get_terms(array('taxonomy' => 'model', 'hide_empty' => false));
            foreach ($models as $model) {
                echo '<option value="'.$model->term_id.'">'.$model->name.'</option>';
            }
            ?>
        </select>

        <label for="fuel_type">Fuel Type:</label><br>
        <?php 
        $fuel_types = get_terms(array('taxonomy' => 'fuel_type', 'hide_empty' => false));
        foreach ($fuel_types as $fuel_type) {
            echo '<input type="radio" name="fuel_type" value="'.$fuel_type->term_id.'">'.$fuel_type->name.'<br>';
        }
        ?>

        <button type="submit" class="btn" id="submit">Submit</button>
    </form>
    <div id="response-message"></div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('car_entry', 'car_entry_form_shortcode');

function enqueue_car_entry_scripts() {

    wp_register_script('car-entry-script', get_stylesheet_directory_uri() . '/js/car-form.js', array('jquery'), null, true);

    wp_localize_script('car-entry-script', 'carEntry', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_enqueue_script('car-entry-script');
}
add_action('wp_enqueue_scripts', 'enqueue_car_entry_scripts');


function add_this_script_footer() { ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php } 

add_action('wp_footer', 'add_this_script_footer');


// Handle AJAX request
add_action('wp_ajax_contact_form', 'contact_form');
add_action('wp_ajax_nopriv_contact_form', 'contact_form');

function contact_form() {
    $car_name = sanitize_text_field($_POST['name']);
    $car_make_id = intval($_POST['make']);
    $car_model_id = intval($_POST['model']);
    $car_fuel_type_id = intval($_POST['fuel_type']);

    $car_post_data = array(
        'post_title'  => $car_name,
        'post_type'   => 'car', 
        'post_status' => 'publish', 
    );

    $post_id = wp_insert_post($car_post_data);

    if ($post_id) {

    	if ($car_make_id) {
            wp_set_object_terms($post_id, $car_make_id, 'make'); 
        }
        
        if ($car_model_id) {
            wp_set_object_terms($post_id, $car_model_id, 'model'); 
        }

        if ($car_fuel_type_id) {
            wp_set_object_terms($post_id, $car_fuel_type_id, 'fuel_type'); 
        }
        
        echo esc_html($car_name) . ' has been added as a new car.';
    } else {
        echo 'There was an error creating the car.';
    }

    wp_die(); 
}

// Shortcode for Car List
function car_list_shortcode() {
    
    $args = array(
        'post_type' => 'car',
        'post_status' => 'publish',
        'posts_per_page' => -1, 
    );    
    $cars = new WP_Query($args);
    
    if ($cars->have_posts()) {
        $output = '<ul>'; 

        while ($cars->have_posts()) {
            $cars->the_post();
            
            $make = get_the_term_list(get_the_ID(), 'make', 'Make: ', ', ');
            $model = get_the_term_list(get_the_ID(), 'model', 'Model: ', ', ');
            $year = get_the_term_list(get_the_ID(), 'year', 'Year: ', ', ');
            $fuel_type = get_the_term_list(get_the_ID(), 'fuel_type', 'Fuel Type: ', ', ');

            $output .= '<li>' . esc_html(get_the_title()) . ' - ' . $make . ', ' . $model . ', '. $year . ' , ' . $fuel_type . '</li>';
        }
        
        $output .= '</ul>'; 
        wp_reset_postdata(); 
    } else {
        $output = 'No cars found.'; 
    }

    return $output; 
}
add_shortcode('car-list', 'car_list_shortcode');


