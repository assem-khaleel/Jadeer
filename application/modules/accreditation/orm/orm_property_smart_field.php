<?php

/**
 *
 * public function set_smart_field($value) {
 * $property = new \Orm_Property_Smart_Field('smart_field', $value);
 * $property->set_class('orm\node\ncap13\Ses_Standard_1_1');
 * $property->set_function('get_overall_assessment');
 *
 * $this->set_property($property);
 * }
 *
 * public function get_smart_field() {
 * return $this->get_property('smart_field')->get_value();
 * }
 */
class Orm_Property_Smart_Field extends Orm_Property
{

    protected $class;
    protected $function;
    protected $filters = array();

    public function set_class($value)
    {
        if (class_exists($value)) {
            $this->class = $value;
        }
    }

    public function get_class()
    {
        return $this->class;
    }

    public function set_function($value)
    {

        if ($this->get_class() && method_exists($this->get_class(), $value)) {
            $this->function = $value;
        }
    }

    public function get_function()
    {
        return $this->function;
    }

    public function add_filter($filter, $value)
    {
        $this->filters[$filter] = $value;
    }

    public function get_filters()
    {
        return $this->filters;
    }

    public function validat()
    {
        if ($this->get_class() && $this->get_function()) {
            $filters = $this->get_filters();
            $filters['class_type'] = $this->get_class();
            $obj = Orm_Node::get_one($filters);

//            echo('<pre>'.get_class().'</pre>');
//            echo('<pre>');
//            print_r($filters);
//            echo('</pre>');

            $function_name = $this->get_function();
            if ($obj->get_id() && method_exists($obj, $function_name)) {
                $obj->fill_property_values();
                $this->set_value($obj->$function_name());
            }
        }
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }
        $this->validat();

        $html = '<input type="text" class="form-control" readonly="readonly" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" value="' . htmlfilter($this->get_value()) . '" />';
        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {

        $this->validat();

        return parent::draw_report($pdf);
    }

}
