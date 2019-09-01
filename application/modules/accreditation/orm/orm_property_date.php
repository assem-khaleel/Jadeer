<?php

class Orm_Property_Date extends Orm_Property
{

    protected $min_date = NULL;
    protected $max_date = NULL;

    /**
     *  here will be the min date parameter accordingly with the jquery UI
     * look at date datepicker min max date restrictions for more info
     * http://jqueryui.com/datepicker/#min-max
     * @param string $min_date [optional] <p>Set min date for the jquery UI datepicker function</p>
     */
    public function set_min_date($min_date = NULL)
    {
        $this->min_date = $min_date;
    }

    /**
     *  here will be the max date parameter accordingly with the jquery UI
     * look at date datepicker min max date restrictions for more info
     * http://jqueryui.com/datepicker/#min-max
     * @param string $max_date [optional] <p>Set max date for the jquery UI datepicker function</p>
     */
    public function set_max_date($max_date = NULL)
    {
        $this->max_date = $max_date;
    }

    /**
     *  After setting optional parameters through setter functions this
     * function will be called in the view. All the HTML will be generated here
     * no need to modify it in the view.
     */
    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<input type="text" readonly="readonly" class="form-control" name="properties[' . htmlfilter($this->get_name()) . ']" id="' . htmlfilter($this->get_id()) . '" value="' . htmlfilter($this->get_value()) . '" />';

        $html .= '<script>';
        $html .= '$(function() {';
        $html .= '$( "#' . htmlfilter($this->get_id()) . '" ).datepicker(' . $this->get_date_picker_options() . ').on(\'hide\', function(event) {
event.preventDefault();
event.stopPropagation();
});';
        $html .= '});';
        $html .= '</script>';

        return $this->draw_html_wrapper($html);
    }

    public function get_date_picker_options()
    {

        $options = array();
        $options[] = "format: 'yyyy-mm-dd', autoclose: true";
        if (isset($this->min_date)) {
            $options[] = "startDate: " . $this->min_date;
        }
        if (isset($this->max_date)) {
            $options[] = "endDate: " . $this->max_date;
        }

        $date_picker_params = '';
        if ($options) {
            $date_picker_params .= "{";
            $date_picker_params .= implode(', ', $options);
            $date_picker_params .= "}";
        }

        return $date_picker_params;
    }

}
