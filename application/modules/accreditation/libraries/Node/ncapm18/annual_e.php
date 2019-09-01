<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 09/10/18
 * Time: 03:43 م
 */

namespace Node\ncapm18;


class Annual_E extends \Orm_Node
{

    protected $class_type = __CLASS__;
    protected $name = 'E. Program Activities';
    protected $link_view = true;
    protected $link_edit = true;
    protected $link_pdf = true;

    public function init()
    {
        parent::init();

        $this->set_guidance(array());
        $this->set_activity(array());
        $this->set_research(array());
        $this->set_partnership(array());
        $this->set_analysis(array());

    }

    public function set_guidance($value)
    {
        $property = new \Orm_Property_Table_Dynamic('guidance', $value);
        $property->set_description('1. Students guidance and counseling');

        $activities = new \Orm_Property_Text('activities');
        $activities->set_description('List Activities Provided');
        $property->add_property($activities);

        $description = new \Orm_Property_Textarea('description');
        $description->set_description('Brief Description');
        $description->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($description);

        $this->set_property($property);

    }

    public function get_guidance()
    {
        return $this->get_property('guidance')->get_value();
    }


    public function set_activity($value)
    {
        $property = new \Orm_Property_Table_Dynamic('activity', $value);
        $property->set_description('2.Professional Development Activities for Faculty, Teaching and other Staff');

        $activities = new \Orm_Property_Text('activities');
        $activities->set_description('List Activities Provided');
        $property->add_property($activities);

        $teaching = new \Orm_Property_Text('teaching');
        $teaching->set_description('Teaching Staff');
        $teaching->set_group('No. of Participant');
        $property->add_property($teaching);

        $staff = new \Orm_Property_Text('staff');
        $staff->set_description('Other Staff');
        $staff->set_group('No. of Participant');
        $property->add_property($staff);

        $description = new \Orm_Property_Textarea('description');
        $description->set_description('Brief Description');
        $description->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($description);

        $this->set_property($property);

    }

    public function get_activity()
    {
        return $this->get_property('activity')->get_value();
    }

    public function set_research($value)
    {
        $property = new \Orm_Property_Table_Dynamic('research', $value);
        $property->set_description('3. Scientific research and innovation');

        $activities = new \Orm_Property_Text('activities');
        $activities->set_description('List Activities Provided');
        $property->add_property($activities);

        $description = new \Orm_Property_Textarea('description');
        $description->set_description('Brief Description');
        $description->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($description);

        $this->set_property($property);

    }

    public function get_research()
    {
        return $this->get_property('research')->get_value();

    }

    public function set_partnership($value)
    {
        $property = new \Orm_Property_Table_Dynamic('partnership', $value);
        $property->set_description('4. Community partnership');

        $activities = new \Orm_Property_Text('activities');
        $activities->set_description('List Activities Provided');
        $property->add_property($activities);

        $description = new \Orm_Property_Textarea('description');
        $description->set_description('Brief Description');
        $description->set_tinymce_toolbars(array('bullist numlist outdent indent'));
        $property->add_property($description);

        $this->set_property($property);

    }

    public function get_partnership()
    {
        return $this->get_property('partnership')->get_value();

    }

    public function set_analysis($value)
    {
        $property = new \Orm_Property_Add_More('analysis', $value);
        $property->set_description('5. Analysis ( list of strength, points for improvements and recommendations of Program activities )');

        $strength = new \Orm_Property_Textarea('strength');
        $strength->set_description('Strengths');
        $property->add_property($strength);

        $points = new \Orm_Property_Textarea('points');
        $points->set_description('Points for improvements');
        $property->add_property($points);


        $recommendation = new \Orm_Property_Textarea('recommendation');
        $recommendation->set_description('Recommendations');
        $property->add_property($recommendation);

        $this->set_property($property);


    }

    public function get_analysis()
    {

        return $this->get_property('analysis')->get_value();
    }

}