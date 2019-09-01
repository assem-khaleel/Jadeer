<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout {

    private static $instance;

    var $version = 1;
    var $layout = null;

    var $javascript = array();
    var $stylesheet = array();

    var $last_javascript = null;
    var $last_stylesheet = null;

    private $loded_javascript = array();
    private $loded_stylesheet = array();

    var $content_as_html = false;

    var $configs = array();

    public function __construct() {
        self::$instance = $this;

        self::$instance->add_config('csrf_protection', get_instance()->config->item('csrf_protection'));
        self::$instance->add_config('csrf_token_name', get_instance()->config->item('csrf_token_name'));
        self::$instance->add_config('csrf_cookie_name', get_instance()->config->item('csrf_cookie_name'));
        self::$instance->add_config('index_page', get_instance()->config->item('index_page'));
        self::$instance->add_config('google_api_base', get_instance()->config->item('google_api_base'));
        self::$instance->add_config('base_url', get_instance()->config->item('base_url'));

    }

    public function view($view, $view_params = array(), $return = false) {

        if(is_null(self::$instance->layout)) {
            self::$instance->set_layout('layout');
        }

        $view_params['content'] = $view;
        $view_params['content_as_html'] = self::$instance->content_as_html;

        if ($return) {
            return get_instance()->load->view(self::$instance->layout, $view_params, true);
        } else {
            get_instance()->load->view(self::$instance->layout, $view_params);
        }
    }

    public function set_layout($layout) {

        self::$instance->layout = $layout;

        $lang = (UI_LANG == 'arabic') ? '.rtl' : '';

        if(self::$instance->layout == 'layout_pdf') {
            self::$instance->add_stylesheet('/assets/fonts/Open-Sans/gf.css', true, false);
            self::$instance->add_stylesheet('/assets/fonts/font-awesome/css/font-awesome.min.css', true, false);
            self::$instance->add_stylesheet('/assets/fonts/Ionicons/css/ionicons.min.css', true, false);

            self::$instance->add_stylesheet("/assets/pixel/css/bootstrap{$lang}.min.css", true, false);
            self::$instance->add_stylesheet("/assets/pixel/css/pixeladmin{$lang}.min.css", true, false);
            self::$instance->add_stylesheet("/assets/pixel/css/themes/candy-orange{$lang}.min.css", true, false);

            self::$instance->javascript = array();
        } else {
            self::$instance->add_stylesheet('/assets/fonts/Open-Sans/gf.css', true, false);
            self::$instance->add_stylesheet('/assets/fonts/font-awesome/css/font-awesome.min.css', true, false);
            self::$instance->add_stylesheet('/assets/fonts/Ionicons/css/ionicons.min.css', true, false);

            self::$instance->add_stylesheet("/assets/pixel/css/bootstrap-dark{$lang}.min.css", true, false);
            self::$instance->add_stylesheet("/assets/pixel/css/pixeladmin-dark{$lang}.min.css", true, false);
            self::$instance->add_stylesheet("/assets/pixel/css/widgets-dark{$lang}.min.css", true, false);
            self::$instance->add_stylesheet("/assets/pixel/css/themes/dark-orange{$lang}.min.css", true, false);

            self::$instance->add_javascript('/assets/pixel/js/bootstrap.min.js', true, false);
            self::$instance->add_javascript('/assets/pixel/js/pixeladmin.min.js', true, false);
            self::$instance->add_javascript('/assets/jadeer/js/jquery.cookie.js', true, false);
            self::$instance->add_javascript('/assets/pixel/js/override.pixel.js', true, false);
            //self::$instance->add_javascript('/assets/jadeer/js/script.js', true, false);

            self::$instance->last_javascript = base_url('/assets/jadeer/js/script.js') . "?v=" . self::$instance->version;
        }

        return self::$instance;
    }

    public function content_as_html($content_as_html) {
        self::$instance->content_as_html = boolval($content_as_html);
        return self::$instance;
    }
    public function add_javascript($script, $base_url = true, $group_page = true){

        if('https://www.google.com/jsapi' === $script) {
            return $this->add_google_api();
        }

        self::$instance->javascript[($group_page ? 'page' : 'common')][md5($script)] = ($base_url ? base_url($script) . "?v=" . self::$instance->version : $script);
    }

    public function render_javascript($script){

        if(empty(self::$instance->loded_javascript[md5($script)])) {
            self::$instance->loded_javascript[md5($script)] = $script;
            echo "<script src='{$script}'></script>";
        }

    }

    public function add_stylesheet($style, $base_url = true, $group_page = true){
        self::$instance->stylesheet[($group_page ? 'page' : 'common')][md5($style)] = ($base_url ? base_url($style) . "?v=" . self::$instance->version : $style);
    }

    public function add_google_api() {
        $this->add_stylesheet('/assets/jadeer/js/google-lib/static/uitable.css');
        $this->add_javascript('/assets/jadeer/js/google-lib/jsapi.js');
        $this->add_javascript('/assets/jadeer/js/google-lib/visualization.js');

        return true;
    }

    public function render_stylesheet($style){

        if(empty(self::$instance->loded_stylesheet[md5($style)])) {
            self::$instance->loded_stylesheet[md5($style)] = $style;
            echo "<link href='{$style}' rel='stylesheet' type='text/css'>";
        }

    }

    public function add_config($key, $value){
        self::$instance->configs[$key] = $value;
    }

    public function get_config($name) {
        return isset(self::$instance->configs[$name]) ? self::$instance->configs[$name] : '';
    }

    public static function draw_javascript() {
        $draw = '<!-- BEGIN SCRIPTS -->'."\n";
        if(!empty(self::$instance->javascript)) {
            if (!isset(self::$instance->javascript['common'])) {
                self::$instance->javascript['common'] = array();
            }
            foreach(self::$instance->javascript['common'] as $script) {
                self::$instance->loded_javascript[md5($script)] = $script;
                $draw .= "\t"."<script src='{$script}'></script>"."\n";
            }
            if(!empty(self::$instance->javascript['page'])) {
                foreach (array_diff(self::$instance->javascript['page'], self::$instance->javascript['common']) as $script) {
                    self::$instance->loded_javascript[md5($script)] = $script;
                    $draw .= "\t" . "<script src='{$script}'></script>" . "\n";
                }
            }
        }
        $last_javascript = self::$instance->last_javascript;
        if($last_javascript) {
            $draw .= "\t" . "<script src='{$last_javascript}'></script>" . "\n";
        }
        $draw .= "\t".'<!-- END SCRIPTS -->'."\n";

        return $draw;
    }

    public static function draw_stylesheet() {
        $draw = '<!-- BEGIN STYLES -->'."\n";
        if(!empty(self::$instance->stylesheet)) {
            if (!isset(self::$instance->stylesheet['common'])) {
                self::$instance->stylesheet['common'] = array();
            }
            foreach(self::$instance->stylesheet['common'] as $style) {
                self::$instance->loded_stylesheet[md5($style)] = $style;
                $draw .= "\t"."<link href='{$style}' rel='stylesheet' type='text/css'>"."\n";
            }
            if(!empty(self::$instance->stylesheet['page'])) {
                foreach(array_diff(self::$instance->stylesheet['page'], self::$instance->stylesheet['common']) as $style) {
                    self::$instance->loded_stylesheet[md5($style)] = $style;
                    $draw .= "\t"."<link href='{$style}' rel='stylesheet' type='text/css'>"."\n";
                }
            }
        }
        $last_stylesheet = self::$instance->last_stylesheet;
        if($last_stylesheet) {
            $draw .= "\t"."<link href='{$last_stylesheet}' rel='stylesheet' type='text/css'>"."\n";
        }
        $draw .= "\t".'<!-- END STYLES -->'."\n";

        return $draw;
    }

    public static function draw_config() {
        return '<script> var config = ' . json_encode(self::$instance->configs) . '; </script>'."\n";
    }

    public static function draw_ajax_override() {

        $extra = '';
        $ajax = '';

        $index_page = get_instance()->config->item('index_page');

        if($index_page) {

            $base_url = get_instance()->config->item('base_url');

            $ajax .= "
            var base_url = '{$base_url}';
            var index_page = '/{$index_page}';
            var request_url = settings.url;
            
            if(String(settings.url).indexOf(base_url) === 0) {
                request_url = '/' + String(settings.url).replace(base_url, '');
            }

            if(String(request_url).indexOf(index_page) !== 0) {
                settings.url = index_page + request_url;
            }
            " . "\n";
        }

        if(self::$instance->get_config('csrf_protection')) {
            $ajax .= "
            if (options.type == 'POST' || settings.type == 'POST') {
                var data = (options.data ? options.data : '');
                data = (typeof data == 'object' ? $.param(data) : data);
                if(!data.match(config.csrf_token_name)) {
                    data += (data ? '&' : '');
                    data += config.csrf_token_name + '=' + $.cookie(config.csrf_cookie_name);
                    settings.data = data;
                }
            }
            ";

            $extra .= '
        $(document).ajaxComplete(function() {
            $( "input[name=\'"+config.csrf_token_name+"\']").val($.cookie(config.csrf_cookie_name));
        });
            ';

        }

        if($ajax) {
            return "
    <script>
        $.ajaxPrefilter(function(settings, options) {
            {$ajax}
        });
        {$extra}
    </script>
" . "\n";
        }

    }

}
