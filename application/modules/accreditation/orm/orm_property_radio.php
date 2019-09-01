<?php

class Orm_Property_Radio extends Orm_Property
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

        // return default field <name>: <textfield>
        $html = '<div>';
        foreach ($this->get_options() as $key => $option) {
            $html .= '<div class="radio" >';
            if ($this->get_is_key_value()) {
                $checked = ($key == $this->get_value()) ? 'checked="checked"' : '';
                $html .= '<label><input type="radio" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . $key . '" ' . $checked . '> ' . htmlfilter($option) . '</label>';
            } else {
                $checked = ($option == $this->get_value()) ? 'checked="checked"' : '';
                $html .= '<label><input type="radio" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . htmlfilter($option) . '" ' . $checked . '> ' . htmlfilter($option) . '</label>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

        return $this->draw_html_wrapper($html);
    }

}
