<?php

// equation : '[test]*[test_1]/2'

class Orm_Property_Equation extends Orm_Property
{

    protected $equation;
    protected $node;
    private $cached_properties = null;

    public function set_equation($value)
    {
        $this->equation = $value;
    }

    public function get_equation()
    {
        return $this->equation;
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
     * @return Orm_Property []
     */
    public function get_properties()
    {

        if (is_null($this->cached_properties)) {

            $properties = array();

            $matches = array();
            if (preg_match_all('#\[(.*?)\]#', $this->get_equation(), $matches)) {
                foreach ($matches[1] as $property_name) {
                    $properties[$property_name] = $this->get_node()->get_property($property_name);
                }
            }

            $this->cached_properties = $properties;
        }

        return $this->cached_properties;
    }

    public function validat()
    {
        foreach ($this->get_properties() as $name => $property) {
            ${'val_' . $name} = $property->get_value();
        }

        //echo('<pre>'.str_replace(array('[', ']'), array('$val_', ''), $this->get_equation()).'</pre>');

        $result = 0;
        eval('$result = ' . str_replace(array('[', ']'), array('$val_', ''), $this->get_equation()) . ';');

        $this->set_value(round($result, 2));
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<input type="text" class="form-control" readonly="readonly" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . ((float)$this->get_value()) . '" />';

        $function_name = 'equation_' . $this->get_name();
        $equasion = str_replace(array('[', ']'), array('val_', ''), $this->get_equation());

        $html .= '<script>';
        $html .= "{$function_name}();" . "\n";
        foreach ($this->get_properties() as $property) {
            $html .= "$('#{$property->get_id()}').change(function() { {$function_name}(); });" . "\n";
        }
        $html .= "\n";
        $html .= "function {$function_name}() {" . "\n";
        foreach ($this->get_properties() as $name => $property) {
            $html .= "var val_{$name} = parseFloat($('#{$property->get_id()}').val());" . "\n";
            $html .= "val_{$name} = (isNaN(val_{$name}) ? 0 : val_{$name});" . "\n";
        }
        $html .= "$('#{$this->get_id()}').val(({$equasion}).toFixed(2));" . "\n";
        $html .= "}" . "\n";
        $html .= '</script>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        $inner_html = '';
        if ($this->get_description()) {
            $inner_html = ': ';
        }
        $inner_html .= round(floatval($this->get_value()), 2);

        return $this->draw_report_wrapper($inner_html);
    }

}
