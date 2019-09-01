<?php

class Orm_Property_Rank_Applicable extends Orm_Property
{

    protected $options = array('N/A', 'YES', 'NO');

    public function set_options(array $options)
    {
        $this->options = $options;
    }

    public function get_options()
    {
        return $this->options;
    }

    public function set_value($value)
    {
        $this->value['score'] = (isset($value['score']) ? $value['score'] : 0);
        $this->value['applicable'] = (isset($value['applicable']) ? $value['applicable'] : 'N/A');
    }

    public function get_specific_value($name)
    {
        return (isset($this->value[$name]) ? $this->value[$name] : '');
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $filter_id = htmlfilter($this->get_id());
        $filter_name = htmlfilter($this->get_name());

        $property_name = "properties[{$filter_name}]";

        $html = '<div class="well well-sm clearfix">';

        $html .= '<div class="col-md-4">';
        $html .= '<select class="form-control" id="' . $filter_id . '_applicable" name="' . $property_name . '[applicable]" >';
        foreach ($this->get_options() as $option) {
            $selected = ($option == $this->get_specific_value('applicable')) ? 'selected=selected' : '';
            $html .= '<option value="' . htmlfilter($option) . '" ' . $selected . ' >' . htmlfilter($option) . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';

        $html .= '<div class="col-md-8">';
        $html .= '<div class="widget-rating pull-right" style="font-size: 19px; ' . ($this->get_specific_value('applicable') == 'N/A' ? 'display:none;' : '') . '" id="' . $filter_id . '_rank">';
        foreach ([5,4,3,2,1] as $rating) {
            $checked = intval($this->get_specific_value('score')) == $rating ? 'checked="checked"' : '';

            $html .= <<<HTML
            <input type="radio" value="{$rating}" name="{$property_name}[score]" {$checked} id="{$filter_id}_star-{$rating}" class="{$filter_id}_star">
            <label for="{$filter_id}_star-{$rating}"><i class="fa fa-star"></i></label>
HTML;
        }
        $html .= "<input type='hidden' id='{$filter_id}' value='{$this->get_specific_value('score')}'>";
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        $html .= '<script>';
        $html .= "$('#{$filter_id}_applicable').change(function() {" . "\n";
        $html .= "$('.{$filter_id}_star').removeAttr('disabled');" . "\n";
        $html .= "$('#{$filter_id}_rank').show();" . "\n";
        $html .= 'if($(this).val() == "N/A" || $(this).val() == "NO") {' . "\n";
        $html .= "$('.{$filter_id}_star').attr('disabled', 'disabled');" . "\n";
        $html .= "$('.{$filter_id}_star').removeAttr('checked');" . "\n";
        $html .= "$('#{$filter_id}').val(0).trigger('change');" . "\n";
        $html .= '}' . "\n";
        $html .= 'if($(this).val() == "N/A") {' . "\n";
        $html .= "$('#{$filter_id}_rank').hide();" . "\n";
        $html .= '}' . "\n";
        $html .= '});' . "\n";
        $html .= "\n";
        $html .= "$('input[type=\"radio\"].{$filter_id}_star').click(function() {" . "\n";
        $html .= 'if ($(this).is(":checked")) {' . "\n";
        $html .= "$('#{$filter_id}').val($(this).val()).trigger('change');" . "\n";
        $html .= '}' . "\n";
        $html .= '});' . "\n";
        $html .= '</script>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        $filter_id = htmlfilter($this->get_id());

        $html = '<div class="well well-sm clearfix m-a-0">';

        $html .= '<div class="col-md-4">';
        $html .= '<span style="font-size: 16px;">' . htmlfilter($this->get_specific_value('applicable')) . '</span>';
        $html .= '</div>';

        $html .= '<div class="col-md-8">';
        $html .= '<div class="widget-rating pull-right" style="font-size: 16px; ' . ($this->get_specific_value('applicable') == 'N/A' ? 'display:none;' : '') . '">';
        foreach ([5,4,3,2,1] as $rating) {
            $checked = intval($this->get_specific_value('score')) == $rating ? 'checked="checked"' : '';

            $html .= <<<HTML
            <input type="radio" value="{$rating}" {$checked} disabled="disabled" id="{$filter_id}_star-{$rating}">
            <label for="{$filter_id}_star-{$rating}"><i class="fa fa-star"></i></label>
HTML;
        }
        $html .= '</div>';
        $html .= '</div>';

        $html .= '</div>';

        return $this->draw_report_wrapper($html);
    }

}
