<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb;

/**
 * Description of aacsb_section_2_accounting_academic_units_standard_a2
 *
 * @author laith
 */
class Aacsb_Section_2_Accounting_Academic_Units_Standard_A2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard A2';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_info();
            $this->set_guide();
            $this->set_textarea1('');
            //
            $this->set_table_a2_1('');
            $this->set_part_a(array());
            $this->set_part_b('');
            $this->set_quality_description('');
            $this->set_part_c('');
            $this->set_evidence('');
            $this->set_part_d('');
            $this->set_impact('');
            $this->set_note('');
            //
            $this->set_info2();
            $this->set_textarea4('');
            $this->set_textarea5('');
            $this->set_textarea6('');
            $this->set_textarea7('');
            $this->set_textarea8('');
    }

    public function set_info()
    {
        $property = new \Orm_Property_Fixedtext('info', '<strong>The accounting academic unit produces high-quality intellectual contributions that are consistent with its mission, expected outcomes, and strategies and that impact the theory, practice, and teaching of accounting, business, and management. [ACCOUNTING INTELLECTUAL CONTRIBUTIONS’ IMPACT AND ALIGNMENT WITH MISSION-—RELATED BUSINESS STANDARD 2]</strong> <br/> <br/>'
            . '<strong>Definitions</strong> <br/>'
            . '<ul type="circle">'
            . '<li>Intellectual contributions are original works intended to advance the theory, practice, and/or teaching of accounting, business, and management. They are scholarly in the sense that they are based on generally accepted research principles and disseminated to appropriate audiences. Intellectual contributions are a foundation for innovation. Intellectual contributions normally are validated by peers and communicated to appropriate audiences. Validation of the quality of intellectual contributions includes the traditional academic or professional pre-publication peer review, but may encompass other forms of validation, such as online post-publication peer reviews, ratings, surveys of users, etc. Intellectual contributions may fall into any of the following categories:<br/>'
            . '<ul type="square">'
            . '<li>Basic or discovery scholarship (often referred to as discipline-based scholarship) that generates or communicates new knowledge and understanding and/or development of new methods. Intellectual contributions in this category are normally intended to impact the theory, knowledge, and/or practice of accounting, business, and management.</li>'
            . '<li>Applied or integrative/applied scholarship that synthesizes new understandings or interpretations of knowledge or technology; develops new technologies, processes, tools, or uses; and/or refines, develops, or advances new methods based on existing knowledge. Intellectual contributions in this category are normally intended to contribute to and impact the practice of accounting, business and management.</li>'
            . '<li>Teaching and learning scholarship that develops and advances new understandings, insights, and teaching content and methods that impact learning behavior. Intellectual contributions in this category are normally intended to impact the teaching and/or pedagogy of accounting, business, and management.</li>'
            . '</ul>'
            . '</li>'
            . '<li>Impact of intellectual contributions is the advancement of theory, practice, and/or teaching of accounting, business, and management through intellectual contributions. Impact is concerned with the difference made or innovations fostered by intellectual contributions—i.e., what has been changed, accomplished, or improved.</li>'
            . '</ul>'
            . ' <br/> <br/><strong>Basis for Judgment</strong> <br/>'
            . '<ul type="circle">'
            . '<li>The accounting academic unit has produced intellectual contributions that have had an impact on the theory, practice, and/or teaching of accounting, business, and management in ways that are consistent with the mission, expected outcomes, and strategies of the unit.</li>'
            . '<li>The school expresses expectations regarding the impact of intellectual contributions in the mission in ways that are transparent to the public.</li>'
            . '<li>The accounting academic unit applies relevant metrics to assess the extent to which expected impacts from intellectual contributions have been achieved and are aligned with mission.</li>'
            . '<li>The accounting academic unit maintains a current portfolio of high-quality intellectual contributions that could impact theory, practice, and/or teaching. The portfolio of intellectual contributions includes contributions from a substantial cross-section of the faculty in the accounting academic unit. Normally, a significant level of the contributions in the portfolio must be in the form of peer-reviewed journal articles or the equivalent. The portfolio of intellectual contributions must include some representation of basic/discovery, applied, or integrative/applied research, and teaching and learning scholarship outcomes regardless of mission; however, the priorities of the unit reflected in the mission, expected outcomes, and strategies must be evident in the overall portfolio of intellectual contribution outcomes.</li>'
            . '<li>Intellectual contribution expectations and outcomes are clearly linked to the mission, expected outcomes, and underlying strategies of the academic unit and reflect the degree program portfolio delivered by the unit. For example, the profile of intellectual contributions for an accounting academic unit with a significant focus on doctoral education and basic research should reflect the level of scholarship expected of a research-focused program.</li>'
            . '<li>The accounting academic unit documents intellectual contributions that demonstrate high quality and impact, as well as alignment with mission, expected outcomes, and strategies. In documenting quality, the unit produces evidence of high-quality intellectual contributions within the most recent five-year AACSB accreditation review period. In documenting impact, however, the unit may produce evidence from intellectual contributions produced prior to the most recent five-year AACSB accreditation review period, because the review process recognizes that impact often occurs over time.</li>'
            . '<li>The unit periodically reviews and revises the mission, expected outcomes, and strategies as appropriate and engages key stakeholders in the process.</li>'
            . '<li>During the initial three-year implementation period (2013-2016), accounting academic units are expected to make progress toward fully reporting the impact of research and providing the documentation described in this section. Accounting academic units are expected to make progress each year during the implementation period. At the end of the implementation period, accounting academic units should fully satisfy the standard.</li>'
            . '</ul>');
        $this->set_property($property);
    }

    public function get_info()
    {
        return $this->get_property('info')->get_value();
    }

    public function set_guide()
    {
        $property = new \Orm_Property_Fixedtext('guide', '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_guide()
    {
        return $this->get_property('guide')->get_value();
    }

    public function set_textarea1($value)
    {
        $property = new \Orm_Property_Textarea('textarea1', $value);
        $property->set_description('Provide a portfolio of evidence including qualitative and quantitative measures that summarize the portfolio of intellectual contributions over the most recent five-year review period, ending with the most recently completed, normal academic year. This evidence can be enhanced by including validating evidence of the accomplishments of such work. At a minimum, the portfolio of evidence should include: (1) A listing of the outlets (journals, research monographs, published cases, funded and competitive research grants, scholarly presentations, invited presentations, published textbooks, other teaching materials, etc.); (2) an analysis of the breadth of the accounting faculty’s engagement in generating intellectual contributions; (3) awards, recognition, editorships, and other forms of validation of the accomplishments of faculty through their intellectual contributions; and (4) the ways in which the unit conveys intellectual contributions and their outcomes to external constituencies and stakeholders.');
        $this->set_property($property);
    }

    public function get_textarea1()
    {
        return $this->get_property('textarea1')->get_value();
    }

    public function set_table_a2_1()
    {
        $property = new \Orm_Property_Fixedtext('table_a2_1', 'Table A2-1 is divided into four parts. Part A provides a five-year aggregate summary (not by individual faculty member) of intellectual contributions. Part B provides a qualitative description of how the portfolio of intellectual contributions aligns with mission, expected outcomes, and strategy. Part C provides evidence demonstrating the quality of the portfolio of intellectual contributions. Part D provides evidence that the school’s intellectual contributions have had an impact on the theory, practice, and/or teaching of accounting, business, and management. Table A3-1 allows schools the flexibility to develop their own indicators of quality for the portfolio of intellectual contributions. If Table 2-1 in the documentation for the business school accreditation review provides sufficient detail on the intellectual contributions of the accounting academic unit, the peer review team may be referred to that table for documentation.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_table_a2_1()
    {
        return $this->get_property('table_a2_1')->get_value();
    }

    public function set_part_a($value)
    {
        $property = new \Orm_Property_Table_Dynamic('part_a', $value);
        $property->set_description('Part A : Five-Year Summary of Intellectual Contributions');
        $property->set_group('group_1');

        $summarize = new \Orm_Property_Textarea('summarize');
        $summarize->set_description('Aggregate and summarize data to reflect the organizational structure of the unit’s faculty (e.g., research groups). Do not list by individual faculty member.');
        $summarize->set_width(500);
        $summarize->set_enable_tinymce(0);
        $property->add_property($summarize);

        $portfolio_discovery = new \Orm_Property_Text('portfolio_discovery');
        $portfolio_discovery->set_description('Portfolio of Intellectual Contributions (Basic or Discovery Scholarship)');
        $portfolio_discovery->set_width(200);
        $property->add_property($portfolio_discovery);

        $portfolio_integrative = new \Orm_Property_Text('portfolio_integrative');
        $portfolio_integrative->set_description('Portfolio of Intellectual Contributions (Applied or Integrative / Application Scholarship)');
        $portfolio_integrative->set_width(200);
        $property->add_property($portfolio_integrative);

        $portfolio_teaching = new \Orm_Property_Text('portfolio_teaching');
        $portfolio_teaching->set_description('Portfolio of Intellectual Contributions (Teaching and Learning Scholarship)');
        $portfolio_teaching->set_width(200);
        $property->add_property($portfolio_teaching);

        $intellectual_journals = new \Orm_Property_Text('intellectual_journals');
        $intellectual_journals->set_description('Type of Intellectual Contributions (Peer-Reviewed Journals)');
        $intellectual_journals->set_width(200);
        $property->add_property($intellectual_journals);


        $intellectual_research = new \Orm_Property_Text('intellectual_research');
        $intellectual_research->set_description('Type of Intellectual Contributions (Research Monographs)');
        $intellectual_research->set_width(200);
        $property->add_property($intellectual_research);

        $intellectual_academic = new \Orm_Property_Text('intellectual_academic');
        $intellectual_academic->set_description('Type of Intellectual Contributions (Academic/Professional Meeting Proceedings)');
        $intellectual_academic->set_width(200);
        $property->add_property($intellectual_academic);

        $intellectual_competitive = new \Orm_Property_Text('intellectual_competitive');
        $intellectual_competitive->set_description('Type of Intellectual Contributions (Competitive Research Awards Received)');
        $intellectual_competitive->set_width(200);
        $property->add_property($intellectual_competitive);

        $intellectual_textbooks = new \Orm_Property_Text('intellectual_textbooks');
        $intellectual_textbooks->set_description('Type of Intellectual Contributions (Textbooks)');
        $intellectual_textbooks->set_width(200);
        $property->add_property($intellectual_textbooks);

        $intellectual_cases = new \Orm_Property_Text('intellectual_cases');
        $intellectual_cases->set_description('Type of Intellectual Contributions (Cases)');
        $intellectual_cases->set_width(200);
        $property->add_property($intellectual_cases);

        $intellectual_teaching = new \Orm_Property_Text('intellectual_teaching');
        $intellectual_teaching->set_description('Type of Intellectual Contributions (Other Teaching Materials)');
        $intellectual_teaching->set_width(200);
        $property->add_property($intellectual_teaching);

        $intellectual_accounting = new \Orm_Property_Text('intellectual_accounting');
        $intellectual_accounting->set_description('Type of Intellectual Contributions (Type Selected by the Accounting Academic Unit)');
        $intellectual_accounting->set_width(200);
        $property->add_property($intellectual_accounting);

        $percent_faculty = new \Orm_Property_Text('percent_faculty');
        $percent_faculty->set_description('Percent of Participating Faculty Producing ICs');
        $percent_faculty->set_group('Percentage of Faculty Producing ICs');
        $percent_faculty->set_width(200);
        $property->add_property($percent_faculty);

        $percent_fte = new \Orm_Property_Text('percent_fte');
        $percent_fte->set_description('Percentage of Total FTE Faculty Producing ICs');
        $percent_fte->set_group('Percentage of Faculty Producing ICs');
        $percent_fte->set_width(200);
        $property->add_property($percent_fte);

        $this->set_property($property);
    }

    public function get_part_a()
    {
        return $this->get_property('part_a')->get_value();
    }

    public function set_part_b()
    {
        $property = new \Orm_Property_Fixedtext('part_b', '<b>Part B: Alignment with Mission, Expected Outcomes, and Strategy</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_part_b()
    {
        return $this->get_property('part_b')->get_value();
    }

    public function set_quality_description($value)
    {
        $property = new \Orm_Property_Textarea('quality_description', $value);
        $property->set_description('Provide a qualitative description of how the portfolio of intellectual contributions is aligned with the mission, expected outcomes, and strategy of the accounting academic unit');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_quality_description()
    {
        return $this->get_property('quality_description')->get_value();
    }

    public function set_part_c()
    {
        $property = new \Orm_Property_Fixedtext('part_c', '<b>Part C: Quality of the Five-Year Portfolio of Intellectual Contributions</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_part_c()
    {
        return $this->get_property('part_c')->get_value();
    }

    public function set_evidence($value)
    {
        $property = new \Orm_Property_Textarea('evidence', $value);
        $property->set_description('Provide evidence demonstrating the quality of the above five-year portfolio of intellectual contributions. Accounting academic units are encouraged to include qualitative descriptions and quantitative metrics and to summarize information in tabular format whenever possible.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_evidence()
    {
        return $this->get_property('evidence')->get_value();
    }

    public function set_part_d()
    {
        $property = new \Orm_Property_Fixedtext('part_d', '<b>Part D: Impact of Intellectual Contributions</b>');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_part_d()
    {
        return $this->get_property('part_d')->get_value();
    }

    public function set_impact($value)
    {
        $property = new \Orm_Property_Textarea('impact', $value);
        $property->set_description('Provide evidence demonstrating that the unit’s intellectual contributions have had an impact on the theory, practice, and/or teaching of accounting, business, and management. To demonstrate impact, whenever possible, the accounting academic unit is encouraged to include qualitative descriptions and quantitative metrics and to summarize the information in tabular format. Evidence of impact may stem from intellectual contributions produced beyond the five-year AACSB accreditation review period');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_impact()
    {
        return $this->get_property('impact')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', 'Notes: Please add a footnote to this table summarizing the unit’s policies guiding accounting faculty in the production of intellectual contributions. The data must also be supported by analysis of impact/accomplishments and the depth of participation by faculty across the unit. The data presented in Table A2-1 should be supported by faculty vitae that provide sufficient detail to link individual citations to what is presented here. Interdisciplinary outcomes may be  presented in a separate category but the disciplines involved should be identified.');
        $property->set_group('group_1');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_info2()
    {
        $property = new \Orm_Property_Fixedtext('info2', 'The validation of the accomplishments/impact of intellectual contribution outcomes may be reflected in: <br/>'
            . '<ul type="circle">'
            . '<li>Peer recognition of the originality, scope, and/or significance of new knowledge.</li>'
            . '<li>The applicability and benefits of the new knowledge to the theory, practice, and/or teaching of accounting, business, and management.</li>'
            . '<li>The usefulness and/or originality of new or different understandings, applications, and insights resulting from the creative work.</li>'
            . '<li>The breadth, value, and persistence of the use and impact of the creative work.</li>'
            . '<li>The originality and significance of the creative work to learning, including the depth and duration of its usefulness.</li>'
            . '<li>Research awards and recognition (e.g., selection as a fellow of an academic society)</li>'
            . '<li>Adoption or citations of the creative work by peers, indicating its impact on the creative work of others.</li>'
            . '<li>Evidence in the work of leadership and team-based contributions to the advancement of knowledge.</li>'
            . '<li>Alignment of the work with mission, expected outcomes, and strategies.</li>'
            . '</ul>'
            . '<p>The above is not an exhaustive list of how an accounting academic unit can present or measure the possible impacts of its intellectual contribution portfolio. As an accounting academic unit documents its portfolio of intellectual contribution outcomes, the key is to provide the peer review team with the means to make an initial assessment of the portfolio’s alignment with mission and draw broader conclusions about its impact on teaching and practice (refer to the Appendix for a non-exhaustive list of possible impact indicators). The validation documentation is an important part of the process because it serves to illustrate the depth and breadth of faculty participation in the production of intellectual contributions (i.e., to show a substantial cross-section of accounting faculty and the level of peer review journal outcomes). Finally, the spirit and intent of this standard applies both to intellectual contributions grounded solely in accounting and related areas and to interdisciplinary contributions. Interdisciplinary intellectual contributions will be judged in the same context as contributions based solely in accounting and are in no way discounted in the context of this standard; however, interdisciplinary outcomes should be aligned with mission, expected outcomes, and strategies of the accounting academic unit.</p>');
        $this->set_property($property);
    }

    public function get_info2()
    {
        return $this->get_property('info2')->get_value();
    }

    public function set_textarea4($value)
    {
        $property = new \Orm_Property_Textarea('textarea4', $value);
        $property->set_description('Provide a summary of impact indicators resulting from the intellectual contributions produced by the faculty of the accounting academic unit. See Appendix to these accounting standards for a non-exhaustive list of possible impact indicators. If the business school analysis provides sufficient detail for the peer review team to assess the impact of the accounting academic unit, the unit may refer the peer review team to the business school documentation.');
        $this->set_property($property);
    }

    public function get_textarea4()
    {
        return $this->get_property('textarea4')->get_value();
    }

    public function set_textarea5($value)
    {
        $property = new \Orm_Property_Textarea('textarea5', $value);
        $property->set_description('Provide an analysis of how the portfolio includes contributions from a substantial cross-section of accounting faculty, as well as a significant quantity of peer-reviewed journal work or the equivalent.');
        $this->set_property($property);
    }

    public function get_textarea5()
    {
        return $this->get_property('textarea5')->get_value();
    }

    public function set_textarea6($value)
    {
        $property = new \Orm_Property_Textarea('textarea6', $value);
        $property->set_description('Provide evidence that the accounting academic unit adopts appropriate policies to guide faculty members in the production of intellectual contributions that align with the mission, expected outcomes, and strategies. Such policies should guide faculty as to how the accounting academic unit prioritizes different types of scholarship, determines quality, and validates or assesses outcomes as positive contributions to the advancement of accounting, business and management theory, practice, and learning. These policies also should help the accounting academic unit benchmark its faculty’s intellectual contribution outcomes and should establish a foundation for further development, direction, and improvements.');
        $this->set_property($property);
    }

    public function get_textarea6()
    {
        return $this->get_property('textarea6')->get_value();
    }

    public function set_textarea7($value)
    {
        $property = new \Orm_Property_Textarea('textarea7', $value);
        $property->set_description('Indicate how the accounting academic unit incorporates indicators of impact into appropriate measurement systems and links those indicators to continuous improvement strategies');
        $this->set_property($property);
    }

    public function get_textarea7()
    {
        return $this->get_property('textarea7')->get_value();
    }

    public function set_textarea8($value)
    {
        $property = new \Orm_Property_Textarea('textarea8', $value);
        $property->set_description('Provide a brief summary/analysis of how the portfolio of intellectual contributions aligns with mission, expected outcomes, and strategies.');
        $this->set_property($property);
    }

    public function get_textarea8()
    {
        return $this->get_property('textarea8')->get_value();
    }

}
