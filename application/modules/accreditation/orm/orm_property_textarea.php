<?php

class Orm_Property_Textarea extends Orm_Property
{

    protected $enable_tinymce = true;
    protected $tinymce_toolbars = array(
        "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | ltr rtl",
        "fontselect | fontsizeselect | forecolor backcolor | link image | print preview"
    );

    public function set_enable_tinymce($value)
    {
        $this->enable_tinymce = (bool)$value;
    }

    public function get_enable_tinymce()
    {
        return $this->enable_tinymce;
    }

    public function set_tinymce_toolbars(array $value)
    {
        $this->tinymce_toolbars = $value;
    }

    public function get_tinymce_toolbars()
    {
        return $this->tinymce_toolbars;
    }

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        // return default field <name>: <textfield>

        $html = '<textarea class="form-control" id="' . htmlfilter($this->get_id()) . '" name="properties[' . htmlfilter($this->get_name()) . ']" >' . xssfilter($this->get_value()) . '</textarea>';

        if ($this->get_enable_tinymce()) {
            $html .= '<script>';
            $html .= 'tinymce.remove("#' . htmlfilter($this->get_id()) . '");';
            $html .= 'tinymce.init({';
            $html .= 'selector: "#' . htmlfilter($this->get_id()) . '",';
            $html .= 'height: 200,';
            $html .= 'theme: "modern",';
            $html .= 'menubar: false,';
            $html .= 'statusbar: false,';
            $html .= 'entity_encoding: "raw",';
            $html .= 'paste_data_images: true,';
            $html .= 'file_browser_callback : elFinderBrowser,';
            $html .= 'font_size_style_values: "12px,13px,14px,16px,18px,20px",';
            $html .= 'relative_urls: false,';
            $html .= 'remove_script_host : false,';
            $html .= 'convert_urls : true,';
            $html .= 'plugins: [';
            $html .= '"advlist lists link image print preview hr anchor pagebreak",';
            $html .= '"nonbreaking table directionality",';
            $html .= '"paste textcolor"';
            $html .= '],';
            foreach ($this->get_tinymce_toolbars() as $key => $toolbar) {
                $html .= 'toolbar' . ($key + 1) . ': "' . $toolbar . '",';
            }
            $html .= '});';
            $html .= '</script>';
        }

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        $value = $this->get_value();
        if ($pdf) {
            $value = str_replace(array('<h1>','<h2>','<h3>','<h4>','<h5>','<h6>'), '<strong>',$this->get_value());
            $value = str_replace(array('</h1>','</h2>','</h3>','</h4>','</h5>','</h6>'), '</strong>',$value);
        }
        return $this->draw_report_wrapper('<div class="tinymce_zero ' . ($this->get_description() ? 'group' : '') . '">' . xssfilter($value) . '</div>');
    }

}
