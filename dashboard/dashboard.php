<?php

class TMPRAY_DASHBOARD{

    const DASHBOARD_DIRECTORY_URI = '/dashboard/';
    const DASHBOARD_DIRECTORY = '/dashboard/';


    public function __construct(){

        $this->dashboard_init_data();
        $this->dashboard_init_action();
        $this->dashboard_init_menu_action();
        add_action( 'admin_init', array($this, 'dashboard_install_plugin_init' ));
    }

    public $plugin_path;
    public $plugin_url;
    public $plugin_name;

    public function dashboard_init_data(){

        $this->plugin_path      = plugin_dir_path(__FILE__);
        $this->plugin_url       = plugin_dir_url(__FILE__);
        $this->dashboard_dir    = (dirname(__FILE__)) . self::DASHBOARD_DIRECTORY;
        $theme_info             = wp_get_theme();
        $theme_parent           = $theme_info->parent();
        if(!empty($theme_parent)) {
            $theme_info         = $theme_parent;
        }

        $this->theme_name       = $theme_info['Name'];
        $this->theme_version    = $theme_info['Version'];
        $this->theme_slug       = $theme_info['Slug'];
        $this->theme_is_child   = !empty($theme_parent);
        $this->theme_slug       = $theme_info->get_stylesheet();
        $this->dashboard_slug   = 'theme-dashboard';
        $this->tgmslug          = 'theme-plugin-install';



        $this->strings = array(
            'subscribe_text'                        => esc_html__('Subscribe Us', 'tmpray-islamic-helper'),
            'support_text'                          => esc_html__('Get Support', 'tmpray-islamic-helper'),
            'theme_text'                            => esc_html__('Plugin Link ', 'tmpray-islamic-helper'),
            'theme_link'                            => esc_url('https://tm-colors.com/praytime/'),
            'subscribe_link'                        => esc_url('https://codecanyon.net//user/tm_colors/follow'),
            'support_link'                          => esc_url('https://codecanyon.net/user/tm_colors/#contact'),
            'documentation_text'                    => esc_html__('Documentation', 'tmpray-islamic-helper'),
            'documentation_link'                    => esc_url('https://tm-colors.com/documentation/praytime/documentation.html'),
            'preview_link'                          => esc_url('https://tm-colors.com/praytime/'),
            'widget_support_title'                  => esc_html__('Get Support', 'tmpray-islamic-helper'),
            'widget_support_text1'                  => esc_html__('If you did not find the question interest in our documentation, found an error, or if you want to suggest something, you can contact technical support.', 'tmpray-islamic-helper'),
            'widget_requirements_title'             => esc_html__('Requirements', 'tmpray-islamic-helper'),
            'widget_requirements_problems'          => esc_html__('Some Problems', 'tmpray-islamic-helper'),
            'widget_requirements_noproblems'        => esc_html__('No Problems', 'tmpray-islamic-helper'),
            'widget_more_info_text'                 => esc_html__('More Info', 'tmpray-islamic-helper'),
            'footer_thank_you'                      => esc_html__('Thank you for choosing %s!', 'tmpray-islamic-helper'),
            'widget_demoimport_header_install_on'   => esc_html__('' . $this->theme_name . ' Demo Install', 'tmpray-islamic-helper'),


        );


    }

    public function let_to_num ($size) {
        $l   = substr( $size, -1 );
        $ret = substr( $size, 0, -1 );
        switch ( strtoupper( $l ) ) {
            case 'P': $ret *= 1024;
            case 'T': $ret *= 1024;
            case 'G': $ret *= 1024;
            case 'M': $ret *= 1024;
            case 'K': $ret *= 1024;
        }
        return $ret;
    }



    public function dashboard_admin_init () {
        $this->plugin_path              = plugin_dir_path(__FILE__);
        $this->plugin_url               = plugin_dir_url(__FILE__);

        $data                           = get_plugin_data(__FILE__);
        $this->plugin_name              = $data['Name'];
        $this->plugin_version           = $data['Version'];
        $this->plugin_description       = $data['Description'];

        $this->plugin_slug              = plugin_basename(__FILE__, '.php');
        $this->plugin_name_sanitized    = basename(__FILE__, '.php');


        $this->theme_s = get_locale();

        $this->updater();

    }

    public function dashboard_init_action(){
        if (is_admin()){
            add_action('admin_print_styles', array($this, 'dashboard_print_styles'));
            add_action('admin_print_scripts', array($this, 'dashboard_print_scripts'));
        }
    }

    public function dashboard_print_styles(){
        wp_enqueue_style('tmpray_dashboard_css', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->theme_version);
        wp_enqueue_style('tmpray_dashboard_css');
    }

