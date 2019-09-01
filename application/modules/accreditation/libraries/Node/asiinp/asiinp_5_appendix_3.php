<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_5_appendix_3
 *
 * @author laith
 */
class Asiinp_5_Appendix_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '5.3 Example form for Module Handbook';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'A Module Handbook or collection of module descriptions that is also available for students to consult should contain the following information about the individual modules: <br/>'
            . '<table border="1">'
            . '<tr>'
            . '<td>Module designation</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Module level, if applicable</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Code, if applicable</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Subtitle, if applicable</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Courses, if applicable</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Semester(s) in which the module is taught</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Person responsible for the modules</td>'
            . '<td>Please indicate a specific person.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Lecturer</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Language</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Relation to curriculum</td>'
            . '<td>For all programmes, including those running out, in which the module is taught: programme, specialization if applicable, compulsory/elective, semester</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Type of teaching, contact hours</td>'
            . '<td>Contact hours and class size separately for each teaching method: lecture, lesson, practical, project, seminar etc.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Workload</td>'
            . '<td>(Estimated) workload, divided into contact hours (lecture, exercise, laboratory session, etc.) and private study, including examination preparation, specified in hours, and in total.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Credit points</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Requirements according to the examination regulations</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Recommended prerequisites</td>'
            . '<td>E.g. existing competences in ...</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Module objectives/intended learning outcomes</td>'
            . '<td>Key question: what learning outcomes should students attain in the module? <br/> E.g. in terms of: <br/> - Knowledge: familiarity with information, theory and/or subject knowledge <br/> -Skills: cognitive and practical abilities for which knowledge is used <br/> - Competences: integration of knowledge, skills and social and methodological capacities in working or learning situations <br/> E.g.: “Students know that/know how to/are able to...”</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Content</td>'
            . '<td>The description should clearly indicate the weighting of the content and the level.</td>'
            . '</tr>'
            . '<tr>'
            . '<td>Study and examination requirements and forms of examination</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Media employed</td>'
            . '<td></td>'
            . '</tr>'
            . '<tr>'
            . '<td>Reading list</td>'
            . '<td></td>'
            . '</tr>'
            . '</table>');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
