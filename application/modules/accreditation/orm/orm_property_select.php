<?php

class Orm_Property_Select extends Orm_Property
{

    protected $options = array();
    protected $is_key_value = false;

    public function set_options(array $options)
    {
        $this->options = $options;
    }

    public function get_options()
    {
        return $this->options;
    }

    public function set_is_key_value($value)
    {
        $this->is_key_value = (bool)$value;
    }

    public function get_is_key_value()
    {
        return $this->is_key_value;
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<select class="form-control selectpicker" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" >';
        foreach ($this->get_options() as $key => $option) {
            if ($this->get_is_key_value()) {
                $selected = ($key == $this->get_value()) ? 'selected=selected' : '';
                $html .= '<option value="' . $key . '" ' . $selected . ' >' . htmlfilter($option) . '</option>';
            } else {
                $selected = ($option == $this->get_value()) ? 'selected=selected' : '';
                $html .= '<option value="' . htmlfilter($option) . '" ' . $selected . ' >' . htmlfilter($option) . '</option>';
            }
        }
        $html .= '</select>';

        return $this->draw_html_wrapper($html);
    }

}
