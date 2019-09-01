<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_2_requirments_1
 *
 * @author laith
 */
class Asiinp_2_Requirements_1 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '2.1 Educational objectives and learning outcomes';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'Comprehensible and precisely formulated educational objectives and learning outcomes for a programme are the basis and key reference framework for the development of the programmes within institutions of higher education and for accreditation. <br/>'
            . ' <br/> <br/>Educational objectives describe the academic, technical and – as far as these can be stated – professional characteristics of the qualification associated with a programme. The educational objectives are concretely specified in the form of the (intended) learning outcomes. ASIIN’s assessment method focuses on the learning outcomes of a programme.'
            . ' <br/> <br/>The following definitions, drawing on the European Framework for Lifelong Learning, are used within ASIIN’s requirements for degree programmes:'
            . '<ul type="circle">'
            . '<li>“Qualification” means a formal outcome of an assessment and validation process which is obtained when a competent body determines that an individual has achieved learning outcomes to given standards.</li>'
            . '<li>“Learning outcomes” means statements of what a learner knows, understands and is able to do on completion of a learning process and are defined in terms of knowledge, skills and competence.</li>'
            . '<li>“Knowledge” means the outcome of the assimilation of information through learning (theoretical and/or factual).</li>'
            . '<li>“Skills” means the ability to apply knowledge and use know-how to complete tasks and solve problems (cognitive skills such as the use of logical, intuitive and creative thinking), and practical skills (involving manual dexterity and the use of methods, materials, tools and instruments).</li>'
            . '<li>“Competence” means the proven ability to use knowledge, skills and personal, social and/or methodological abilities, in work or study situations and in professional and/or personal development.</li>'
            . '</ul>'
            . ' <br/>Learning outcomes may be attained through various forms of teaching and learning. For example, social competences can also be acquired in an integrated form in the context of subject-related teaching, particularly through interdisciplinary projects.'
            . ' <br/> <br/>The learning outcomes (knowledge, skills, competences) which the degree programme aims to impart have to be clearly defined by the higher education institution, which should be sure to take account of both subject-specific and broader competences. Taking the competences to be acquired as a starting point, it should be explained how the specific competences can be acquired through which aspects of the programme (content and form of the modules, teaching and learning methods, etc.). The central aspect of the higher education institution’s self-assessment is therefore to explain the relation between:'
            . '<ul type="circle"><li>the overall intended learning outcomes (knowledge, skills, competences) of a degree programme and</li>'
            . '<li>the contribution made by individual modules to implementing these goals.</li></ul>'
            . ' <br/>ASIIN’s subject-specific criteria (SSC) contain lists of characteristically ideal learning outcomes for various subject areas. These provide orientation for the possible aims and results of a degree programme. The selection of the specific catalogue for a programme and the type of route required to achieve these goals is a matter for the higher education institutions.'
            . ' <br/> <br/>The competence profiles for graduates of Bachelor’s and Master’s programmes as shown in ASIIN’s subject-specific criteria have been checked against a series of reference frameworks within a European context, for instance with both the Dublin Descriptors 2 and the general qualification profiles laid down at European and national level; they represent a subject- specific version of this underlying basis. For engineering subjects, for instance, the competence profiles for engineers (EUR-ACE label 3 ) developed through collaboration at the European level were taken into consideration; in the case of chemistry the competence profiles of the “Eurobachelor/Euromaster in Chemistry” label 4 were used, and for informatics, the profiles of the “Euro-Inf” label.');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
