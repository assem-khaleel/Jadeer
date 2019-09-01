<?php

class Orm_Property_Text extends Orm_Property
{

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<input type="text" class="form-control" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . htmlfilter($this->get_value()) . '" '.($this->get_placeholder() ? 'placeholder="'.$this->get_placeholder().'"' : '').'/>';

        return $this->draw_html_wrapper($html);
    }

}
