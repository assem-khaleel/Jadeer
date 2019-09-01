<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function json_response($data = array(), $status_header = 200) {

    get_instance()->output
        ->set_status_header($status_header)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();

    exit;
}

function htmlfilter($text) {
    if ($text) {
        return htmlentities($text, ENT_COMPAT, 'UTF-8');
    }
    return $text;
}

function xssfilter($str, $is_image = FALSE) {
    return get_instance()->security->xss_clean($str, $is_image);
}

function handle_url($queries = array(), $unset_queries = array()) {

    $request_url = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');

    $url = explode('?', $request_url);
    $matches = array();
    preg_match("/^[?].*/", $request_url, $matches);

    $out_url = '';
    if (empty($matches)) {
        $out_url .= $url[0];
    }

    $query_string_array = array();
    if (isset($url[1]) AND $url[1]) {
        parse_str($url[1], $query_string_array);
    }

    if($queries) {
        foreach($queries as $label => $value) {
            $query_string_array[$label] = $value;
        }
    }

    if($unset_queries) {
        foreach($unset_queries as $label) {
            unset($query_string_array[$label]);
        }
    }

    $out_url .= '?' . http_build_query($query_string_array);

    return $out_url;
}

function random_password() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

/**
 * search needle for nested array
 * @param array $haystack : multi-dimensional array
 * @param string $attr : key for array column
 * @param string $needle
 * @return array row for nested array otherwise false if not found
 */
function get_row_from_array($haystack, $attr, $needle, $multi = false)
{
	if (!is_array($haystack)) {
		return false;
	}

	$found = array();
	foreach ($haystack as $key => $stack) {

		if (!is_array($stack)) {
			return false;
		}

		if (isset($stack[$attr]) && $stack[$attr] == $needle) {

			if ($multi) {
				$found[] = $haystack[$key];
			}
			else {
				return $haystack[$key];
			}
		}
	}

	return $found;
}

function search_multi_array($haystack, $needles)
{
	if (!is_array($haystack)) {
		return array();
	}

	foreach ($haystack as $key => $stack) {

		if (!is_array($stack)) {

			return array();
		}

		$cond_success = 0;
		foreach ($needles as $attr => $needle) {

			if (isset($stack[$attr]) && $stack[$attr] == $needle) {
				$cond_success += 1;
			}
		}
		if ($cond_success == count($needles)) {
			return $haystack[$key];
		}
	}

	return array();
}

function arrayRecursiveDiff($aArray1, $aArray2) {

    if (!is_array($aArray1)) {
        $aArray1 = [];
    }
    if (!is_array($aArray2)) {
        $aArray2 = [];
    }

    $aReturn = array();

    foreach ($aArray1 as $mKey => $mValue) {
        if (array_key_exists($mKey, $aArray2)) {
            if (is_array($mValue)) {
                $aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
            } else {
                if ($mValue != $aArray2[$mKey]) {
                    $aReturn[$mKey] = $mValue;
                }
            }
        } else {
            $aReturn[$mKey] = $mValue;
        }
    }
    return $aReturn;
}

function roundUpToFive($x) {
    $output = 0;
    $round = fmod($x,5);
    if ($round === 0) {
        $output = $x;
    } elseif ($round >= 2.5) {
        $output =  $x - $round + 5;
    } else {
        $output = $x - $round;
    }
    return $output;
}

/**
 * @param $ar
 * @param string $callback
 * @return array
 */
function array_filter_key($ar, $callback = 'empty')
{
    $ar = (array)$ar;
    return array_intersect_key($ar, array_flip(array_filter(array_keys($ar), $callback)));
}

function data_loading_text($escape = false) {

    $text = lang('Loading');

    $loading = <<<HTML
data-loading-text="<span class='btn-label-icon left'><i class='fa fa-spinner fa-spin'></i></span> {$text}"
HTML;

    if($escape) {
        $loading = str_replace("'", "\'", $loading);
    }

    return $loading;

}

function get_chart_color($progress)
{

    if ($progress <= 30) {
        $color = '#e46050';
    }

    if ($progress > 30 && $progress <= 70) {
        $color = '#f3a535';
    }

    if ($progress > 70) {
        $color = '#78bd5d';
    }

    return $color;
}


function time_12_lang($time) {

    $time = strtotime($time);

    return date('h:i', $time).' '.lang(date('a',$time));

}

/**
 * @param string $ajax_url ajax url
 * @param string $reset_url reset url
 * @param array $filters list of needed filters
 * @param string $ajax_block ajax block name
 * @param string $extra_html extra html filters
 * @return string html
 */
function filter_block($ajax_url = '', $reset_url = '', $filters = [], $ajax_block = 'ajax_block', $extra_html = '') {
    $CI = get_instance();

    return $CI->load->view(
        'common/filter_block',
        array (
            'filters'       => $filters,
            'ajax_block'    => $ajax_block,
            'ajax_url'    => $ajax_url,
            'reset_url'    => $reset_url,
            'extra_html'    => $extra_html,
        ),
        true
    );
}

function error_dialog($message='') {
    $error_title = lang('Error');
    $error_msg = $message?: lang('The resource you requested does not exist!');
    $close_btn = lang('Close');

    $html = <<<HTML
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{$error_title}</h4>
        </div>
            <div class="modal-body">
                <div class="form-group">
                    <h3>{$error_msg}</h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pull-left" data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span>{$close_btn}</button>
            </div>
    </div>
</div>
HTML;

    return $html;
}


function selenium(){
    if(ENVIRONMENT=='testing'){
        return "data-selenium='input'";
    }
    return '';
}