<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pager {

    private $total_count;
    private $per_page;
    private $page = 1;
    private $url;
    private $num_elements = 10;
    private $query_string = '';
    private $pager_class = 'pagination';
    private $pager_id = '';
    private $pager_style = '';
    private $page_label = 'page';
    private $pager_link_attr = '';

    public function __construct($params = array()) {
        $this->set_total_count((isset($params['total_count']) ? $params['total_count'] : 0));
        $this->set_page_label((isset($params['page_label']) ? $params['page_label'] : 'page'));
        $this->set_per_page((isset($params['per_page']) ? $params['per_page'] : 10));
        $this->set_page((isset($params['page']) ? $params['page'] : 1));
        $this->set_url((isset($params['url']) ? $params['url'] : '?' . $this->get_page_label() . '=<page>'));
        $this->set_num_elements((isset($params['num_elements']) ? $params['num_elements'] : 10));
        $this->set_query_string((isset($params['query_string']) ? $params['query_string'] : ''));
        $this->set_pager_class((isset($params['pager_class']) ? $params['pager_class'] : 'pagination'));
        $this->set_pager_id((isset($params['pager_id']) ? $params['pager_id'] : ''));
        $this->set_pager_style((isset($params['pager_style']) ? $params['pager_style'] : ''));
        $this->set_pager_link_attr((isset($params['pager_link_attr']) ? $params['pager_link_attr'] : ''));
        $this->handle_query_string();
    }

    private function set_page_label($label) {
        $this->page_label = $label;
    }

    public function get_page_label() {
        return $this->page_label;
    }

    public function set_total_count($total_count) {
        $this->total_count = $total_count;
    }

    public function get_total_count() {
        return $this->total_count;
    }

    public function set_per_page($per_page) {
        $this->per_page = $per_page;
    }

    public function get_per_page() {
        return $this->per_page;
    }

    public function set_page($page) {
        $this->page = $page;
    }

    public function get_page() {
        return $this->page;
    }

    private function set_url($url) {
        $this->url = $url;
    }

    public function get_url() {
        return $this->url;
    }

    private function set_num_elements($num_elements) {
        if ($num_elements > 5) {
            $this->num_elements = $num_elements;
        } else {
            $this->num_elements = 5;
        }
    }

    public function get_num_elements() {
        return $this->num_elements;
    }

    private function set_query_string($query_string) {
        $this->query_string = $query_string;
    }

    public function get_query_string() {
        return $this->query_string;
    }

    public function set_pager_class($pager_class) {
        $this->pager_class = $pager_class;
    }

    public function get_pager_class() {
        return $this->pager_class;
    }

    public function set_pager_id($pager_id) {
        $this->pager_id = $pager_id;
    }

    public function get_pager_id() {
        return $this->pager_id;
    }

    public function set_pager_style($style) {
        $this->pager_style = $style;
    }

    public function get_pager_style() {
        return $this->pager_style;
    }

    public function set_pager_link_attr($attr) {
        $this->pager_link_attr = $attr;
    }

    public function get_pager_link_attr() {
        return $this->pager_link_attr;
    }

    public function render($to_buffer = false)
    {
        $output = '';
        if ($this->total_count > $this->per_page) {
            $num_pages = ceil($this->total_count / $this->per_page);
            $pager_id = (!empty($this->pager_id) ? ' id="' . $this->pager_id . '"' : '');
            $pager_style = (!empty($this->pager_style) ? ' style="' . $this->pager_style . '"' : '');
            if ($pages = $this->get_pages_array($num_pages, $this->page, $this->num_elements)) {
                $output .= '<ul class="' . $this->pager_class . '"' . $pager_id . $pager_style . '>';
                foreach ($pages as $page) {
                    if ($page['label'] != '...') {
                        $page['url'] = str_replace('<page>', $page['label'], $this->url);
                    }
                    if (isset($page['url'])) {
                        if ($page['selected']) {
                            $output .= "<li class='active'><span>{$page['label']}</span></li>";
                        } else {
                            if (isset($page['page']) AND $page['page']) {
                                if ($this->query_string) {
                                    $output .= "<li><a {$page['attr']} href='{$page['url']}?" . $this->get_page_label() . "={$page['page']}&{$this->query_string}'>{$page['label']}</a><li>";
                                } else {
                                    $output .= "<li><a {$page['attr']} href='{$page['url']}?" . $this->get_page_label() . "={$page['page']}'>{$page['label']}</a></li>";
                                }
                            } else {
                                if ($this->query_string) {
                                    $output .= "<li><a {$page['attr']} href='{$page['url']}?" . $this->get_page_label() . "={$page['label']}&{$this->query_string}'>{$page['label']}</a></li>";
                                } else {
                                    $output .= "<li><a {$page['attr']} href='{$page['url']}?" . $this->get_page_label() . "={$page['label']}'>{$page['label']}</a></li>";
                                }
                            }
                        }
                    } else {
                        $output .= "<li><a href='#'>{$page['label']}</a></li>";
                    }
                }
                $output .= "</ul>";
            }
        }
        if ($to_buffer) {
            return $output;
        }
        echo $output;
	    return '';
    }

    private function get_pages_array($num_pages, $page, $num_elements) {

        $pages = array();

        /*
          $pages[] = array(
          'label' => '<<', // label is <<
          'selected' => false,
          'page' => 1,
          'attr' => " class='total-prev' "
          );
         */

        if ($page == 1) {
            $pages[] = array(
                'label' => '&laquo; '.lang('previous'),
                'selected' => false,
                'page' => $page,
                'attr' => $this->get_pager_link_attr()
            );
        } else {
            $pages[] = array(
                'label' => '&laquo; '.lang('previous'),
                'selected' => false,
                'page' => $page - 1,
                'attr' => $this->get_pager_link_attr()
            );
        }

        if ($num_pages <= $num_elements) {
            for ($i = 1; $i <= $num_pages; $i++) {
                $pages[] = array(
                    'attr' => $this->get_pager_link_attr(),
                    'label' => $i,
                    'selected' => ($i != $page ? false : true)
                );
            }
        } else {

            $section1_elements_num = floor($num_elements / 4);
            $section3_elements_num = floor($num_elements / 4);
            $section2_elements_num = $num_elements - $section1_elements_num - $section3_elements_num;

            $variation = floor($num_pages / $num_elements);

            // section 3
            $section3_from_page = $num_pages - ($section3_elements_num - 1);
            $section3_to_page = $num_pages; //$section3_from_page + $section3_elements_num;

            if ($page < $num_elements - $section3_elements_num) {
                // section 1
                $section1_from_page = 0;
                $section1_to_page = 0;

                // section 2
                $section2_elements_num += $section1_elements_num;
                $section2_from_page = 1;
                $section2_to_page = $section2_from_page + ($section2_elements_num - 1);
            } elseif ($page > $num_pages - ($section3_elements_num + $section2_elements_num - 1)) {

                // section 1
                $section1_from_page = 1;
                $section1_to_page = $section1_from_page + ($section1_elements_num - 1);

                // section 2
                $section2_from_page = 0;
                $section2_to_page = 0;

                // section 3
                $section3_elements_num += $section2_elements_num;
                $section3_from_page = $num_pages - ($section3_elements_num - 1);
                $section3_to_page = $num_pages; //$section3_from_page + ($section3_elements_num - 1);
            } else {
                // section 1
                $section1_from_page = 1;
                $section1_to_page = $section1_from_page + ($section1_elements_num - 1);

                // section 2
                if ($section2_elements_num % 2 != 0) {
                    $section2_from_page = $page - floor($section2_elements_num / 2);
                    $section2_to_page = $page + floor($section2_elements_num / 2);
                } else {
                    $section2_from_page = $page - (floor($section2_elements_num / 2) - 1);
                    $section2_to_page = $page + (floor($section2_elements_num / 2));
                }
            }

            if ($section1_from_page) {

                for ($i = $section1_from_page; $i <= $section1_to_page; $i++) {
                    $pages[] = array(
                        'attr' => $this->get_pager_link_attr(),
                        'label' => $i,
                        'selected' => ($i != $page ? false : true)
                    );
                }
                $pages[] = array('label' => '...', 'selected' => false);
            }


            if ($section2_from_page) {
                for ($i = $section2_from_page; $i <= $section2_to_page; $i++) {
                    $pages[] = array(
                        'attr' => $this->get_pager_link_attr(),
                        'label' => $i,
                        'selected' => ($i != $page ? false : true)
                    );
                }
                if ($variation >= 1) {
                    $pages[] = array('label' => '...', 'selected' => false);
                }
            }


            for ($i = $section3_from_page; $i <= $section3_to_page; $i++) {
                $pages[] = array(
                    'attr' => $this->get_pager_link_attr(),
                    'label' => $i,
                    'selected' => ($i != $page ? false : true)
                );
            }
        }

        if ($num_pages == $page) {
            $pages[] = array(
                'label' =>  lang('next'). ' &raquo;',
                'selected' => false,
                'page' => $page,
                'attr' => $this->get_pager_link_attr()
            );
        } else {
            $pages[] = array(
                'label' =>  lang('next'). ' &raquo;',
                'selected' => false,
                'page' => $page + 1,
                'attr' => $this->get_pager_link_attr()
            );
        }

        /*
          $pages[] = array(
          'label' => '>>', //label is >>
          'selected' => false,
          'page' => $section3_to_page,
          'attr' => " class='total-next' "
          );
         */

        return $pages;
    }

    public function handle_query_string() {
        $url = explode('?', $this->url);
        $matches = array();
        preg_match("/^[?].*/", $this->url, $matches);
        if (empty($matches)) {
            $this->set_url($url[0]);
        }
        if (isset($url[1]) AND $url[1]) {
            parse_str($url[1], $query_string_array);
            unset($query_string_array[$this->get_page_label()]);
            $query_string = http_build_query($query_string_array);
            $this->set_query_string($query_string);
        }
    }

}
