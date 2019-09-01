<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 30/03/17
 * Time: 12:30 م
 */

namespace Node\abet_etac;


class Appendix_A extends \Orm_Node
{
    protected $class_type = __CLASS__;
    protected $name = 'Appendix A – Course Syllabi';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

        $this->set_course_syllabi();
        $this->set_syllabi_text('');
        $this->set_syllabi('');
    }


    public function set_course_syllabi()
    {
        $property = new \Orm_Property_Fixedtext('course_syllabi', 'Please use the following format for the course syllabi (2 pages maximum in Times New Roman 12 point font)'
            . '<ol type="1"><li>Course number and name</li>'
            . '<li>Credits and contact hours</li>'
            . '<li>Instructor’s or course coordinator’s name</li>'
            . '<li>Text book, title, author, and year'
            . '<ol type="a"><li> other supplemental materials</li></ol></li>'
            . '<li>Specific course information'
            . '<ol type="a"><li>brief description of the content of the course (catalog description)</li>'
            . '<li>prerequisites or co-requisites</li>'
            . '<li>indicate whether a required, elective, or selected elective (as per Table 5-1) course in the program</li></ol></li>'
            . '<li>Specific goals for the course'
            . '<ol type="a"><li>specific outcomes of instruction, ex. The student will be able to explain the significance of current research about a particular topic.</li>'
            . '<li>explicitly indicate which of the student outcomes listed in Criterion 3 or any other outcomes are addressed by the course.</li></ol></li>'
            . '<li>Brief list of topics to be covered</li></ol>');
        $this->set_property($property);
    }

    public function get_course_syllabi()
    {
        return $this->get_property('course_syllabi')->get_value();
    }

    public function set_syllabi_text($value)
    {
        $property = new \Orm_Property_Textarea('syllabi_text', $value);
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_syllabi_text()
    {
        return $this->get_property('syllabi_text')->get_value();
    }

    public function set_syllabi($value)
    {
        $property = new \Orm_Property_Upload('syllabi', $value);
        $property->set_group('group_b');
        $this->set_property($property);
    }

    public function get_syllabi()
    {
        return $this->get_property('syllabi')->get_value();
    }

}