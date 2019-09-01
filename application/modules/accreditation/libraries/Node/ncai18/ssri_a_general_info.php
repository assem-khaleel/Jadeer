<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncai18;

/**
 * Description of Ssri_A_General_Info
 *
 * @author ahmadgx
 */
class Ssri_A_General_Info extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'A. General Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

            $this->set_name_of_institution('');
            $this->set_name_of_rector('');
            $this->set_address_of_rector('');
            $this->set_telephone_of_rector('');
            $this->set_email_of_rector('');
            $this->set_vice_rector(array());
            $this->set_name_of_dean_of_quality_assurance('');
            $this->set_address_of_dean_of_quality_assurance('');
            $this->set_telephone_of_dean_of_quality_assurance('');
            $this->set_email_of_dean_of_quality_assurance('');
    }

    function set_name_of_institution($value)
    {
        $property = new \Orm_Property_Text('name_of_institution', $value);
        $property->set_description('Name of institution');
        $this->set_property($property);
    }

    function get_name_of_institution()
    {
        return $this->get_property('name_of_institution')->get_value();
    }

    /*
     * rector
     */

    public function set_name_of_rector($value)
    {
        $property = new \Orm_Property_Text('name_of_rector', $value);
        $property->set_description('Name of rector');
        $property->set_group('rector_information');
        $this->set_property($property);
    }

    public function get_name_of_rector()
    {
        return $this->get_property('name_of_rector')->get_value();
    }

    public function set_address_of_rector($value)
    {
        $property = new \Orm_Property_Text('address_of_rector', $value);
        $property->set_description('Address of rector');
        $property->set_group('rector_information');
        $this->set_property($property);
    }

    public function get_address_of_rector()
    {
        return $this->get_property('address_of_rector')->get_value();
    }

    public function set_telephone_of_rector($value)
    {
        $property = new \Orm_Property_Text('telephone_of_rector', $value);
        $property->set_description('Telephone of rector');
        $property->set_group('rector_information');
        $this->set_property($property);
    }

    public function get_telephone_of_rector()
    {
        return $this->get_property('telephone_of_rector')->get_value();
    }

    public function set_email_of_rector($value)
    {
        $property = new \Orm_Property_Text('email_of_rector', $value);
        $property->set_description('Email of rector');
        $property->set_group('rector_information');
        $this->set_property($property);
    }

    public function get_email_of_rector()
    {
        return $this->get_property('email_of_rector')->get_value();
    }

    /*
     * vice rector
     */

    public function set_vice_rector($value)
    {
        $property = new \Orm_Property_Add_More('vice_rector', $value);

        $name_of_vice_Rector = new \Orm_Property_Text('name_of_vice_Rector');
        $name_of_vice_Rector->set_description('Name of Vice Rector/s');
        $property->add_property($name_of_vice_Rector);

        $address_of_vice_rector = new \Orm_Property_Text('address_of_vice_rector');
        $address_of_vice_rector->set_description('Address of Vice Rector');
        $property->add_property($address_of_vice_rector);

        $telephone_of_vice_rector = new \Orm_Property_Text('telephone_of_vice_rector');
        $telephone_of_vice_rector->set_description('Telephone of Vice Rector');
        $property->add_property($telephone_of_vice_rector);

        $email_of_vice_rector = new \Orm_Property_Text('email_of_vice_rector');
        $email_of_vice_rector->set_description('Email of Vice Rector');
        $property->add_property($email_of_vice_rector);

        $this->set_property($property);
    }

    public function get_vice_rector()
    {
        return $this->get_property('vice_rector')->get_value();
    }

    /*
     * dean of qualiry assurance
     */

    public function set_name_of_dean_of_quality_assurance($value)
    {
        $property = new \Orm_Property_Text('name_of_dean_of_quality_assurance', $value);
        $property->set_description('Name of dean of quality assurance');
        $property->set_group('dean_of_quality_assurance_information');
        $this->set_property($property);
    }

    public function get_name_of_dean_of_quality_assurance()
    {
        return $this->get_property('name_of_dean_of_quality_assurance')->get_value();
    }

    public function set_address_of_dean_of_quality_assurance($value)
    {
        $property = new \Orm_Property_Text('address_of_dean_of_quality_assurance', $value);
        $property->set_description('Address of dean of quality assurance');
        $property->set_group('dean_of_quality_assurance_information');
        $this->set_property($property);
    }

    public function get_address_of_dean_of_quality_assurance()
    {
        return $this->get_property('address_of_dean_of_quality_assurance')->get_value();
    }

    public function set_telephone_of_dean_of_quality_assurance($value)
    {
        $property = new \Orm_Property_Text('telephone_of_dean_of_quality_assurance', $value);
        $property->set_description('Telephone of dean of quality assurance');
        $property->set_group('dean_of_quality_assurance_information');
        $this->set_property($property);
    }

    public function get_telephone_of_dean_of_quality_assurance()
    {
        return $this->get_property('telephone_of_dean_of_quality_assurance')->get_value();
    }

    public function set_email_of_dean_of_quality_assurance($value)
    {
        $property = new \Orm_Property_Text('email_of_dean_of_quality_assurance', $value);
        $property->set_description('Email of dean of quality assurance');
        $property->set_group('dean_of_quality_assurance_information');
        $this->set_property($property);
    }

    public function get_email_of_dean_of_quality_assurance()
    {
        return $this->get_property('email_of_dean_of_quality_assurance')->get_value();
    }

    public function after_node_load()
    {
        parent::after_node_load();
        $this->set_name_of_institution(\Orm_Institution::get_university_name('english'));
    }

    public function header_actions(&$actions = array()) {

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            if ($this->check_if_editable()) {
                $actions[] = array(
                    'class' => 'btn',
                    'title' => '<i class="fa fa-database"></i> ' . lang('Integration'),
                    'extra' => 'onclick="integration(this, ' . $this->get_id() . ');" ' . data_loading_text(true) . ' title="Extraction of data from other modules"'
                );
            }
        }

        return parent::header_actions($actions);
    }

    public function integration_processes() {
        parent::integration_processes();

        if (\Orm::get_ci()->config->item('integration_enabled')) {
            $info = \Orm_Data_Institution::get_all(array('academic_year' => $this->get_year()));

            $vice_rector = array();

            foreach ($info as $rector) {
                if ($rector->get_position() == 'rector') {
                    $this->set_name_of_rector($rector->get_full_name());
                    $this->set_address_of_rector($rector->get_address());
                    $this->set_telephone_of_rector($rector->get_telephone());
                    $this->set_email_of_rector($rector->get_email());
                } elseif ($rector->get_position() == 'quality_assurance') {
                    $this->set_name_of_dean_of_quality_assurance($rector->get_full_name());
                    $this->set_address_of_dean_of_quality_assurance($rector->get_address());
                    $this->set_telephone_of_dean_of_quality_assurance($rector->get_telephone());
                    $this->set_email_of_dean_of_quality_assurance($rector->get_email());
                } else {
                    $vice_rector[] = array(
                        'name_of_vice_Rector' => $rector->get_full_name() . ' - ' . $rector->get_position(),
                        'address_of_vice_rector' => $rector->get_address(),
                        'telephone_of_vice_rector' => $rector->get_telephone(),
                        'email_of_vice_rector' => $rector->get_email()
                    );
                }
            }
            $this->set_vice_rector($vice_rector);
            $this->save();
        }
    }

}
