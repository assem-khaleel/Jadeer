<?php

class Orm_Property_Fixedtext extends Orm_Property
{
    protected $text = array();

    public function __construct($name, $text = null, $description = null)
    {
        parent::__construct($name, null);

        $this->set_text($text);

        if (!is_null($description)) {
            $this->set_description($description);
        }
    }

    public function set_text($value, $lang = 'english')
    {
        $this->text[$lang] = $value;
    }

    public function get_text($lang = UI_LANG)
    {
        return (empty($this->text[$lang]) ? (isset($this->text['english']) ? $this->text['english'] : '') : $this->text[$lang]);
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        return $this->draw_html_wrapper(xssfilter($this->get_text()));
    }

    public function draw_report($pdf = false)
    {
        return $this->draw_report_wrapper(xssfilter($this->get_text()));
    }

    public function generate_ams_property(&$ams_form = array(), $ams_file = null, $class_type = null)
    {
        //Do Nothing
    }
}
