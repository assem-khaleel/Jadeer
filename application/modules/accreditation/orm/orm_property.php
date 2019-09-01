<?php

class Orm_Property extends Orm
{

    protected $id = '';
    protected $name = '';
    protected $value = null;
    protected $group = '';
    protected $description = array();
    protected $hint = '';
    protected $width = 0;
    protected $readonly = false;
    protected $validators = array();
    protected $placeholder = '';

    public function __construct($name, $value = null)
    {
        parent::__construct();

        $this->set_name($name);
        $this->set_value($value);
    }

    public function set_name($value)
    {
        $this->name = $value;

        $this->set_id('property_' . str_replace(array(']['), array('_'), $value));
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_placeholder($value)
    {
        $this->placeholder = $value;
    }

    public function get_placeholder()
    {
        return $this->placeholder;
    }

    public function set_id($value)
    {
        $this->id = $value;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_group($value)
    {
        $this->group = $value;
    }

    public function get_group()
    {
        return $this->group;
    }

    public function set_description($value, $lang = 'english')
    {
        $this->description[$lang] = $value;
    }

    public function get_description($lang = UI_LANG)
    {
        return (empty($this->description[$lang]) ? (isset($this->description['english']) ? $this->description['english'] : '') : $this->description[$lang]);
    }

    public function set_hint($value)
    {
        $this->hint = $value;
    }

    public function get_hint()
    {
        return $this->hint;
    }

    public function set_value($value)
    {
        $this->value = $value;
    }

    public function get_value()
    {
        return $this->value;
    }

    public function set_width($value)
    {
        $this->width = intval($value);
    }

    public function get_width()
    {
        return $this->width;
    }

    public function set_readonly($value)
    {
        $this->readonly = boolval($value);
    }

    public function get_readonly()
    {
        return $this->readonly;
    }

    public function add_validator($function_name, $params = array())
    {
        if (method_exists(new Validator(), $function_name)) {
            $this->validators[$function_name] = $params;
        }
    }

    public function get_validators()
    {
        return $this->validators;
    }

    public function validat()
    {
        foreach ($this->get_validators() as $function_name => $params) {

            $params['field_name'] = $this->get_id();
            $params['value'] = $this->get_value();

            $reflection = new ReflectionClass('Validator');
            $function_params = $reflection->getMethod($function_name)->getParameters();

            $result = array();
            foreach ($function_params as $param) {
                if (isset($params[$param->getName()])) {
                    $result[] = $params[$param->getName()];
                } else if ($param->isOptional()) {
                    $result[] = $param->getDefaultValue();
                }
            }

            call_user_func_array(array('Validator', $function_name), $result);
        }
    }

    /**
     *  After setting optional parameters through setter functions this
     * function will be called in the view. All the HTML will be generated here
     * no need to modify it in the view. Each property will need to override
     * this function to generate the appropriate html code.
     */
    public function draw_html()
    {
        // return default field <name>: <textfield>
    }

    public function draw_html_wrapper($inner_html = '')
    {
        $html = '<div class="form-group"' . ($this->get_width() ? (' style="width: ' . $this->get_width() . 'px;"') : '') . '>';

        if ($this->get_description()) {
            $html .= '<div class="row valign-middle" >';
            $html .= '<label for="' . htmlfilter($this->get_id()) . '" class="control-label ' . ($this->get_hint() ? 'col-md-11' : 'col-md-12') . '">' . nl2br(htmlfilter($this->get_description())) . '</label>';
            if ($this->get_hint()) {
//                $html .= '<div class="text-right">';
                $html .= '<button type="button" class="btn popover-primary btn-sm pull-right" id="popover-'.htmlfilter($this->get_id()).'" style="margin-bottom: 5px; margin-top: -5px; margin-right: 15px;" data-toggle="popover" data-placement="left" data-content="'.$this->get_hint().'" data-title="'.htmlfilter('Help').'" data-original-title="" title="">'.htmlfilter('Help').'</button>';
//                $html .= '</div>';
                $html .= '<div class="clearfix"></div>';
                $html .= "<script> $('#popover-{$this->get_id()}').popover({html : true}); </script>";
            }
            $html .= '</div>';
        }

        $html .= $inner_html;
        $html .= Validator::get_html_error_message($this->get_id());
        //$html .= '<p>'.$this->get_name().'</p>';
        $html .= '</div>';

        return $html;
    }

    public function draw_report($pdf = false)
    {
        $inner_html = '';
        if ($this->get_description()) {
            $inner_html = ': ';
        }
        $inner_html .= htmlfilter($this->get_value());

        return $this->draw_report_wrapper($inner_html);
    }

    public function draw_report_wrapper($inner_html = '')
    {

        //$html = '<div class="form-group"' . ($this->get_width() ? (' style="width: ' . $this->get_width() . 'px;"') : '') . '>';
        $html = '<div class="form-group">';
        if ($this->get_description()) {
            $html .= '<label for="' . htmlfilter($this->get_id()) . '" class="control-label">' . nl2br(htmlfilter($this->get_description())) . '</label>';
        }

        $html .= $inner_html;
        $html .= '</div>';

        return $html;
    }

    public function generate_ams_property(&$ams_form = array(), $ams_file = null, $class_type = null)
    {
        $ams_form[] = array(
            'type' => 'simple',
            'field' => $this->get_ams_id($ams_file, $class_type),
            'value' => $this->get_value()
        );
    }

    public function get_ams_id($ams_file, $class_type, $field_name = '')
    {

        $ams_csv = self::parse_ams_csv($ams_file);

        if (empty($field_name)) {
            $field_name = $this->get_name();
        }

        $explode = explode('\\', $class_type);
        $class_type = end($explode);
        return empty($ams_csv[$class_type][$field_name]) ? "[{$class_type}][{$field_name}]" : $ams_csv[$class_type][$field_name];
    }

    private static $ams_csv;

    public static function parse_ams_csv($file_name)
    {

        $file_path = FCPATH . "files_ams/{$file_name}.csv";

        if (empty(self::$ams_csv[$file_name]) && file_exists($file_path)) {

            $ams_csv = array();

            $file = fopen($file_path, "r");

            $keys = fgetcsv($file);

            if ($keys) {

                $row = 0;
                while (!feof($file)) {
                    if ($row > 0) {
                        $ams_csv[] = array_combine($keys, fgetcsv($file));
                    }
                    $row++;
                }
            }

            fclose($file);

            if ($ams_csv) {
                foreach ($ams_csv as $csv) {
                    if (!empty($csv['Class_ACC']) && !empty($csv['Name_ACC']) && !empty($csv['ID'])) {
                        self::$ams_csv[$file_name][$csv['Class_ACC']][$csv['Name_ACC']] = $csv['ID'];
                    }
                }
            }

            //print_r(self::$ams_csv[$file_name]);
        }

        return self::$ams_csv[$file_name];
    }

}
