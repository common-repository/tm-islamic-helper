<?php

if(!class_exists('TMPRAY_Helping')):
    class TMPRAY_Helping {
        private static $_instance = null;

        public static function instance () {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
                self::$_instance->init_actions();
            }
            return self::$_instance;
        }

        private function __construct () {
            /* We do nothing here! */
        }

        private function init_actions () {
            if (is_admin()) {
                add_action('admin_print_styles', array($this, 'admin_print_styles'));
            }
        }

    }
endif;
if ( ! function_exists( 'tmpray_helping' ) ) :
    function tmpray_helping() {
        return TMPRAY_Helping::instance();
    }
endif;

tmpray_helping();

