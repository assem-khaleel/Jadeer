<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 30/03/17
 * Time: 11:45 ص
 */

namespace Node\abet_cac;


class Appendix_B  extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Appendix B – Faculty Vitae';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_faculty_qualifications();
        $this->set_faculty_vitae_text('');
        $this->set_faculty_vitae('');



    }

    public function set_faculty_qualifications()
    {
        $property = new \Orm_Property_Fixedtext('faculty_qualifications', 'Please use the following format for the faculty vitae (2 pages maximum in Times New Roman 12 point type)'
            . '<ol type="1">'
            . '<li>Name</li>'
            . '<li>Education – degree, discipline, institution, year</li>'
            . '<li>Academic experience – institution, rank, title (chair, coordinator, etc. if appropriate), when (ex. 1990-1995), full time or part time</li>'
            . '<li>Non-academic experience – company or entity, title, brief description of position, when (ex. 1993-1999), full time or part time</li>'
            . '<li>Certifications or professional registrations</li>'
            . '<li>Current membership in professional organizations</li>'
            . '<li>Honors and awards</li>'
            . '<li>Service activities (within and outside of the institution)</li>'
            . '<li>Briefly list the most important publications and presentations from the past five years – title, co-authors if any, where published and/or presented, date of publication or presentation</li>'
            . '<li>Briefly list the most recent professional development activities</li>'
            . '</ol>');
        $this->set_property($property);
    }

    public function get_faculty_qualifications()
    {
        return $this->get_property('faculty_qualifications')->get_value();
    }

    public function set_faculty_vitae_text($value)
    {
        $property = new \Orm_Property_Textarea('faculty_vitae_text', $value);
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_faculty_vitae_text()
    {
        return $this->get_property('faculty_vitae_text')->get_value();
    }

    public function set_faculty_vitae($value)
    {
        $property = new \Orm_Property_Upload('faculty_vitae', $value);
        $property->set_group('group_a');
        $this->set_property($property);
    }

    public function get_faculty_vitae()
    {
        return $this->get_property('faculty_vitae')->get_value();
    }

}