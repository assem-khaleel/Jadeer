<?php

/**
 * E.G
 *
 * public function set_users($value) {
 * $property = new \Orm_Property_Table_Dynamic('users', $value);
 *
 * $name = new \Orm_Property_Text('name');
 * $name->set_description('Name');
 * $property->add_property($name);
 *
 * $email = new \Orm_Property_Text('email');
 * $email->set_description('Email');
 * $property->add_property($email);
 *
 * $this->set_property($property);
 * }
 *
 * public function get_users() {
 * return $this->get_property('users')->get_value();
 * }
 */
class Orm_Property_Table_Dynamic extends Orm_Property
{

    protected $properties = array();
    protected $original_properties = array();
    protected $value = array();
    protected $is_responsive = false;

    public function set_is_responsive($value)
    {
        $this->is_responsive = $value;
    }

    public function get_is_responsive()
    {
        return $this->is_responsive;
    }

    public function add_property(Orm_Property $property)
    {
//        if ($property instanceof Orm_Property_Textarea) {
//            $property->set_enable_tinymce(false);
//        }

        $this->properties[$property->get_name()] = $property;
    }

    /**
     * @return Orm_Property[]
     */
    public function get_properties()
    {
        return $this->properties;
    }

    /**
     * @return Orm_Property[]
     */
    public function get_original_properties()
    {
        return $this->original_properties;
    }

    public function clone_original_properties()
    {
        if (empty($this->original_properties)) {
            foreach ($this->get_properties() as $property) {
                $this->original_properties[$property->get_name()] = clone $property;
            }
        }
    }

    public function get_specific_value($key, $name)
    {
        return (isset($this->value[$key][$name]) ? $this->value[$key][$name] : '');
    }

    public function validat()
    {
        foreach ($this->get_value() as $key => $value) {
            if ($this->get_properties() && $value) {
                foreach ($this->get_properties() as $name => $property) {
                    $property->set_name("{$this->get_name()}][{$key}][{$name}");
                    $property->set_value($this->get_specific_value($key, $name));
                    $property->validat();
                }
            }
        }
    }

    public function draw_thead($show_action = true, $pdf = false)
    {
        $this->clone_original_properties();

        $groups = array();
        $properties = array();

        $is_group = false;

        foreach ($this->get_original_properties() as $property) {

            if ($property->get_group()) {
                $is_group = true;
                if (isset($groups[$property->get_group()])) {
                    $groups[$property->get_group()][] = $property;
                } else {
                    $groups[$property->get_group()][] = $property;
                    $properties[] = &$groups[$property->get_group()];
                }
            } else {
                $properties[] = $property;
            }
        }

        $group_properties = array();

        $html = '<tr>';
        foreach ($properties as $property) {
            /* @var $property Orm_Property */
            if (is_array($property)) {
                foreach ($property as $group_property) {
                    $group_properties[] = $group_property;
                }

                $width = $group_property->get_width() ? (' width:' . ($pdf ? ($group_property->get_width() / 2) : $group_property->get_width()) . 'px;') : '';
                $style = " style='{$width}" . ($pdf ? ' font-size:10px;' : '') . "'";

                $html .= '<td colspan="2"' . $style . '>';
                $html .= $group_property->get_group();
                $html .= '</td>';
            } else {
                $width = $property->get_width() ? (' width:' . ($pdf ? ($property->get_width() / 2) : $property->get_width()) . 'px;') : '';
                $style = " style='{$width}" . ($pdf ? ' font-size:10px;' : '') . "'";

                $html .= '<td' . ($is_group ? ' rowspan="2"' : '') . $style . '>';
                $html .= $property->get_description();
                $html .= '</td>';
            }
        }

        if ($show_action) {
            $html .= '<td' . ($is_group ? ' rowspan="2"' : '') . ' style="width:30px" >Actions</td>';
        }
        $html .= '</tr>';

        if ($is_group) {
            $html .= '<tr>';
            foreach ($group_properties as $group_property) {

                $style = $pdf ? ' style="font-size:10px;"' : '';

                $html .= "<td{$style}>";
                $html .= $group_property->get_description();
                $html .= '</td>';
            }
            $html .= '</tr>';
        }


        return $html;
    }

