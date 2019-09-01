<?php
/**
 * Created by PhpStorm.
 * User: plus
 * Date: 04/07/18
 * Time: 03:51 م
 */

namespace Node\ncacm18;


class Root extends \Orm_Node
{
    protected $is_form = 0;
    protected $class_type = __CLASS__;
    protected $name = 'Course Specifications and Reports V.2018';


    public $program_id;
    public $course_id;

    public function draw_system_node()
    {
        return \Orm::get_ci()->load->view('accreditation/system', array('node' => $this, 'abbreviation' => 'P'));
    }


    public function add_course($name, $item_id = 0, $assessor_ids = array())
    {

        $node_obj = self::get_one(array('class_type' => self::COURSE_COURSE18, 'item_id' => $item_id, 'system_number' => $this->get_system_number()));


        if (!($node_obj instanceof Course)) {
            $node_obj = new Course();
        }

        if (!$node_obj->get_id()) {
            $node_obj->set_system_number($this->get_system_number());
            $node_obj->set_year($this->get_year());
            $node_obj->set_parent_id($this->get_id());
            $node_obj->set_name($name);
            $node_obj->set_item_id($item_id);
            $node_obj->generate();

            if ($assessor_ids) {
                foreach ($assessor_ids as $assessor_id) {
                    $node_assessor = new \Orm_Node_Assessor();
                    $node_assessor->set_assessor_id($assessor_id);
                    $node_assessor->set_node_id($node_obj->get_id());
                    $node_assessor->save();
                }
            }
        }

        return $node_obj;
    }

    /**
     * @return \Orm_Node[]
     */
    public function get_children_nodes()
    {

        if ($this->course_id) {
            $course = \Orm_Course::get_instance($this->course_id);
            $this->add_course($course->get_name('english'), $course->get_id());
        } elseif($this->program_id) {
            foreach(\Orm_Program_Plan::get_all(array('program_id' => $this->program_id, 'semester_id' => $this->get_system_obj()->get_item_id())) as $plan) {
                $course = $plan->get_course_obj();
                $this->add_course($course->get_name('english'), $course->get_id());
            }
        }

        return array();
    }

    public function system_validator(&$view_params = array())
    {

        $node = self::get_active_course2018_node();
        $node15 = self::get_active_course_node();
        if ($node->get_id() ||$node15->get_id()) {
            \Validator::set_error('common_error', lang('You can not have more than one Course - Accreditations per Semester.'));
        }

        if ($node->get_id()) {
            $this->set_id($node->get_id());
            $this->set_year($node->get_year());

            return $node->get_item_id();
        } else {
            $semester = \Orm_Semester::get_active_semester();
            $this->set_year($semester->get_year());

            return $semester->get_id();
        }
    }

    public function get_system_url()
    {
        return '/accreditation/generate';
    }

    /**
     * @return \Orm_Semester
     */
    public function get_item_obj()
    {
        return \Orm_Semester::get_instance($this->get_item_id());
    }

    public function collect_course_progress(&$finished = 0, &$in_process = 0, $filters = array())
    {

        $filters['system_number'] = $this->get_system_number();
        $course_range = self::get_model()->get_course_ranges($filters);
        $filters['course_ranges'] = count($course_range) ? $course_range : [['parent_lft' => 0, 'parent_rgt' => 0]];

        $filters['is_form'] = 1;

        $filters['is_finished'] = 1;
        $finished = self::get_count($filters);

        $filters['is_finished'] = 0;
        $in_process = self::get_count($filters);

    }

    public function collect_course_reviewing(&$reviewed = 0, &$not_reviewed = 0, $filters = array())
    {

        $filters['system_number'] = $this->get_system_number();
        $course_range = self::get_model()->get_course_ranges($filters);
        $filters['course_ranges'] = count($course_range) ? $course_range : [['parent_lft' => 0, 'parent_rgt' => 0]];
        $filters['is_finished'] = 1;

        $filters['review_status_in'] = array('compliant', 'not_compliant', 'partly_compliant');
        $reviewed = self::get_count($filters);

        $filters['review_status_in'] = array('none');
        $not_reviewed = self::get_count($filters);

    }

    public function get_course_progress_bar($filters = array(), $size = 100)
    {
        $finished = 0;
        $in_process = 0;
        $this->collect_course_progress($finished, $in_process, $filters);
        $progress = 0;
        if (($finished + $in_process) > 0) {
            $progress = round(($finished / ($finished + $in_process)) * 100, 2);
        }

        $id = uniqid();

        return <<<BAR
        <div id="progress-{$id}" class="easy-pie-chart" data-percent="{$progress}">
            <span></span>
        </div>
        
        <script>
          $(function() {
            $('#progress-{$id}').easyPieChart({
              animate: 1000,
              barColor: '#72B159',
              size: {$size},
              onStep: function(_from, _to, currentValue) {
                $(this.el).find('> span').text(currentValue.toFixed(2) + '%');
              },
            });
          });
        </script>
BAR;

    }

    public function get_course_review_bar($filters = array(), $size = 100)
    {
        $reviewed = 0;
        $not_reviewed = 0;
        $this->collect_course_reviewing($reviewed, $not_reviewed, $filters);

        $review = 0;
        if (($reviewed + $not_reviewed) > 0) {
            $review = round(($reviewed / ($reviewed + $not_reviewed)) * 100, 2);
        }

        $id = uniqid();

        return <<<BAR
        <div id="review-{$id}" class="easy-pie-chart" data-percent="{$review}">
            <span></span>
        </div>
        
        <script>
          $(function() {
            $('#review-{$id}').easyPieChart({
              animate: 1000,
              size: {$size},
              onStep: function(_from, _to, currentValue) {
                $(this.el).find('> span').text(currentValue.toFixed(2) + '%');
              },
            });
          });
        </script>
BAR;

    }


}