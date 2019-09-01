<?php

class Orm_Property_Time extends Orm_Property
{

    protected $min_time = NULL;
    protected $max_time = NULL;

    /**
     *  here will be the min time parameter accordingly with the jquery UI
     * look at time timepicker min max time restrictions for more info
     * http://jqueryui.com/timepicker/#min-max
     * @param string $min_time [optional] <p>Set min time for the jquery UI timepicker function</p>
     */
    public function set_min_time($min_time = NULL)
    {
        $this->min_time = $min_time;
    }

    /**
     *  here will be the max time parameter accordingly with the jquery UI
     * look at time timepicker min max time restrictions for more info
     * http://jqueryui.com/timepicker/#min-max
     * @param string $max_time [optional] <p>Set max time for the jquery UI timepicker function</p>
     */
    public function set_max_time($max_time = NULL)
    {
        $this->max_time = $max_time;
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
        $html .= '$( "#' . htmlfilter($this->get_id()) . '" ).timepicki(' . $this->get_time_picker_options() . ');';
        $html .= '});';
        $html .= '</script>';

        return $this->draw_html_wrapper($html);
    }

    public function get_time_picker_options()
    {

        $time = explode(':', $this->get_value());
        $hour = trim(isset($time[0]) ? $time[0] : '12');
        $minutes = trim(isset($time[1]) ? $time[1] : '00');
        $meridiem = trim(isset($time[2]) ? $time[2] : 'AM');

        $options = array();
        $options[] = "timeFormat: 'H:i:s'";
        $options[] = 'start_time:["' . $hour . '", "' . $minutes . '", "' . $meridiem . '"]';
        if (isset($this->min_time)) {
            $options[] = "min_hour_value: " . $this->min_time;
        }
        if (isset($this->max_time)) {
            $options[] = "max_hour_value: " . $this->max_time;
        }

        $time_picker_params = '';
        if ($options) {
            $time_picker_params .= "{";
            $time_picker_params .= implode(', ', $options);
            $time_picker_params .= "}";
        }

        return $time_picker_params;
    }

}
