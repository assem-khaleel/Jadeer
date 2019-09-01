<?php

class Orm_Property_Checkbox extends Orm_Property
{

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<div class="chackbox">';
        $html .= '<input type="hidden" name="properties[' . htmlfilter($this->get_name()) . ']" id="' . htmlfilter($this->get_id()) . '_hidden" ' . ($this->get_value() ? 'value="1"' : 'value="0"') . '/>';
        $html .= '<input type="checkbox" ' . ($this->get_value() ? 'checked="checked"' : '') . ' onchange="if($(this).is(\':checked\')) {$(\'#' . htmlfilter($this->get_id()) . '_hidden\').val(1)} else {$(\'#' . htmlfilter($this->get_id()) . '_hidden\').val(0)}" />';
        $html .= Validator::get_html_error_message($this->get_id());
        $html .= '</div>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        $inner_html = '';
        if ($this->get_description()) {
            $inner_html = ': ';
        }
        $inner_html .= ($this->get_value() ? lang('Yes') : lang('No'));

        return $this->draw_report_wrapper($inner_html);
    }

}
