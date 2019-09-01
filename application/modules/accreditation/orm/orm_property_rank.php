<?php

class Orm_Property_Rank extends Orm_Property
{

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $filter_id = htmlfilter($this->get_id());
        $filter_name = htmlfilter($this->get_name());

        $property_id = "{$filter_id}_rank";
        $property_name = "properties[{$filter_name}]";

        $html = '<div class="well well-sm clearfix">';
        $html .= '<div class="widget-rating" style="font-size: 19px">';
        foreach ([5,4,3,2,1] as $rating) {
            $checked = intval($this->get_value()) == $rating ? 'checked="checked"' : '';

            $html .= <<<HTML
            <input type="radio" value="{$rating}" name="{$property_name}" {$checked} id="{$property_id}_star-{$rating}">
            <label for="{$property_id}_star-{$rating}"><i class="fa fa-star"></i></label>
HTML;
        }
        $html .= '</div>';
        $html .= '</div>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {

        $filter_id = htmlfilter($this->get_id());
        $filter_name = htmlfilter($this->get_name());

        $property_id = "{$filter_id}_rank";
        $property_name = "properties[{$filter_name}]";

        $html = '<div class="well well-sm clearfix">';
        $html .= '<div class="widget-rating" style="font-size: 16px">';
        foreach ([5,4,3,2,1] as $rating) {
            $checked = intval($this->get_value()) == $rating ? 'checked="checked"' : '';

            $html .= <<<HTML
            <input type="radio" value="{$rating}" {$checked} disabled="disabled" id="{$property_id}_star-{$rating}">
            <label for="{$property_id}_star-{$rating}"><i class="fa fa-star"></i></label>
HTML;
        }
        $html .= '</div>';
        $html .= '</div>';

        return $this->draw_report_wrapper($html);
    }

}
