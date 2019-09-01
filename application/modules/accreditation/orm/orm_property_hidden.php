<?php

class Orm_Property_Hidden extends Orm_Property
{

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<input type="hidden" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . htmlfilter($this->get_value()) . '" '.($this->get_placeholder() ? 'placeholder="'.$this->get_placeholder().'"' : '').'/>';

        return $html;
    }

    //Do Nothing

    public function draw_report($pdf = false)
    {
        //Do Nothing
    }

    public function generate_ams_property(&$ams_form = array(), $ams_file = null, $class_type = null)
    {
        //Do Nothing
    }

}
