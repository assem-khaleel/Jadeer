<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\asiinp;

/**
 * Description of asiinp_1_general_3
 *
 * @author laith
 */
class Asiinp_1_General_3 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = '1.3 Accreditation stages and interim changes';
    protected $link_view = true;

    public function init()
    {
        parent::init();

            $this->set_info();
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', 'According to internationally established practice, the accreditation of a programme is always subject to a time limit. The seal granted is valid for a limited period.'
            . ' <br/> <br/>We differentiate among three types of accreditation stages:'
            . '<ol type="1">'
            . '<li>Concept accreditation: The concept for a programme is prepared and all the documents and authorisations needed to put it into practice are available. However, no students are studying the programme yet, so the evaluation as a part of the accreditation procedure is inevitably no more than a plausibility check. Compared to the other stages, concept accreditation is less meaningful with regard to quality assurance, because the data on which the procedure is based is less substantiated and harder to check.</li>'
            . '<li>First accreditation: Students are now studying in the programme, and this is the first time an accreditation procedure is carried out. This makes it possible to base the accreditation procedure assessment on a critical self-assessment by the institution as well as on the actual implementation of the programme.</li>'
            . '<li>Renewed accreditation (reaccreditation): An active programme has already been accredited at least once before. When the validity of the current seal expires, it is time to carry out another accreditation.</li>'
            . '</ol>'
            . ' <br/> <br/>All three types of accreditation are subject to the same criteria inasmuch as the accreditation decisions are comparable. Typically, the seal granted for a first accreditation is valid for a shorter period than those subsequently granted.'
            . ' <br/> <br/>Renewed accreditation (reaccreditation) is the typical situation. Assessment at this stage can increasingly be based on quantitative and qualitative data related to the results achieved over the course of the previous accreditation period. This means that for renewed accreditation, the focus lies on the achievement of the aims defined for the programme by the higher education institution, particularly for educational objectives and learning outcomes. Above all, it is the institution’s quality assurance or quality management system that is expected to provide key evidence that the goals for its degree programmes have been met, and document any deviations.'
            . ' <br/> <br/>ASIIN’s understanding of accreditation aims to support higher education institutions in achieving continuous improvements in their teaching. Improvements within an accreditation period should never be put off until the next accreditation deadline. On the contrary, being able to demonstrate that continuous improvements have been made is essential for the renewal of the accreditation.'
            . ' <br/> <br/>If an institution intends to make major changes to an accredited programme between accreditations, and these go beyond continuous improvement, this may affect the existing accreditation. ASIIN offers an interim auditing option in order to maintain the accreditation (see section 3.8).');
        $property->set_group('section_1');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

}
