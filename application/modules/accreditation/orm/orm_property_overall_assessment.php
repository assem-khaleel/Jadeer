<?php

class Orm_Property_Overall_Assessment extends Orm_Property
{

    protected $node;
    protected $property_names;
    private $cached_properties = null;

    public function add_property_name($value)
    {
        $this->property_names[] = $value;
    }

    public function get_property_names()
    {
        return $this->property_names;
    }

    public function set_node(Orm_Node $value)
    {
        $this->node = $value;
    }

    public function get_node()
    {
        return $this->node;
    }

    /**
     * @return Orm_Property_Rank_Applicable []
     */
    public function get_properties()
    {

        if (is_null($this->cached_properties)) {

            $properties = array();
            foreach ($this->get_property_names() as $property_name) {
                $property = $this->get_node()->get_property($property_name);
                if ($property instanceof Orm_Property_Rank_Applicable) {
                    $properties[$property_name] = $property;
                }
            }

            $this->cached_properties = $properties;
        }

        return $this->cached_properties;
    }

    public function validat()
    {

        $sum = 0;
        $total = 0;
        foreach ($this->get_properties() as $property) {
            $score = floatval($property->get_specific_value('score'));
            $applicable = $property->get_specific_value('applicable');

            if ($applicable != 'N/A') {
                $sum += $score;
                $total += 1;
            }
        }

        $result = ($total ? ($sum / $total) : 0);
        $this->set_value(round($result, 2));
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<input type="text" class="form-control" readonly="readonly" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . ((float)$this->get_value()) . '" />';

        $function_name = 'equation_' . $this->get_name();

        $html .= '<script>';
        $html .= "{$function_name}();" . "\n";
        foreach ($this->get_properties() as $property) {
            $html .= "$('#{$property->get_id()}').change(function() { {$function_name}(); });" . "\n";
        }
        $html .= "\n";
        $html .= "function {$function_name}() {" . "\n";
        $html .= "var sum = 0;" . "\n";
        $html .= "var total = 0;" . "\n";
        foreach ($this->get_properties() as $name => $property) {
            $html .= "if($('#{$property->get_id()}_applicable').val() != 'N/A') {" . "\n";
            $html .= "var val_{$name} = parseFloat($('#{$property->get_id()}').val());" . "\n";
            $html .= "val_{$name} = (isNaN(val_{$name}) ? 0 : val_{$name});" . "\n";
            $html .= "sum += val_{$name};" . "\n";
            $html .= "total += 1;" . "\n";
            $html .= "}" . "\n";
        }
        $html .= "var overall = (total ? (sum/total) : 0);" . "\n";
        $html .= "$('#{$this->get_id()}').val((overall).toFixed(2));" . "\n";
        $html .= "}" . "\n";
        $html .= '</script>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {

        $html = '<div class="well well-sm clearfix">';
        $html .= round(floatval($this->get_value()), 2);
        $html .= '</div>';

        return $this->draw_report_wrapper($html);
    }

}