    public function dashboard_print_scripts(){

        wp_enqueue_script('tmpray_uichoose', plugin_dir_url( __FILE__ ) . 'js/ui-choose.js', array('jquery'), null, false);
        wp_enqueue_script('tmpray_xlsx', plugin_dir_url( __FILE__ ) . 'js/xlsx.full.min.js', array(), $this->theme_version);

        wp_enqueue_script('tmpray_jsoneditor', plugin_dir_url( __FILE__ ) . 'js/jsoneditor.js', array('jquery'), $this->theme_version);
        wp_enqueue_script('tmpray_praytimes', plugin_dir_url( __FILE__ ) . 'js/PrayTimes.js', array(), $this->theme_version);

        wp_register_script( 'tmpray_googlemaps-api', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDBuVQgQSnzG2ngl4hzn-A00IIhYVk8RaE');
        wp_print_scripts( 'tmpray_googlemaps-api' );

        wp_enqueue_script('tmpray_geocomplete', plugin_dir_url( __FILE__ ) . 'js/jquery.geocomplete.js', array(), $this->theme_version);


        wp_enqueue_script('tmpray_scripts', plugin_dir_url( __FILE__ ) . 'js/scripts.js', array('jquery'), $this->theme_version);
        wp_localize_script( 'tmpray_scripts', 'namazTime', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        ) );


        wp_enqueue_script('jquery-ui-spinner');
        wp_enqueue_script('jquery-ui-button');
        wp_enqueue_script('jquery-ui-menu');
        wp_enqueue_script('jquery-ui-autocomplete');

    }

    public function dashboard_init_menu_action(){
        add_action('admin_menu', array($this, 'dashboard_admin_menu'));
    }

    public function dashboard_admin_menu(){
        call_user_func(
            'add_menu_page',
            __('Pray Time', 'tmpray-islamic-helper'),
            __('Pray Time', 'tmpray-islamic-helper'),
            'edit_theme_options',
            'tmpray_'.$this->dashboard_slug,
            array($this, 'dashboard_print_welcome'),
            'dashicons-dashboard-icon-tmpray',
            3);

        call_user_func(
            'add_submenu_page',
            'tmpray_'.$this->dashboard_slug,
            __('Shortcodes', 'tmpray-islamic-helper'),
            __('Shortcodes', 'tmpray-islamic-helper'),
            'edit_theme_options',
            'tmpray_shortcodes',
            array($this, 'dashboard_print_shortcodes')
        );

    }

    public function dashboard_print_welcome(){
        require_once (dirname(__FILE__).'/general.php');
    }


    public function dashboard_print_shortcodes(){
        require_once(dirname(__FILE__) . '/pages/shortcodes.php');
    }

    public function dashboard_install_plugin_init() {
        if ( isset( $_GET['tmpray-plugin-deactivate'] ) && 'deactivate-plugin' == $_GET['tmpray-plugin-deactivate'] ) {
            check_admin_referer( 'tmpray-plugin-deactivate', 'tmpray-plugin-deactivate-nonce' );

            $plugins = TGM_Plugin_Activation::$instance->plugins;

            foreach ( $plugins as $plugin ) {
                if ( $plugin['slug'] == $_GET['plugin'] ) {
                    deactivate_plugins( $plugin['file_path'] );
                }
            }
        }
        if ( isset( $_GET['tmpray-plugin-activate'] ) && 'activate-plugin' == $_GET['tmpray-plugin-activate'] ) {
            check_admin_referer( 'tmpray-plugin-activate', 'tmpray-plugin-activate-nonce' );

            $plugins = TGM_Plugin_Activation::$instance->plugins;

            foreach ( $plugins as $plugin ) {
                if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
                    activate_plugin( $plugin['file_path'] );

                    wp_redirect( admin_url( 'admin.php?page=tmpray_plugin--install' ) );
                    exit;
                }
            }
        }
    }
};

function tmpray_dashboard(){
    return new TMPRAY_DASHBOARD();
}

tmpray_dashboard();


add_action( 'wp_ajax_nopriv_tmpray_process_namaz', 'tmpray_process_namaz' );
add_action( 'wp_ajax_tmpray_process_namaz', 'tmpray_process_namaz' );
function tmpray_process_namaz(){
    return wp_json_encode($_REQUEST['namaz']);
    wp_die();
}

