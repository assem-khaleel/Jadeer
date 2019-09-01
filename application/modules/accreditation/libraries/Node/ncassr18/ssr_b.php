<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\ncassr18;

/**
 * Description of ssr_b
 *
 * @author duaa
 */
class Ssr_B extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'B. Program Profile Information';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    function init()
    {
        parent::init();

        $this->set_annual();
        $this->set_historical_summary('');
        $this->set_foundation_program();
        $this->set_preparatory_program('');
        $this->set_preparatory_program_offered('');
        $this->set_foundation_year_program('');
        $this->set_academic_credits('');
        $this->set_total_credits('');
        $this->set_note();
        $this->set_courses('');
        $this->set_summary('');

    }


    public function set_annual()
    {
        $property = new \Orm_Property_Fixedtext('annual', '<strong>Annual Program Profile: </strong>NCAAA requires all programs to annually update their profile information using the Annual Program Profile, template T1.P. Institutional profile information is provided on the Annual Institutional Profile, template T1.I. This information is considered part of the SSRP and is available to the public on the NCAAA website.<br/>'
        . '<strong>Historical Summary</strong><br/>Provide a brief historical summary of the program including such things as:'
        . '<ul>'
        . '<li>when and why it was introduced</li>'
        . '<li>student enrollment history</li>'
        . '<li>relationships with industry or professional advisory groups</li>'
        . '<li>graduate employment outcomes</li>'
        . '<li>major program changes.</li>'
        . '</ul>'
        . 'Include brief comments about what are believed to be the programs main strengths and accomplishments and any significant problems or concerns that are being addressed.');
        $this->set_property($property);

    }

    public function get_annual()
    {

        return $this->get_property('annual')->get_value();

    }

    public function set_historical_summary($value)
    {
        $property = new \Orm_Property_Textarea('historical_summary', $value);
        $this->set_property($property);

    }

    public function get_ahistorical_summary()
    {

        return $this->get_property('historical_summary')->get_value();

    }


    public function set_foundation_program()
    {
        $property = new \Orm_Property_Fixedtext('foundation_program', '<strong>Preparatory or Foundation Program</strong>');
        $this->set_property($property);

    }

    public function get_foundation_program()
    {
        return $this->get_property('foundation_program')->get_value();
    }

    public function set_preparatory_program($value)
    {
        $property = new \Orm_Property_Radio('preparatory_program', $value);
        $property->set_description('Do you offer a preparatory program');
        $property->set_options(array('Yes', 'No'));
        $this->set_property($property);
    }

    public function get_preparatory_program()
    {
        return $this->get_property('preparatory_program')->get_value();
    }

    public function set_preparatory_program_offered($value)
    {
        $property = new \Orm_Property_Radio('preparatory_program_offered', $value);
        $property->set_description('If yes, is the preparatory program offered out-sourced?');
        $property->set_options(array('Yes', 'No'));
        $this->set_property($property);
    }

    public function get_preparatory_program_offered()
    {
        return $this->get_property('preparatory_program_offered')->get_value();
    }

    public function set_foundation_year_program($value)
    {
        $property = new \Orm_Property_Radio('foundation_year_program', $value);
        $property->set_description('If a preparatory or foundation year program is provided prior to entry to this program, are all students required to take that program?');
        $property->set_options(array('Yes', 'No'));
        $this->set_property($property);
    }

    public function get_foundation_year_program()
    {
        return $this->get_property('foundation_year_program')->get_value();
    }

    public function set_academic_credits($value)
    {
        $property = new \Orm_Property_Text('academic_credits', $value);
        $property->set_description('If yes, how many Academic credits are granted into the program and included in the * GPA');
        $this->set_property($property);
    }

    public function get_academic_credits()
    {
        return $this->get_property('academic_credits')->get_value();
    }

    public function set_total_credits($value)
    {
        $property = new \Orm_Property_Text('total_credits', $value);
        $property->set_description('What is the total number of credits required by the program?');
        $this->set_property($property);
    }

    public function get_total_credits()
    {
        return $this->get_property('total_credits')->get_value();
    }

    public function set_note(){
        $property = new \Orm_Property_Fixedtext('note','<strong>NOTE:  * Credits granted into the program must be included in the GPA </strong>');
        $this->set_property($property);
    }

    public function get_note(){
        return $this->get_property('note')->get_value();
    }

    public function set_courses($value){
        $property = new \Orm_Property_Textarea('courses', $value);
        $property->set_description('List the courses that are granted into the program.');
        $this->set_property($property);
    }

    public function get_courses(){
        return $this->get_property('courses')->get_value();
    }

    public function set_summary($value){
        $property = new \Orm_Property_Textarea('summary', $value);
        $property->set_description(' Statistical Summary');
        $this->set_property($property);
    }

    public function get_summary(){
        return $this->get_property('summary')->get_value();
    }

}