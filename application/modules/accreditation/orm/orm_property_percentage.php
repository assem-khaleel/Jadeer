<?php

class Orm_Property_Percentage extends Orm_Property
{

    public function __construct($name, $value = 0)
    {
        parent::__construct($name, $value);

        $this->add_validator('numeric_field_validator', array('error_msg' => lang('Must Be Real Number')));
        $this->add_validator('greater_than_validator', array('number' => 100, 'error_msg' => lang('Must Be less than 100')));
        $this->add_validator('less_than_validator', array('number' => 0, 'error_msg' => lang('Must Be Greater than 0')));
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }
        
        $html = '<div class="input-group">';
        $html .= '<input type="text" aria-describedby="' . htmlfilter($this->get_id()) . '_addon" class="form-control" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . round(floatval($this->get_value()), 2) . '" />';
        $html .= '<span class="input-group-addon" id="' . htmlfilter($this->get_id()) . '_addon">%</span>';
        $html .= '</div>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        $inner_html = '';
        if ($this->get_description()) {
            $inner_html = ': ';
        }
        $inner_html .= round(floatval($this->get_value()), 2) . ' %';

        return $this->draw_report_wrapper($inner_html);
    }

}
