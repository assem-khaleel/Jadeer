<?php

/**
 * E.G
 *
 * public function set_users($value) {
 * $property = new \Orm_Property_Add_More('users', $value);
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
class Orm_Property_Add_More extends Orm_Property
{

    protected $properties = array();
    protected $value = array();

    public function add_property(Orm_Property $property)
    {
        $this->properties[$property->get_name()] = $property;
    }

    public function get_properties()
    {
        return $this->properties;
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

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        // return default field <name>: <textfield>

        $html = '<div id="more_' . htmlfilter($this->get_id()) . '" class="more_items">';
        if ($this->get_value()) {
            foreach ($this->get_value() as $key => $value) {
                if ($this->get_properties() && $value) {
                    $html .= '<div class="item">';
                    foreach ($this->get_properties() as $name => $property) {
                        $property->set_name("{$this->get_name()}][{$key}][{$name}");
                        $property->set_value($this->get_specific_value($key, $name));
                        $html .= $property->draw_html();
                    }
                    if ($key) {
                        $html .= '<button type="button" class="btn" aria-label="Left Align" onclick="remove_option_' . htmlfilter($this->get_id()) . '(this);" >';
                        $html .= '<span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span> Remove';
                        $html .= '</button>';
                    }
                    $html .= '</div>';
                }
            }
        } else {
            if ($this->get_properties()) {
                $html .= '<div class="item">';
                foreach ($this->get_properties() as $name => $property) {
                    $property->set_name("{$this->get_name()}][0][{$name}");
                    $html .= $property->draw_html();
                }
                $html .= '</div>';
            }
        }
        $html .= '</div>';

        $html .= '<div class="more_link">';
        $html .= '<button type="button" class="btn" aria-label="Left Align" onclick="add_more_' . htmlfilter($this->get_id()) . '();" >';
        $html .= '<span class="btn-label-icon left fa fa-plus" aria-hidden="true"></span> '.lang('Add').' '.lang('More');
        $html .= '</button>';
        $html .= '</div>';

        $html .= '<script type="text/javascript">';
        // add
        $html .= 'function add_more_' . htmlfilter($this->get_id()) . '(){';
        $html .= "var count = new Date().getTime();";
        $html .= "$('#more_" . htmlfilter($this->get_id()) . "').append('";
        if ($this->get_properties()) {
            $html .= '<div class="item">';
            foreach ($this->get_properties() as $name => $property) {
                $property->set_name("{$this->get_name()}][%%+count+%%][{$name}");
                $property->set_value('');
                $html .= str_replace(array("\\", "'", "%%", "</script>"), array("\\\\", "\'", "'", "<\/script>"), $property->draw_html());
            }
            $html .= '<button type="button" class="btn" aria-label="Left Align" onclick="remove_option_' . htmlfilter($this->get_id()) . '(this);" >';
            $html .= '<span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span> Remove';
            $html .= '</button>';
            $html .= '</div>';
        }
        $html .= "');";
        $html .= 'rename_' . htmlfilter($this->get_id()) . '();';
        $html .= '}';
        // remove
        $html .= 'function remove_option_' . htmlfilter($this->get_id()) . '(element){';
        $html .= "$(element).parent('.item').find('textarea').each(function (index){";
        $html .= "tinymce.remove(this);";
        $html .= "});";
        $html .= "$(element).parent('.item').remove();";
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
        $html .= "if ($(parent_item).length) {";
        $html .= "return get_map_" . htmlfilter($this->get_id()) . "(parent_item, map);";
        $html .= '} else {';
        $html .= 'return map;';
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

        $html = '<div class="more_items">';

        if ($this->get_value()) {
            foreach ($this->get_value() as $key => $value) {
                if ($this->get_properties() && $value) {
                    $html .= '<div class="item">';
                    foreach ($this->get_properties() as $name => $property) {
                        $property->set_value($this->get_specific_value($key, $name));
                        $html .= $property->draw_report($pdf);
                    }

                    $html .= '</div>';
                }
            }
        } else {
            if ($this->get_properties()) {
                $html .= '<div class="item">';
                foreach ($this->get_properties() as $name => $property) {
                    $html .= $property->draw_report($pdf);
                }
                $html .= '</div>';
            }
        }
        $html .= '</div>';

        return $this->draw_report_wrapper($html);
    }

}
