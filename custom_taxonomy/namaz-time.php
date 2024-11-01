<?php
add_theme_support( 'post-thumbnails', 'namaz-time' );



add_action( 'init', 'tmpray_namaz_time_init', 0 );

if( !function_exists('tmpray_namaz_time_init') ){
    function tmpray_namaz_time_init() {

        $args = array(
            'label'                => 'Namaz Time',
            'public'               => false,
            'register_meta_box_cb' => 'tmpray_namaz_time_metaboxes'
        );
        register_post_type('namaz-time', $args);
        flush_rewrite_rules();


        /**
         * Register a taxonomy for work Categories
         * http://codex.wordpress.org/Function_Reference/register_taxonomy
         */

        $taxonomy_namaz_time_category_labels = array(

        );

        $taxonomy_namaz_time_category_args = array(
            'labels'            => $taxonomy_namaz_time_category_labels,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_tagcloud'     => true,
            'hierarchical'      => true,
            'query_var'         => true,
            'rewrite'           => false,
        );
        register_taxonomy( 'namaz-time-category', array( 'namaz-time' ), $taxonomy_namaz_time_category_args );
    }
}

add_action('add_meta_boxes', 'tmpray_namaz_time_metaboxes');

function tmpray_namaz_time_metaboxes() {
    add_meta_box('month', 'MetaTest-параметры поста',
        'tmpray_namaz_time_metaboxes_callback', 'namaz-time', 'side', 'default');
}

function tmpray_namaz_time_metaboxes_callback($postid) {
    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'namaz-time_fields' );
    // Get the location data if it's already been entered
    $month = get_post_meta( $postid, 'month', true );
    // Output the field
    echo '<input type="month" name="month" value="' . esc_textarea( $month )  . '" class="fl-month-class">';
}



function save_global_notice_meta_box_data( $post_id ) {

    // Check if our nonce is set.
    if ( ! isset( $_POST['month'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['month'], 'month' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    }
    else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Make sure that it is set.
    if ( ! isset( $_POST['month'] ) ) {
        return;
    }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['month'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, '_global_notice', $my_data );
}

add_action( 'save_post', 'save_global_notice_meta_box_data' );



add_filter( 'manage_posts_columns', 'tmpray_add_thumbnail_column', 10, 1 );

if( !function_exists('tmpray_add_thumbnail_column') ){
    function tmpray_add_thumbnail_column( $columns ) {

        $column_thumbnail = array( 'thumbnail' => esc_html__('Thumbnail','tmpray-islamic-helper' ) );
        $columns = array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
        return $columns;
    }
}



add_action( 'manage_posts_custom_column', 'tmpray_display_thumbnail', 10, 1 );

if( !function_exists('tmpray_display_thumbnail') ){
    function tmpray_display_thumbnail( $column ) {
        global $post;
        switch ( $column ) {
            case 'thumbnail':
                echo get_the_post_thumbnail( $post->ID, array(50, 50) );
                break;
        }
    }
}

//Get Month JSON
function tmpray_get_month_json($month){
    $year = date('Y');
    $month_start = 01;
    $day_start = 01;
    $date_from = strtotime($year.'-'.$month_start.'-'.$day_start); // Convert date to a UNIX timestamp

    $month_end = 12;
    $day_end = 31;
    $date_to = strtotime($year.'-'.$month_end.'-'.$day_end); // Convert date to a UNIX timestamp

    $json_date = '';
    $json_date .= '[';

    for ($i = $date_from; $i <= $date_to; $i += 86400) {

        if (date("m", $i) == $month) {
            $json_date .= '{"fajr":"","sunrise":"","dhuhr":"","asr":"","maghrib":"","isha":""},';
        }

    }
    $json_date =rtrim($json_date,',');

    $json_date .= ']';
    return $json_date;
}


//Add JSON Data
function tmpray_add_json_data_proccessing($data, $m){
    $args= array(
        'post_title'    => $m,
        'post_name'   => esc_attr('Namaz Time', 'tmpray-islamic-helper'),
        'post_type'  => 'namaz-time',
        'post_content'  => $data,
        'post_status'   => 'publish',
    );
    wp_insert_post($args);
}

function tmpray_add_json_data_settings(){

    $json_date = '{ "method":"",
                    "asr":"",
                    "midnight":"",
                    "highLats":"",
                    "fajrtune":"",
                    "sunrisetune":"",
                    "dhuhrtune":"",
                    "asrtune":"",
                    "maghribtune":"",
                    "ishatune":"",
                    "latitude":"",
                    "longitude":"",
                    "timezone":""   }';

    $args= array(
        'post_title'    => 'settings',
        'post_name'   => esc_attr('Namaz Time', 'tmpray-islamic-helper'),
        'post_type'  => 'namaz-time',
        'post_content'  => $json_date,
        'post_status'   => 'publish',
    );
    wp_insert_post($args);
}


function tmpray_add_json_data(){
    $args = array(
        'post_type'                 => 'namaz-time',
        'post_status'               => 'publish',
        'posts_per_page'            => -1
    );

    $namaz_month = new WP_Query($args);
    if ($namaz_month->have_posts()) : while ($namaz_month->have_posts()) : $namaz_month->the_post();

        $m = 1;
        while ($m <= 12) {
            if (post_exists($m)==0) {
                $data = tmpray_get_month_json($m);
                tmpray_add_json_data_proccessing($data, $m);
            }
            $m++;
        }

        if(!post_exists('settings')){
            tmpray_add_json_data_settings();
        }

    endwhile; else:

        $m = 1;
        while ($m <= 12) {
            $data = tmpray_get_month_json($m);
            tmpray_add_json_data_proccessing($data, $m);
            $m++;
        }
        if(!post_exists('settings')){
            tmpray_add_json_data_settings();
        }

    endif;

}