    public function draw_html()
    {
        // return default field <name>: <textfield>
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '';

        if ($this->get_is_responsive()) {
            $html .= '<p><small style="color: #89cded;">Please scroll right to fill required information</small></p>';
        }

        $html .= '<div class="table-primary table-responsive">';
        $html .= '<table class="table table-striped table-bordered" id="more_' . htmlfilter($this->get_id()) . '" style="margin-bottom: 5px;">';
        $html .= '<thead>';
        $html .= $this->draw_thead();
        $html .= '</thead>';

        $html .= '<tbody>';
        if ($this->get_value()) {
            foreach ($this->get_value() as $key => $value) {
                if ($this->get_properties() && $value) {
                    $html .= '<tr class="item">';
                    foreach ($this->get_properties() as $name => $property) {
                        $property->set_description("");
                        $property->set_name("{$this->get_name()}][{$key}][{$name}");
                        $property->set_value($this->get_specific_value($key, $name));
                        $html .= '<td>';
                        $html .= $property->draw_html();
                        $html .= '</td>';
                    }
                    $html .= '<td style="text-align: center;">';
                    if ($key) {
                        $html .= '<button type="button" class="btn btn-sm" aria-label="Left Align" onclick="remove_option_' . htmlfilter($this->get_id()) . '(this);" >';
                        $html .= '<span class="fa fa-trash-o" aria-hidden="true"></span>';
                        $html .= '</button>';
                    }
                    $html .= '</td>';

                    $html .= '</tr>';
                }
            }
        } else {
            if ($this->get_properties()) {
                $html .= '<tr class="item">';
                foreach ($this->get_properties() as $name => $property) {
                    $property->set_description("");
                    $property->set_name("{$this->get_name()}][0][{$name}");
                    $html .= '<td>';
                    $html .= $property->draw_html();
                    $html .= '</td>';
                }
                $html .= '<td style="text-align: center;"></td>';
                $html .= '</tr>';
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        $html .= '<div>';
        $html .= '<button type="button" class="btn" aria-label="Left Align" onclick="add_more_' . htmlfilter($this->get_id()) . '();" >';
        $html .= '<span class="btn-label-icon left fa fa-plus" aria-hidden="true"></span> '.lang('Add').' '.lang('More');
        $html .= '</button>';
        $html .= '</div>';

        if ($this->get_is_responsive()) {
            $html .= '<p><small style="color: #89cded;">Please scroll right to fill required information</small></p>';
        }

        $html .= '<script type="text/javascript">';
        // add
        $html .= 'function add_more_' . htmlfilter($this->get_id()) . '(){';
        $html .= "var count = new Date().getTime();";
        $html .= "$('#more_" . htmlfilter($this->get_id()) . " > tbody').append('";
        if ($this->get_properties()) {
            $html .= '<tr class="item">';
            foreach ($this->get_properties() as $name => $property) {
                $property->set_description("");
                $property->set_name("{$this->get_name()}][%%+count+%%][{$name}");
                $property->set_value('');
                $html .= '<td>';
                $html .= str_replace(array("\\", "'", "%%", "</script>"), array("\\\\", "\'", "'", "<\/script>"), $property->draw_html());
                $html .= '</td>';
            }
            $html .= '<td style="text-align: center;">';
            $html .= '<button type="button" class="btn btn-sm" aria-label="Left Align" onclick="remove_option_' . htmlfilter($this->get_id()) . '(this);" >';
            $html .= '<span class="fa fa-trash-o" aria-hidden="true"></span>';
            $html .= '</button>';
            $html .= '</td>';
            $html .= '</tr>';
        }
        $html .= "');";
        $html .= 'rename_' . htmlfilter($this->get_id()) . '();';
        $html .= '}';
        // remove
        $html .= 'function remove_option_' . htmlfilter($this->get_id()) . '(element){';
        $html .= "$(element).parent('td').parent('.item').find('textarea').each(function (index){";
        $html .= "tinymce.remove(this);";
        $html .= "});";
        $html .= "$(element).parent('td').parent('.item').remove();";
        $html .= 'rename_' . htmlfilter($this->get_id()) . '();';
        $html .= '}';
        // rename
        $html .= 'function rename_' . htmlfilter($this->get_id()) . '(){';
        $html .= "$('#more_" . htmlfilter($this->get_id()) . "').find('input[name], select[name], textarea[name]').each(function() {";
        $html .= "var map = get_map_" . htmlfilter($this->get_id()) . "($(this).parents('.item').get(0)).reverse();";
        $html .= "var old_name = $(this).attr('name');";
        $html .= "var new_name = get_field_name_" . htmlfilter($this->get_id()) . "(old_name, map);";
        $html .= "$(this).attr('name', new_name);";
        $html .= "});";
        $html .= '}';
        // get map
        $html .= 'function get_map_' . htmlfilter($this->get_id()) . '(item_element, map){';
        $html .= "if(!map) {";
        $html .= "map = [];";
        $html .= "}";
        $html .= "map.push($(item_element).parent().children('.item').index(item_element));";
        $html .= "var parent_item = $(item_element).parents('.item');";
        $html .= "if ($(parent_item).length) {;";
        $html .= "return get_map_" . htmlfilter($this->get_id()) . "(parent_item, map);";
        $html .= '} else {';
        $html .= 'return map';
        $html .= '}';
        $html .= '}';
        // get field name
        $html .= 'function get_field_name_' . htmlfilter($this->get_id()) . '(name, map, parent_name, index, field_name){';
        $html .= "if(!index) {";
        $html .= "index = 0;";
        $html .= "}";
        $html .= "if(!field_name) {";
        $html .= "field_name = '';";
        $html .= "}";
        $html .= "var patt = new RegExp(/\[\d+\]/);";
        $html .= "if(parent_name) {";
        $html .= "name = name.replace(parent_name, '');";
        $html .= "name = name.replace(patt, '');";
        $html .= "}";
        $html .= "parent_name = name.substr(0, name.indexOf(name.match(patt)));";
        $html .= "if(patt.test(name)) {";
        $html .= "field_name += parent_name +'['+ map[index] +']';";
        $html .= "index++;";
        $html .= "return get_field_name_" . htmlfilter($this->get_id()) . "(name, map, parent_name, index, field_name);";
        $html .= "} else {";
        $html .= "field_name += name;";
        $html .= "return field_name;";
        $html .= "}";
        $html .= '}';
        $html .= '</script>';

        return $this->draw_html_wrapper($html);
    }

    public function draw_report($pdf = false)
    {
        if ($pdf) {
            foreach ($this->get_properties() as $property) {
                $width = ($property->get_width() / 2);
                $property->set_width($width);
            }
        }

        $responsive = $pdf ? '' : ' table-responsive';

        $style = $pdf ? " style='font-size:8px;'" : '';

        $html = "<style>thead, tfoot { display: table-row-group }</style>";
        $html .= '<div class="table-primary '.$responsive.'">';
        $html .= '<table class="table table-striped table-bordered" border="1">';
        $html .= '<thead class="bg-theme">';
        $html .= $this->draw_thead(false, $pdf);
        $html .= '</thead>';

        $html .= '<tbody>';
        if ($this->get_value()) {
            foreach ($this->get_value() as $key => $value) {
                if ($this->get_properties() && $value) {
                    $html .= '<tr class="item">';
                    foreach ($this->get_properties() as $name => $property) {
                        $property->set_description("");
                        $property->set_value($this->get_specific_value($key, $name));
                        $html .= "<td{$style}>";
                        $html .= $property->draw_report($pdf);
                        $html .= '</td>';
                    }

                    $html .= '</tr>';
                }
            }
        } else {
            if ($this->get_properties()) {
                $html .= '<tr class="item">';
                foreach ($this->get_properties() as $name => $property) {
                    $property->set_description("");
                    $html .= "<td{$style}>";
                    $html .= $property->draw_report($pdf);
                    $html .= '</td>';
                }
                $html .= '</tr>';
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        return $this->draw_report_wrapper($html);
    }

    public function generate_ams_property(&$ams_form = array(), $ams_file = null, $class_type = null)
    {

        $ams_table = array();
        $index = 0;
        if ($this->get_value()) {
            foreach ($this->get_value() as $key => $value) {
                if ($this->get_properties() && $value) {
                    foreach ($this->get_properties() as $name => $property) {
                        $property->set_value($this->get_specific_value($key, $name));
                        $property->generate_ams_property($ams_table[$index], $ams_file, $class_type);
                    }
                }
                $index++;
            }
        } else {
            if ($this->get_properties()) {
                foreach ($this->get_properties() as $property) {
                    $property->generate_ams_property($ams_table[0], $ams_file, $class_type);
                }
            }
        }

        $ams_form[] = array(
            'type' => 'table_dynamic',
            'field' => $this->get_ams_id($ams_file, $class_type),
            'value' => $ams_table
        );
    }
}