add_action( 'wp_ajax_nopriv_tmpray_save_namaz_time', 'tmpray_save_namaz_time' );
add_action( 'wp_ajax_tmpray_save_namaz_time', 'tmpray_save_namaz_time' );
function tmpray_save_namaz_time(){

    if (isset($_REQUEST['content']) && $_REQUEST['content']!='' && isset($_REQUEST['title']) && $_REQUEST['title']!='') {

        $check_title = get_page_by_title(esc_attr($_REQUEST['title']), 'OBJECT', 'namaz-time');

        if (!empty($check_title) && $check_title !=''){
            $args = array(
                'ID' =>  $check_title->ID,
                'post_name'   => esc_attr('Namaz Time', 'tmpray-islamic-helper'),
                'post_title'    => sanitize_title($_REQUEST['title']),
                'post_content'  => sanitize_text_field($_REQUEST['content']),
                'post_status'   => 'publish',
                'post_type'  => 'namaz-time'
            );

            wp_update_post($args);

        }
    }

    $check_title_settings = get_page_by_title('settings', 'OBJECT', 'namaz-time');

    if (!empty($check_title_settings) && $check_title_settings !=''){
        $args = array(
            'ID' =>  $check_title_settings->ID,
            'post_name'   => esc_attr('Namaz Time', 'tmpray-islamic-helper'),
            'post_title'    => 'settings',
            'post_status'   => sanitize_option($_REQUEST['fillmethod']),
            'post_type'  => 'namaz-time'
        );

        wp_update_post($args);
    }

    wp_die();
}

add_action( 'wp_ajax_nopriv_tmpray_get_json_namaz', 'tmpray_get_json_namaz' );
add_action( 'wp_ajax_tmpray_get_json_namaz', 'tmpray_get_json_namaz' );
function tmpray_get_json_namaz(){

    if(isset($_REQUEST['title']) && $_REQUEST['title']!=''){

        $namaz_month = get_page_by_title( esc_attr($_REQUEST['title']), OBJECT, 'namaz-time' );

        echo $namaz_month->post_content;

    }

    wp_die();
}

function tmpray_get_json_namaz_html($month){
    if(isset($month) && $month!=''){

        $namaz_month = get_page_by_title( $month, OBJECT, 'namaz-time' );

        return $namaz_month->post_content;

    }

    wp_die();
}



add_action( 'wp_ajax_nopriv_tmpray_get_days_in_month', 'tmpray_get_days_in_month' );
add_action( 'wp_ajax_tmpray_get_days_in_month', 'tmpray_get_days_in_month' );
function tmpray_get_days_in_month(){
    if(isset($_REQUEST['title']) && $_REQUEST['title']!=''){
        $days_in_month = json_decode(tmpray_get_month_json($_REQUEST['title']), true);
        $result = '<div class="tmpray--days-container">';
        $result .= '<div class="tmpray--days-row tmpray--head">';
        $result .= esc_html__('Days', 'tmpray-islamic-helper');
        $result .= '</div>';
        foreach ($days_in_month as $value => $item){
            $result .= '<div class="tmpray--days-row">';
            $result .= $value+1;
            $result .= '</div>';
        }
        $result .= '</div>';
        echo $result;
    }

    wp_die();
}

function tmpray_get_days_in_month_html($month){
    if(isset($month) && $month!=''){
        $days_in_month = json_decode(tmpray_get_month_json($month), true);
        $result = '<div class="tmpray--days-container">';
        $result .= '<div class="tmpray--days-row tmpray--head">';
        $result .= esc_html__('Days', 'tmpray-islamic-helper');
        $result .= '</div>';
        foreach ($days_in_month as $value => $item){
            $result .= '<div class="tmpray--days-row">';
            $result .= $value+1;
            $result .= '</div>';
        }
        $result .= '</div>';
        return $result;
    }

    wp_die();
}

add_action( 'wp_ajax_nopriv_tmpray_method_namaz', 'tmpray_method_namaz' );
add_action( 'wp_ajax_tmpray_method_namaz', 'tmpray_method_namaz' );
function tmpray_method_namaz(){

    $json_data =    '{ 
                            "method": "'.sanitize_text_field($_REQUEST['method']).'",
                            "asr":"'.sanitize_text_field($_REQUEST['asr']).'",
                            "midnight":"'.sanitize_text_field($_REQUEST['midnight']).'",
                            "highLats":"'.sanitize_text_field($_REQUEST['higherlatitudes']).'",
                            "fajrtune":'.sanitize_text_field($_REQUEST['fajrtune']).',
                            "sunrisetune":'.sanitize_text_field($_REQUEST['sunrisetune']).',
                            "dhuhrtune":'.sanitize_text_field($_REQUEST['dhuhrtune']).',
                            "asrtune":'.sanitize_text_field($_REQUEST['asrtune']).',
                            "maghribtune":'.sanitize_text_field($_REQUEST['maghribtune']).',
                            "ishatune":'.sanitize_text_field($_REQUEST['ishatune']).',
                            "latitude":'.sanitize_text_field($_REQUEST['latitude']).',
                            "longitude":'.sanitize_text_field($_REQUEST['longitude']).',
                            "timezone":'.sanitize_text_field($_REQUEST['timezone']).',   
                            "city":"'.sanitize_text_field($_REQUEST['city']).'"  
                        }';



    $check_title = get_page_by_title('settings', 'OBJECT', 'namaz-time');

    if (!empty($check_title) && $check_title !=''){
        $args = array(
            'ID' =>  $check_title->ID,
            'post_name'   => esc_attr('Namaz Time', 'tmpray-islamic-helper'),
            'post_title'    => 'settings',
            'post_content'  => $json_data,
            'post_status'   => sanitize_option($_REQUEST['fillmethod']),
            'post_type'  => 'namaz-time'
        );

        wp_update_post($args);
    }

    wp_die();
}

