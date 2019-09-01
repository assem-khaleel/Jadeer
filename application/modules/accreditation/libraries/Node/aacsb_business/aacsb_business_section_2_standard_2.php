<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Node\aacsb_business;

/**
 * Description of aacsb_business_section_2_standard_2
 *
 * @author ahmadgx
 */
class Aacsb_Business_Section_2_Standard_2 extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'Standard 2';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;
    protected $orientation = 'landscape';

    public function init()
    {
        parent::init();

            $this->set_standard_name('');
            $this->set_definition('');
            $this->set_portfolio('');
            $this->set_table_2_1('');
            $this->set_part_a(array());
            $this->set_part_a_note('');
            $this->set_part_b('');
            $this->set_qualitative_description('');
            $this->set_part_c('');
            $this->set_evidence_demonstrating('');
            $this->set_part_d('');
            $this->set_intellectual_contributions('');
            $this->set_note('');
            $this->set_validation('');
            $this->set_impact_indicators('');
            $this->set_analysis('');
            $this->set_faculty_memeber('');
    }

    public function set_standard_name()
    {
        $property = new \Orm_Property_Fixedtext('standard_name', '<b>The school produces high-quality intellectual contributions that are consistent with its mission, expected outcomes, and strategies and that impact the theory, practice, and teaching of business and management. [INTELLECTUAL CONTRIBUTIONS, IMPACT, AND ALIGNMENT WITH MISSION]</b>');
        $this->set_property($property);
    }

    public function get_standard_name()
    {
        return $this->get_property('standard_name')->get_value();
    }

    public function set_definition()
    {
        $property = new \Orm_Property_Fixedtext('definition', '<strong>Definitions</strong> <br/>'
            . '<ul>'
            . '<li>Intellectual contributions are original works intended to advance the theory, practice, and/or teaching of business and management. They are scholarly in the sense that they are based on generally accepted research principles, are validated by peers and disseminated to appropriate audiences. Intellectual contributions are a foundation for innovation. Validation of the quality of intellectual contributions includes the traditional academic or professional pre-publication peer review, but may encompass other forms of validation, such as online post-publication peer reviews, ratings, surveys of users, etc. Intellectual contributions may fall into any of the following categories:'
            . '<ul>'
            . '<li>Basic or discovery scholarship (often referred to as discipline-based scholarship) that generates and communicates new knowledge and understanding and/or development of new methods. Intellectual contributions in this category are normally intended to impact the theory, knowledge, and/or practice of business and management.</li>'
            . '<li>Applied or Integration/application scholarship that synthesizes new understandings or interpretations of knowledge or technology; develops new technologies, processes, tools, or uses; and/or refines, develops, or advances new methods based on existing knowledge. Intellectual contributions in this category are normally intended to contribute to and impact the practice of business and management.</li>'
            . '<li>Teaching and learning scholarship that develops and advances new understandings, insights, and teaching content and methods that impact learning behavior. Intellectual contributions in this category are normally intended to impact the teaching and/or pedagogy of business and management.</li>'
            . '</ul></li>'
            . '<li>Impact of intellectual contributions is the advancement of theory, practice, and/or teaching of business and management through intellectual contributions. Impact is concerned with the difference made or innovations fostered by intellectual contributions—e.g., what has been changed, accomplished, or improved.</li>'
            . '</ul><br/><br/>'
            . '<strong>Basis for Judgment</strong>'
            . '<ul>'
            . '<li>The school has produced intellectual contributions that have had an impact on the theory, practice, and/or teaching of business and management consistent with the mission, expected outcomes, and strategies of the school.</li>'
            . '<li>The school expresses expectations regarding the impact of intellectual contributions in the mission in ways that are transparent to the public.</li>'
            . '<li>The school applies relevant metrics to assess the extent to which expected impacts from intellectual contributions have been achieved and are aligned with mission.</li>'
            . '<li>The school maintains a current portfolio of high quality intellectual contributions that could impact theory, practice, and/or teaching in the future. The portfolio of intellectual contributions includes contributions from a substantial cross-section of the faculty in each discipline. Normally, a significant level of the contributions in the portfolio must be in the form of peer-reviewed journal articles or the equivalent. The portfolio of intellectual contributions must include some representation of discipline-based scholarship (such as basic/discovery, integration/application) and teaching and learning scholarship outcomes regardless of mission; however, the priorities of the school reflected in the mission, expected outcomes, and strategies must be evident in the overall portfolio of intellectual contribution outcomes</li>'
            . '<li>The school supports the depth and breadth of faculty participation in scholarship leading to high-quality intellectual contributions that could impact theory, practice, and/or teaching in the future. If outcomes rely heavily on the intellectual contributions of faculty members who have primary faculty appointments with other institutions, the school must provide documentation regarding how its relationship with the individual faculty members and other institutions supports the success, mission, and intellectual contributions of the school.</li>'
            . '<li>The school documents intellectual contributions that demonstrate high quality and impact, as well as alignment with mission, expected outcomes, and strategies. In documenting quality, the school produces evidence of high-quality intellectual contributions within the most recent five-year AACSB accreditation review period. In documenting impact, however, the school may produce evidence from intellectual contributions produced prior to the most recent five-year AACSB accreditation review period. The review process recognizes that impact often occurs over time. During the initial three-year implementation period (2013-2016), schools are expected to make progress toward fully reporting the impact of research and providing the documentation described in this section. At the end of the implementation period, schools should fully satisfy the standard.</li>'
            . '</ul><br/><br/>'
            . '<strong>Guidance for Documentation</strong>');
        $this->set_property($property);
    }

    public function get_definition()
    {
        return $this->get_property('definition')->get_value();
    }

    public function set_portfolio($value)
    {
        $property = new \Orm_Property_Textarea('portfolio', $value);
        $property->set_description('Provide a portfolio of evidence including qualitative and quantitative measures that summarize the portfolio of intellectual contributions over the most recent five-year review period, ending with the most recently completed, normal academic year. This evidence can be enhanced by including validating evidence of the accomplishments of such work. At a minimum, the portfolio of evidence should include: (1) A listing of the outlets (journals, research monographs, published cases, funded and competitive research grants, scholarly presentations, invited presentations, published textbooks, other teaching materials, etc.); (2) an analysis of the breadth of faculty engagement and production of intellectual contributions within each discipline; (3) awards, recognition, editorships, and other forms of validation of the accomplishments of faculty through their intellectual contributions; and (4) the ways in which the school conveys intellectual contributions and their outcomes to external constituencies and stakeholders.');
        $this->set_property($property);
    }

    public function get_portfolio()
    {
        return $this->get_property('portfolio')->get_value();
    }

    public function set_table_2_1()
    {
        $property = new \Orm_Property_Fixedtext('table_2_1', '<b>Table 2-1 is divided into four parts. Part A provides a five-year aggregate summary of intellectual contributions. Part B provides a qualitative description of how the portfolio of intellectual contributions aligns with mission, expected outcomes, and strategy. Part C provides evidence demonstrating the quality of the portfolio of intellectual contributions. Part D provides evidence that the school’s intellectual contributions have had an impact on the theory, practice, and/or teaching of business and management. Table 2-1 allows schools flexibility to develop their own indicators of quality for the portfolio of intellectual contributions.</b>');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_table_2_1()
    {
        return $this->get_property('table_2_1')->get_value();
    }

    public function set_part_a($value)
    {
        $property = new \Orm_Property_Table_Dynamic('part_a', $value);
        $property->set_description('Part A: Five-Year Summary of Intellectual Contributions');
        $property->set_group('intellectual_contributions');

        $faculty = new \Orm_Property_Text('faculty');
        $faculty->set_description('Faculty Aggregate and summarize data to reflect the organizational structure of the school’s faculty (e.g., departments, research groups). Do not list by individual faculty member.');
        $property->add_property($faculty);

        $portfolio_scholarship = new \Orm_Property_Text('portfolio_scholarship');
        $portfolio_scholarship->set_description('Portfolio of Intellectual Contributions "Basic or Discovery Scholarship"');
        $property->add_property($portfolio_scholarship);

        $portfolio_applied_scholarship = new \Orm_Property_Text('portfolio_applied_scholarship');
        $portfolio_applied_scholarship->set_description('Portfolio of Intellectual Contributions "Applied or Integration / Application Scholarship"');
        $property->add_property($portfolio_applied_scholarship);

        $portfolio_teaching_scholarship = new \Orm_Property_Text('portfolio_teaching_scholarship');
        $portfolio_teaching_scholarship->set_description('Portfolio of Intellectual Contributions "Teaching and Learning Scholarship"');
        $property->add_property($portfolio_teaching_scholarship);

        $intellectual_journals = new \Orm_Property_Text('intellectual_journals');
        $intellectual_journals->set_description('Types of Intellectual Contributions "Peer-Reviewed Journals"');
        $property->add_property($intellectual_journals);

        $intellectual_research = new \Orm_Property_Text('intellectual_research');
        $intellectual_research->set_description('Types of Intellectual Contributions "Research Monographs"');
        $property->add_property($intellectual_research);

        $intellectual_meeting_proceeding = new \Orm_Property_Text('intellectual_meeting_proceeding');
        $intellectual_meeting_proceeding->set_description('Types of Intellectual Contributions "Academic / Professional Meeting Proceedings"');
        $property->add_property($intellectual_meeting_proceeding);

        $intellectual_competitive_research = new \Orm_Property_Text('intellectual_competitive_research');
        $intellectual_competitive_research->set_description('Types of Intellectual Contributions "Competitive Research Awards Recieved"');
        $property->add_property($intellectual_competitive_research);

        $intellectual_textbook = new \Orm_Property_Text('intellectual_textbook');
        $intellectual_textbook->set_description('Types of Intellectual Contributions "Textbooks"');
        $property->add_property($intellectual_textbook);

        $intellectual_cases = new \Orm_Property_Text('intellectual_cases');
        $intellectual_cases->set_description('Types of Intellectual Contributions "Cases"');
        $property->add_property($intellectual_cases);

        $intellectual_other_teaching = new \Orm_Property_Text('intellectual_other_teaching');
        $intellectual_other_teaching->set_description('Types of Intellectual Contributions "Other Teaching Materials"');
        $property->add_property($intellectual_other_teaching);

        $intellectual_other_ic = new \Orm_Property_Text('intellectual_other_ic');
        $intellectual_other_ic->set_description('Types of Intellectual Contributions "Other IC Type Selected by the School"');
        $property->add_property($intellectual_other_ic);

        $percent_faculty = new \Orm_Property_Percentage('percent_faculty');
        $percent_faculty->set_description('Percentage of Participating Faculty producing ICs *');
        $percent_faculty->set_group('Percentages of Faculty Producing ICs');
        $property->add_property($percent_faculty);

        $percent_faculty_producting = new \Orm_Property_Percentage('percent_faculty_producting');
        $percent_faculty_producting->set_description('Percentage of total FTE faculty producing ICs *');
        $percent_faculty_producting->set_group('Percentages of Faculty Producing ICs');
        $property->add_property($percent_faculty_producting);

        $this->set_property($property);
    }

    public function get_part_a()
    {
        return $this->get_property('part_a')->get_value();
    }

    public function set_part_a_note()
    {
        $property = new \Orm_Property_Fixedtext('part_a_note', '*After each grouping of faculty by organizational structure, in the two columns on the far right, please indicate the percentage of participating faculty and the percentage of total FTE faculty producing ICs.');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_part_a_note()
    {
        return $this->get_property('part_a_note')->get_value();
    }

    public function set_part_b()
    {
        $property = new \Orm_Property_Fixedtext('part_b', '<b>Part B: Alignment with Mission, Expected Outcomes, and Strategy</b>');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_part_b()
    {
        return $this->get_property('part_b')->get_value();
    }

    public function set_qualitative_description($value)
    {
        $property = new \Orm_Property_Textarea('qualitative_description', $value);
        $property->set_description('Provide a qualitative description of how the portfolio of intellectual contributions is aligned with the mission, expected outcomes, and strategy of the school.');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_qualitative_description()
    {
        return $this->get_property('qualitative_description')->get_value();
    }

    public function set_part_c()
    {
        $property = new \Orm_Property_Fixedtext('part_c', '<b>Part C: Quality of Five-Year Portfolio of Intellectual Contributions</b>');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_part_c()
    {
        return $this->get_property('part_c')->get_value();
    }

    public function set_evidence_demonstrating($value)
    {
        $property = new \Orm_Property_Textarea('evidence_demonstrating', $value);
        $property->set_description('Provide evidence demonstrating the quality of the above five-year portfolio of intellectual contributions. Schools are encouraged to include qualitative descriptions and quantitative metrics and to summarize information in tabular format whenever possible.');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_evidence_demonstrating()
    {
        return $this->get_property('evidence_demonstrating')->get_value();
    }

    public function set_part_d()
    {
        $property = new \Orm_Property_Fixedtext('part_d', '<b>Part D: Impact of Intellectual Contributions</b>');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_part_d()
    {
        return $this->get_property('part_d')->get_value();
    }

    public function set_intellectual_contributions($value)
    {
        $property = new \Orm_Property_Textarea('evidence_demonstrating', $value);
        $property->set_description('Provide evidence demonstrating that the school’s intellectual contributions have had an impact on the theory, practice, and/or teaching of business and management. The school is encouraged to include qualitative descriptions and quantitative metrics and to summarize the information in tabular format whenever possible to demonstrate impact. Evidence of impact may stem from intellectual contributions produced beyond the five-year AACSB accreditation review period.');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_intellectual_contributions()
    {
        return $this->get_property('intellectual_contributions')->get_value();
    }

    public function set_note()
    {
        $property = new \Orm_Property_Fixedtext('note', 'Notes: Please add a footnote to this table summarizing the school’s policies guiding faculty in the production of intellectual contributions. The data must also be supported by analysis of impact/accomplishments and depth of participation by faculty across disciplines. The data presented in Table 2-1 should be supported by faculty vitae that provide sufficient detail to link individual citations to what is presented here. Interdisciplinary outcomes may be presented in a separate category but the disciplines involved should be identified.<br/><br/>');
        $property->set_group('intellectual_contributions');
        $this->set_property($property);
    }

    public function get_note()
    {
        return $this->get_property('note')->get_value();
    }

    public function set_validation()
    {
        $property = new \Orm_Property_Fixedtext('validation', '<ul><li>The validation of the accomplishments/impact of intellectual contribution outcomes may be reflected in:'
            . '<ul><li>Peer recognition of the originality, scope, and/or significance of new knowledge.</li>'
            . '<li>The applicability and benefits of the new knowledge to the theory, practice, and/or teaching of business and management.</li>'
            . '<li>The usefulness and/or originality of new or different understandings, applications, and insights resulting from the creative work.</li>'
            . '<li>The breadth, value, and persistence of the use and impact of the creative work.</li>'
            . '<li>The originality and significance of the creative work to learning, including the depth and duration of usefulness.</li>'
            . '<li>Research awards and recognition (e.g., selection as a fellow of an academic society).</li>'
            . '<li>Adoptions and citations of the creative work, including its impact on the creative work of others.</li>'
            . '<li>Evidence in the work of leadership and team-based contributions to the advancement of knowledge.</li>'
            . '<li>Alignment of the work with mission, expected outcomes, and strategies.</li></ul></li></ul>'
            . 'The above is not an exhaustive list of how a school can present or measure the possible impacts of its intellectual contribution portfolio. As a school documents its portfolio of intellectual contribution outcomes, the key is to provide the peer review team with the means to make an initial assessment of the portfolio’s alignment with mission and draw broader conclusions about its impact on teaching and practice (refer to Appendix). The validation documentation is an important part of the process because it serves to illustrate the depth and breadth of faculty participation in the production of intellectual contributions (i.e., to show a substantial cross-section of activity in each disciplinary context and the level of peer review journal outcomes). Finally, the spirit and intent of this standard applies to both intellectual contributions grounded solely in a single disciplinary area and interdisciplinary contributions. Interdisciplinary intellectual contributions will be judged in the same context as contributions in a single disciplinary area and are in no way discounted in the context of this standard; however, interdisciplinary outcomes should be aligned with mission, expected outcomes, and strategies of the business school.');
        $this->set_property($property);
    }

    public function get_validation()
    {
        return $this->get_property('validation')->get_value();
    }

    public function set_impact_indicators($value)
    {
        $property = new \Orm_Property_Textarea('impact_indicators', $value);
        $property->set_description('Provide a summary of impact indicators resulting from the intellectual contributions produced by the faculty of the school. See Appendix for a non-exhaustive list of possible impact indicators, including publications in highly recognized peer-review journals, citation counts, editorship and associate editorships, elections to leadership positions in academic and/or professional associations, external recognitions for research quality, invitations to participate in research conferences, use of academic work in doctoral seminars, awards of competitive grants from major national or international agencies, patent awards, appointments as visiting professors or scholars at other institutions, case studies of research that leads to the adoption of new teaching/learning practices, textbooks that are widely adopted, research-based learning projects with companies, and/or non-profit organizations, and widely used instructional software.');
        $this->set_property($property);
    }

    public function get_impact_indicators()
    {
        return $this->get_property('impact_indicators')->get_value();
    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Textarea('analysis', $value);
        $property->set_description('Provide an analysis of how the portfolio includes intellectual contributions from a substantial cross-section of faculty in each discipline, as well as a significant amount of peer-reviewed journal work or the equivalent.');
        $this->set_property($property);
    }

    public function get_analysis()
    {
        return $this->get_property('analysis')->get_value();
    }

    public function set_faculty_memeber()
    {
        $property = new \Orm_Property_Fixedtext('faculty_memeber', 'The school adopts appropriate policies to guide faculty members in the production of intellectual contributions that align with the mission, expected outcomes, and strategies. Such policies should guide faculty as to how the school prioritizes different types of scholarship, determines quality, and validates or assesses outcomes as positive contributions to the advancement of business and management theory, practice, and learning.');
        $this->set_property($property);
    }

    public function get_faculty_memeber()
    {
        return $this->get_property('faculty_memeber')->get_value();
    }

}