function tmpray_get_pray_time_single($day, $month, $atts){
    $idf = uniqid('').'-'.rand(100,9999);
    wp_enqueue_script('tmpray_praytimes', plugin_dir_url( __FILE__ ) . 'js/PrayTimes.js', array('jquery'), null, false);
    if(isset($atts['pref']) && $atts['pref'] !=''){
        $pref = $atts['pref'];
    } else{
        $pref = '';
    }
    if(isset($atts['suf']) && $atts['suf'] !=''){
        $suf = $atts['suf'];
    } else {
        $suf = '';
    }
    $namaz_time = get_page_by_title( 'settings', OBJECT, 'namaz-time' );
    $result = "<div class='tmpray--pray-time-container' id='tmpray--pray-time-container'>";
    if ($namaz_time->post_status == 'fill') {
        $namaz_month = get_page_by_title( $month, OBJECT, 'namaz-time' );
        $namaz_month_json =  json_decode($namaz_month->post_content, true);
        $d = 1;
        foreach ($namaz_month_json as $item){
            if($d == $day){
                if(isset($atts['title']) && $atts['title'] == true){
                    if(isset($atts['fajr']) && $atts['fajr']!='' && $atts['fajr']=='true'){
                        $result.="<div class='tmpray--fajr'><span>" . esc_attr('Fajr:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['fajr'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['sunrise']) && $atts['sunrise']!='' && $atts['sunrise']=='true'){
                        $result.="<span class='tmpray--sunrise'><span>" . esc_attr('Sunrise:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['sunrise']. ' ' . $suf, 'tmpray-islamic-helper')."</span>";
                    }
                    if(isset($atts['dhuhr']) && $atts['dhuhr']!='' && $atts['dhuhr']=='true'){
                        $result.="<div class='tmpray--dhuhr'><span>" . esc_attr('Dhuhr:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['dhuhr'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['asr']) && $atts['asr']!='' && $atts['asr']=='true'){
                        $result.="<div class='tmpray--maghrib'><span>" . esc_attr('Asr:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['asr'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['maghrib']) && $atts['maghrib']!='' && $atts['maghrib']=='true'){
                        $result.="<div class='tmpray--maghrib'><span>" . esc_attr('Maghrib:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref. ' ' . $item['maghrib'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['isha']) && $atts['isha']!='' && $atts['isha']=='true'){
                        $result.="<div class='tmpray--isha'><span>" . esc_attr('Isha:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['isha'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                }else{
                    if(isset($atts['fajr']) && $atts['fajr']!='' && $atts['fajr']=='true'){
                        $result.="<div class='tmpray--fajr'>" . esc_attr($pref . ' ' . $item['fajr'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['sunrise']) && $atts['sunrise']!='' && $atts['sunrise']=='true'){
                        $result.="<span class='tmpray--sunrise'>" . esc_attr($pref . ' ' . $item['sunrise'] . ' ' . $suf, 'tmpray-islamic-helper')."</span>";
                    }
                    if(isset($atts['dhuhr']) && $atts['dhuhr']!='' && $atts['dhuhr']=='true'){
                        $result.="<div class='tmpray--dhuhr'>" . esc_attr($pref . ' ' . $item['dhuhr'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['asr']) && $atts['asr']!='' && $atts['asr']=='true'){
                        $result.="<div class='tmpray--maghrib'>" . esc_attr($pref . ' ' . $item['asr'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['maghrib']) && $atts['maghrib']!='' && $atts['maghrib']=='true'){
                        $result.="<div class='tmpray--maghrib'>" . esc_attr($pref . ' ' . $item['maghrib'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                    if(isset($atts['isha']) && $atts['isha']!='' && $atts['isha']=='true'){
                        $result.="<div class='tmpray--isha'>". esc_attr($pref . ' ' . $item['isha'] . ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    }
                }
            }
            $d++;
        }

    } elseif ($namaz_time->post_status == 'method'){
        if(isset($atts['pref']) && $atts['pref'] !=''){
            $pref = $atts['pref'];
        }else{
            $pref = '';
        }
        if(isset($atts['suf']) && $atts['suf'] !=''){
            $suf = $atts['suf'];
        } else{
            $suf = '';
        }

        $namaz_time_json = $namaz_time->post_content;
        $namaz_time_array = json_decode($namaz_time_json);
        $result .= "<script>
                        jQuery(document).ready(function(){
                            'use strict';
                            var method = '$namaz_time_array->method';
                            var asr = '$namaz_time_array->asr';
                            var midnight = '$namaz_time_array->midnight';
                            var higherlatitudes = '$namaz_time_array->highLats';
                            var fajrtune  = $namaz_time_array->fajrtune;
                            var sunrisetune  = $namaz_time_array->sunrisetune;
                            var dhuhrtune  = $namaz_time_array->dhuhrtune;
                            var asrtune = $namaz_time_array->asrtune;
                            var maghribtune = $namaz_time_array->maghribtune;
                            var ishatune = $namaz_time_array->ishatune;
                            var latitude = $namaz_time_array->latitude;
                            var longitude = $namaz_time_array->longitude;
                            var timezone = $namaz_time_array->timezone;
                            var dt = new Date();
                            var namaztimes = new PrayTimes();
                            namaztimes.setMethod(method);
                            namaztimes.adjust({asr:asr, highLats:higherlatitudes, midnight:midnight});
                            namaztimes.tune({fajr: fajrtune, sunrise: sunrisetune, dhuhr: dhuhrtune, asr: asrtune, maghrib: maghribtune, isha: ishatune});
                            var namaz = namaztimes.getTimes([dt.getFullYear(),".$month.", ".$day."], [latitude, longitude], timezone);
                            
                            jQuery('.tmpray--method-fajr-$idf').html('".$pref."' + ' ' + namaz.fajr + ' ' + '".$suf."');
                            jQuery('.tmpray--method-sunrise-$idf').html('".$pref."' + ' ' + namaz.sunrise + ' ' + '".$suf."');
                            jQuery('.tmpray--method-dhuhr-$idf').html('".$pref."' + ' ' + namaz.dhuhr + ' ' + '".$suf."');
                            jQuery('.tmpray--method-asr-$idf').html('".$pref."' + ' ' + namaz.asr + ' ' + '".$suf."');
                            jQuery('.tmpray--method-maghrib-$idf').html('".$pref."' + ' ' + namaz.maghrib + ' ' + '".$suf."');
                            jQuery('.tmpray--method-isha-$idf').html('".$pref."' + ' ' + namaz.isha + ' ' + '".$suf."');
                        });
                    </script>";

        if(isset($atts['title']) && $atts['title'] == true){
            if(isset($atts['fajr']) && $atts['fajr']!='' && $atts['fajr']=='true') {
                $result .= "<div class='tmpray--method-fajr-contain'><span class='tmpray--method-fajr-title'>" . esc_attr('Fajr:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-fajr-".$idf."'></span></div>";
            }
            if(isset($atts['sunrise']) && $atts['sunrise']!='' && $atts['sunrise']=='true') {
                $result .= "<div class='tmpray--method-sunrise-contain'><span class='tmpray--method-sunrise-title'>" . esc_attr('Sunrise:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-sunrise-".$idf."'></span></div>";
            }
            if(isset($atts['dhuhr']) && $atts['dhuhr']!='' && $atts['dhuhr']=='true') {
                $result .= "<div class='tmpray--method-dhuhr-contain'><span class='tmpray--method-dhuhr-title'>" . esc_attr('Dhuhr:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-dhuhr-".$idf."'></span></div>";
            }
            if(isset($atts['asr']) && $atts['asr']!='' && $atts['asr']=='true') {
                $result .= "<div class='tmpray--method-asr-contain'><span class='tmpray--method-asr-title'>" . esc_attr('Asr:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-asr-".$idf."'></span></div>";
            }
            if(isset($atts['maghrib']) && $atts['maghrib']!='' && $atts['maghrib']=='true') {
                $result .= "<div class='tmpray--method-maghrib-contain'><span class='tmpray--method-maghrib-title'>" . esc_attr('Maghrib:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-maghrib-".$idf."'></span></div>";
            }
            if(isset($atts['isha']) && $atts['isha']!='' && $atts['isha']=='true') {
                $result .= "<div class='tmpray--method-isha-contain'><span class='tmpray--method-isha-title'>" . esc_attr('Isha:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-isha-".$idf."'></span></div>";
            }
        }else{
            if(isset($atts['fajr']) && $atts['fajr']!='' && $atts['fajr']=='true'){
                $result .= "<div class='tmpray--method-fajr-contain'><span class='tmpray--method-fajr-".$idf."'></span></div>";
            }
            if(isset($atts['sunrise']) && $atts['sunrise']!='' && $atts['sunrise']=='true') {
                $result .= "<div class='tmpray--method-sunrise-contain'><span class='tmpray--method-sunrise-".$idf."'></span></div>";
            }
            if(isset($atts['dhuhr']) && $atts['dhuhr']!='' && $atts['dhuhr']=='true') {
                $result .= "<div class='tmpray--method-dhuhr-contain'><span class='tmpray--method-dhuhr-".$idf."'></span></div>";
            }
            if(isset($atts['asr']) && $atts['asr']!='' && $atts['asr']=='true') {
                $result .= "<div class='tmpray--method-asr-contain'><span class='tmpray--method-asr-".$idf."'></span></div>";
            }
            if(isset($atts['maghrib']) && $atts['maghrib']!='' && $atts['maghrib']=='true') {
                $result .= "<div class='tmpray--method-maghrib-contain'><span class='tmpray--method-maghrib-".$idf."'></span></div>";
            }
            if(isset($atts['isha']) && $atts['isha']!='' && $atts['isha']=='true') {
                $result .= "<div class='tmpray--method-isha-contain'><span class='tmpray--method-isha-".$idf."'></span></div>";
            }
        }
    }

    $result .= "</div>";
    return $result;

}

function tmpray_get_pray_time_all($day, $month, $atts){
    $idf = uniqid('').'-'.rand(100,9999);

    wp_enqueue_script('jquery', false, array(), false, false);
    wp_enqueue_script('tmpray_praytimes', plugin_dir_url( __FILE__ ) . 'js/PrayTimes.js', array('jquery'), null, false);

    $namaz_time = get_page_by_title( 'settings', OBJECT, 'namaz-time' );
    $result = "<div class='tmpray--pray-time-container' id='tmpray--pray-time-container'>";
    if ($namaz_time->post_status == 'fill') {
        $namaz_month = get_page_by_title( $month, OBJECT, 'namaz-time' );
        $namaz_month_json =  json_decode($namaz_month->post_content, true);
        $d = 1;

        if(isset($atts['pref']) && $atts['pref'] !=''){
            $pref = $atts['pref'];
        }
        if(isset($atts['suf']) && $atts['suf'] !=''){
            $suf = $atts['suf'];
        }

        foreach ($namaz_month_json as $item){
            if($d == $day){
                if(isset($atts['title']) && $atts['title'] == true){
                    $result.="<div class='tmpray--fajr'><span>" . esc_attr('Fajr:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['fajr']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<span class='tmpray--sunrise'><span>" . esc_attr('Sunrise:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref. ' ' . $item['sunrise']. ' ' . $suf, 'tmpray-islamic-helper')."</span>";
                    $result.="<div class='tmpray--dhuhr'><span>" . esc_attr('Dhuhr:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['dhuhr']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<div class='tmpray--maghrib'><span>" . esc_attr('Asr:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['asr']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<div class='tmpray--maghrib'><span>" . esc_attr('Maghrib:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['maghrib']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<div class='tmpray--isha'><span>". esc_attr('Isha:', 'tmpray-islamic-helper') . "</span>" . esc_attr($pref . ' ' . $item['isha']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                }else{
                    $result.="<div class='tmpray--fajr'>".esc_attr($pref . ' ' . $item['fajr']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<span class='tmpray--sunrise'>".esc_attr($pref. ' ' . $item['sunrise']. ' ' . $suf, 'tmpray-islamic-helper')."</span>";
                    $result.="<div class='tmpray--dhuhr'>".esc_attr($pref . ' ' . $item['dhuhr']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<div class='tmpray--maghrib'>".esc_attr($pref . ' ' . $item['asr']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<div class='tmpray--maghrib'>".esc_attr($pref . ' ' . $item['maghrib']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                    $result.="<div class='tmpray--isha'>".esc_attr($pref . ' ' . $item['isha']. ' ' . $suf, 'tmpray-islamic-helper')."</div>";
                }
            }
            $d++;
        }

    } elseif ($namaz_time->post_status == 'method'){
        if(isset($atts['pref']) && $atts['pref'] !=''){
            $pref = $atts['pref'];
        }
        if(isset($atts['suf']) && $atts['suf'] !=''){
            $suf = $atts['suf'];
        }
        $namaz_time_json = $namaz_time->post_content;
        $namaz_time_array = json_decode($namaz_time_json);

        $result .= "<input id = 'tmpray--method' type= 'hidden' value= '".esc_attr($namaz_time_array->method)."'>";

        $result .= "<input id = 'tmpray--asr' type= 'hidden' value= '".esc_attr($namaz_time_array->asr)."'>";

        $result .= "<input id = 'tmpray--midnight' type= 'hidden' value= '".esc_attr($namaz_time_array->midnight)."'>";

        $result .= "<input id = 'tmpray--higher-latitudes' type= 'hidden' value= '".esc_attr($namaz_time_array->highLats)."'>";

        $result .= "<input id = 'tmpray--tuning-times-fajr' type= 'hidden' value= '".esc_attr($namaz_time_array->fajrtune)."'>";
        $result .= "<input id = 'tmpray--tuning-times-sunrise' type= 'hidden' value= '".esc_attr($namaz_time_array->sunrisetune)."'>";
        $result .= "<input id = 'tmpray--tuning-times-dhuhr' type= 'hidden' value= '".esc_attr($namaz_time_array->dhuhrtune)."'>";
        $result .= "<input id = 'tmpray--tuning-times-asr' type= 'hidden' value= '".esc_attr($namaz_time_array->asrtune)."'>";
        $result .= "<input id = 'tmpray--tuning-times-maghrib' type= 'hidden' value= '".esc_attr($namaz_time_array->maghribtune)."'>";
        $result .= "<input id = 'tmpray--tuning-times-isha' type= 'hidden' value= '".esc_attr($namaz_time_array->ishatune)."'>";

        $result .= "<input id = 'tmpray--latitude' type= 'hidden' value= '".esc_attr($namaz_time_array->latitude)."'>";
        $result .= "<input id = 'tmpray--longitude' type= 'hidden' value= '".esc_attr($namaz_time_array->longitude)."'>";
        $result .= "<input id = 'tmpray--timezone' type= 'hidden' value= '".esc_attr($namaz_time_array->timezone)."'>";
        $result .= "<script>
                        jQuery(document).ready(function(){
                            'use strict';
                            var method = jQuery('#tmpray--method').val();
                            var asr = jQuery('#tmpray--asr').val();
                            var midnight = jQuery('#tmpray--midnight').val();
                            var higherlatitudes = jQuery('#tmpray--higher-latitudes').val();
                            var fajrtune  = jQuery('#tmpray--tuning-times-fajr').val();
                            var sunrisetune  = jQuery('#tmpray--tuning-times-sunrise').val();
                            var dhuhrtune  = jQuery('#tmpray--tuning-times-dhuhr').val();
                            var asrtune = jQuery('#tmpray--tuning-times-asr').val();
                            var maghribtune = jQuery('#tmpray--tuning-times-maghrib').val();
                            var ishatune = jQuery('#tmpray--tuning-times-isha').val();
                            var latitude = jQuery('#tmpray--latitude').val();
                            var longitude = jQuery('#tmpray--longitude').val();
                            var timezone = jQuery('#tmpray--timezone').val();
                            var dt = new Date();
                            var namaztimes = new PrayTimes();
                            namaztimes.setMethod(method);
                            namaztimes.adjust({asr:asr, highLats:higherlatitudes, midnight:midnight});
                            namaztimes.tune({fajr: fajrtune, sunrise: sunrisetune, dhuhr: dhuhrtune, asr: asrtune, maghrib: maghribtune, isha: ishatune});
                            var namaz = namaztimes.getTimes([dt.getFullYear(),".$month.", ".$day."], [latitude, longitude], timezone);
                            jQuery('.tmpray--method-fajr-all-$idf').html('".$pref."' + ' ' + namaz.fajr + ' ' + '".$suf."');
                            jQuery('.tmpray--method-sunrise-all-$idf').html('".$pref."' + ' ' + namaz.sunrise + ' ' + '".$suf."');
                            jQuery('.tmpray--method-dhuhr-all-$idf').html('".$pref."' + ' ' + namaz.dhuhr + ' ' + '".$suf."');
                            jQuery('.tmpray--method-asr-all-$idf').html('".$pref."' + ' ' + namaz.asr + ' ' + '".$suf."');
                            jQuery('.tmpray--method-maghrib-all-$idf').html('".$pref."' + ' ' + namaz.maghrib + ' ' + '".$suf."');
                            jQuery('.tmpray--method-isha-all-$idf').html('".$pref."' + ' ' + namaz.isha + ' ' + '".$suf."');
                        });
                    </script>";
        if(isset($atts['title']) && $atts['title'] == true){
            $result .= "<div class='tmpray--method-fajr-contain'><span class='tmpray--method-fajr-title'>" . esc_attr('Fajr:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-fajr-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-sunrise-contain'><span class='tmpray--method-sunrise-title'>" . esc_attr('Sunrise:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-sunrise-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-dhuhr-contain'><span class='tmpray--method-dhuhr-title'>" . esc_attr('Dhuhr:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-dhuhr-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-asr-contain'><span class='tmpray--method-asr-title'>" . esc_attr('Asr:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-asr-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-maghrib-contain'><span class='tmpray--method-maghrib-title'>" . esc_attr('Maghrib:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-maghrib-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-isha-contain'><span class='tmpray--method-isha-title'>" . esc_attr('Isha:', 'tmpray-islamic-helper') . "</span><span class='tmpray--method-isha-all-".$idf."'></span></div>";
        }else{
            $result .= "<div class='tmpray--method-fajr-contain'><span class='tmpray--method-fajr-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-sunrise-contain'><span class='tmpray--method-sunrise-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-dhuhr-contain'><span class='tmpray--method-dhuhr-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-asr-contain'><span class='tmpray--method-asr-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-maghrib-contain'><span class='tmpray--method-maghrib-all-".$idf."'></span></div>";
            $result .= "<div class='tmpray--method-isha-contain'><span class='tmpray--method-isha-all-".$idf."'></span></div>";
        }

    }

    $result .= "</div>";
    return $result;

}

//Shortcodes
add_action( 'wp_ajax_nopriv_tmpray_show_shortcode_single', 'tmpray_show_shortcode_single' );
add_action( 'wp_ajax_tmpray_show_shortcode_single', 'tmpray_show_shortcode_single' );
function tmpray_show_shortcode_single(){

    $result = '[';
    $result .= 'praytime_single';

    if(isset($_REQUEST['title']) && $_REQUEST['title']!='' && $_REQUEST['title']== 'true') {
        $result .= ' title=true';
    }
    if(isset($_REQUEST['fajr']) && $_REQUEST['fajr']!='' && $_REQUEST['fajr']== 'true') {
        $result .= ' fajr=true';
    }
    if(isset($_REQUEST['sunrise']) && $_REQUEST['sunrise']!='' && $_REQUEST['sunrise']== 'true') {
        $result .= ' sunrise=true';
    }
    if(isset($_REQUEST['dhuhr']) && $_REQUEST['dhuhr']!='' && $_REQUEST['dhuhr']== 'true') {
        $result .= ' dhuhr=true';
    }
    if(isset($_REQUEST['asr']) && $_REQUEST['asr']!='' && $_REQUEST['asr']== 'true') {
        $result .= ' asr=true';
    }
    if(isset($_REQUEST['maghrib']) && $_REQUEST['maghrib']!='' && $_REQUEST['maghrib']== 'true') {
        $result .= ' maghrib=true';
    }
    if(isset($_REQUEST['isha']) && $_REQUEST['isha']!='' && $_REQUEST['isha']== 'true') {
        $result .= ' isha=true';
    }
    if(isset($_REQUEST['pref']) && $_REQUEST['pref']!='') {
        $result .= ' pref="' . $_REQUEST['pref'] . '"';
    }
    if(isset($_REQUEST['suf']) && $_REQUEST['suf']!='') {
        $result .= ' suf="' . $_REQUEST['suf'] . '"';
    }

    $result .= ']';

    echo $result;

    wp_die();
}

add_action( 'wp_ajax_nopriv_tmpray_show_shortcode_all', 'tmpray_show_shortcode_all' );
add_action( 'wp_ajax_tmpray_show_shortcode_all', 'tmpray_show_shortcode_all' );
function tmpray_show_shortcode_all(){

    $result = '[';
    $result .= 'praytime_all';

    if(isset($_REQUEST['title']) && $_REQUEST['title']!='' && $_REQUEST['title']== 'true') {
        $result .= ' title=true';
    }
    if(isset($_REQUEST['pref']) && $_REQUEST['pref']!='') {
        $result .= ' pref="' . esc_attr($_REQUEST['pref']) . '"';
    }
    if(isset($_REQUEST['suf']) && $_REQUEST['suf']!='') {
        $result .= ' suf="' . esc_attr($_REQUEST['suf']). '"';
    }

    $result .= ']';

    echo $result;

    wp_die();
}

function tmpray_pray_time_function_single($atts, $pref, $suf){
    return tmpray_get_pray_time_single(date('j'), date('n'), $atts, $pref, $suf);
}
add_shortcode( 'praytime_single', 'tmpray_pray_time_function_single' );

function tmpray_pray_time_function_all($atts, $pref, $suf){
    return tmpray_get_pray_time_all(date('j'), date('n'), $atts, $pref, $suf);
}
add_shortcode( 'praytime_all', 'tmpray_pray_time_function_all' );
