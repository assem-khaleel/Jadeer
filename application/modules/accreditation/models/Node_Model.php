<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 *
 * Class Node_Model
 */
class Node_Model extends CI_Model
{

    private $autoload = array(
        'id',
        'parent_id',
        'parent_lft',
        'parent_rgt',
        'system_number',
        'item_id',
        'year',
        'name',
        'class_type',
        'date_added',
        'is_deleted',
        'is_finished',
        'is_form',
        'is_shared',
        'shared_date',
        'due_date',
        'review_status',
    );

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return array
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {
        $page = (int)$page;
        $per_page = (int)$per_page;

        foreach ($this->autoload as $field) {
            $this->db->select("n.{$field}");
        }

        $this->db->distinct();
        $this->db->from(Orm_Node::get_table_name().' AS n');
        $this->db->where('n.is_deleted', 0);

        if (isset($filters['id'])) {
            $this->db->where('n.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('n.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('n.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('n.id', $filters['not_in_id']);
        }
        if (isset($filters['parent_id'])) {
            $this->db->where('n.parent_id', $filters['parent_id']);
        }
        if (!empty($filters['parent_lft']) && !empty($filters['parent_rgt'])) {
            $this->db->group_start();
            $this->db->where("n.parent_lft BETWEEN {$filters['parent_lft']} AND {$filters['parent_rgt']}", null, false);

            if (!empty($filters['not_parent_lft']) && !empty($filters['not_parent_rgt'])) {
                $this->db->where("n.parent_lft NOT BETWEEN {$filters['not_parent_lft']} AND {$filters['not_parent_rgt']}", null, false);
            }
            $this->db->group_end();
        }
        if (!empty($filters['course_ranges'])) {
            $this->db->group_start();
            foreach ($filters['course_ranges'] as $row) {
                $this->db->or_where("n.parent_lft BETWEEN '{$row['parent_lft']}' AND '{$row['parent_rgt']}' ");
            }
            $this->db->group_end();
        }
        if (isset($filters['system_number'])) {
            $this->db->where('n.system_number', $filters['system_number']);
        }
        if (isset($filters['not_system_number'])) {
            $this->db->where('n.system_number !=', $filters['not_system_number']);
        }
        if (!empty($filters['system_number_in'])) {
            $this->db->where_in('n.system_number', $filters['system_number_in']);
        }
        if (isset($filters['item_id'])) {
            $this->db->where('n.item_id', $filters['item_id']);
        }
        if (!empty($filters['item_id_in'])) {
            $this->db->where_in('n.item_id', $filters['item_id_in']);
        }
        if (!empty($filters['year'])) {
            $this->db->where('n.year', $filters['year']);
        }
        if (!empty($filters['year_greater'])) {
            $this->db->where('n.year >', $filters['year_greater']);
        }
        if (!empty($filters['year_greater_equal'])) {
            $this->db->where('n.year >=', $filters['year_greater_equal']);
        }
        if (!empty($filters['year_less'])) {
            $this->db->where('n.year <', $filters['year_less']);
        }
        if (!empty($filters['year_less_equal'])) {
            $this->db->where('n.year <=', $filters['year_less_equal']);
        }
        if (!empty($filters['year_start']) && !empty($filters['year_end'])) {
            $this->db->where("n.year BETWEEN {$filters['year_start']} AND {$filters['year_end']}");
        }
        if (!empty($filters['name'])) {
            $this->db->where('n.name', $filters['name']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->like('n.name', $filters['keyword']);
        }
        if (!empty($filters['class_type'])) {
            $this->db->where('n.class_type', $filters['class_type']);
        }
        if (!empty($filters['class_type_in'])) {
            $this->db->where_in('n.class_type', $filters['class_type_in']);
        }
        if (!empty($filters['date_added'])) {
            $this->db->where('n.date_added', $filters['date_added']);
        }
        if (isset($filters['is_finished'])) {
            $this->db->where('n.is_finished', $filters['is_finished']);
        }
        if (isset($filters['is_form'])) {
            $this->db->where('n.is_form', $filters['is_form']);
        }
        if (isset($filters['is_shared'])) {
            $this->db->where('n.is_shared', $filters['is_shared']);
        }
        if (!empty($filters['shared_date'])) {
            $this->db->where('n.shared_date', $filters['shared_date']);
        }
        if (!empty($filters['due_date'])) {
            $this->db->where('n.due_date', $filters['due_date']);
        }
        if (isset($filters['review_status'])) {
            $this->db->where('n.review_status', $filters['review_status']);
        }
        if (!empty($filters['review_status_in'])) {
            $this->db->where_in('n.review_status', $filters['review_status_in']);
        }
        if (!empty($filters['properties'])) {
            $this->db->where('n.properties', $filters['properties']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                $row = $this->db->get()->row_array();
                return Orm_Node::to_object($row, (empty($row['class_type']) ? null : $row['class_type']));
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    if(!empty($row['id'])) {
                        $objects[$row['id']] = Orm_Node::to_object($row, (empty($row['class_type']) ? null : $row['class_type']));
                    }
                }
                return $objects;
                break;
            case Orm::FETCH_ARRAY:
                return $this->db->get()->result_array();
                break;
            case Orm::FETCH_COUNT:
                return $this->db->count_all_results();
                break;
        }
    }

    /**
     * insert new row to the table
     *
     * @param array $params
     * @return int
     */
    public function insert($params = array())
    {
        $this->db->insert(Orm_Node::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Node::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Node::get_table_name(), array('id' => (int)$id));
    }

    public function get_lazy_properties($id) {

        $this->db->select('n.properties');
        $this->db->distinct();
        $this->db->from(Orm_Node::get_table_name().' AS n');
        $this->db->where('n.is_deleted', 0);
        $this->db->where('n.id', $id);

        $row = $this->db->get()->row_array();

        return isset($row['properties']) ? $row['properties'] : '';
    }

    public function get_shared_node_id($class_type, $course_id, $department_id)
    {

        $department_id = $this->db->escape_str($department_id);
        $course_id = $this->db->escape_str($course_id);
        $course_type = $this->db->escape_str(Orm_Node::COURSE_COURSE);

        $this->db->select('n.id');
        $this->db->distinct();
        $this->db->from(Orm_Node::get_table_name().' AS `n`');
        $this->db->where('n.is_deleted', 0);
        $this->db->where('n.class_type', $class_type);
        $this->db->where('n.is_shared', 1);
        $this->db->where("(`n`.`parent_lft` IN (SELECT
            `n`.parent_lft
        FROM
            (`".Orm_Node::get_table_name()."` AS `m`)
                INNER JOIN
            `".Orm_Program_Plan::get_table_name()."` ON `".Orm_Program_Plan::get_table_name()."`.`id` = `m`.`item_id`
                AND `".Orm_Program_Plan::get_table_name()."`.`course_id` = '{$course_id}'
                AND `m`.`class_type` = '{$course_type}'
                INNER JOIN
            `program` ON `".Orm_Program_Plan::get_table_name()."`.`program_id` = `".Orm_Program::get_table_name()."`.`id`
                AND `".Orm_Program::get_table_name()."`.`department_id` = '{$department_id}'
        WHERE
            `m`.`is_deleted` = 0
                AND `n`.parent_lft BETWEEN `m`.parent_lft AND `m`.parent_rgt))", null, false);

        $this->db->order_by('n.shared_date DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        }

        return 0;
    }

    public function save_as_finished($system_number, $parent_lft, $parent_rgt)
    {
        $this->db->where('system_number', $system_number);
        $this->db->where("parent_lft BETWEEN {$parent_lft} AND {$parent_rgt}");
        return $this->db->update(Orm_Node::get_table_name(), array('is_finished' => 1));
    }

    public function save_as_shared($system_number, $parent_lft, $parent_rgt)
    {
        $this->db->where('system_number', $system_number);
        $this->db->where("parent_lft BETWEEN {$parent_lft} AND {$parent_rgt}");
        return $this->db->update(Orm_Node::get_table_name(), array('is_shared' => 1, 'shared_date' => date('Y-m-d H:i:s')));
    }

    public function delete_children($system_number, $parent_lft, $parent_rgt)
    {
        $this->db->where('system_number', $system_number);
        $this->db->where("parent_lft BETWEEN {$parent_lft} AND {$parent_rgt}");
        return $this->db->update(Orm_Node::get_table_name(), array('is_deleted' => 1));
    }

    public function get_item_ids_by_class_type($class_type, $system_number, $parent_lft, $parent_rgt)
    {

        $this->db->select('n.item_id');
        $this->db->distinct();
        $this->db->from(Orm_Node::get_table_name().' AS n');
        $this->db->where('n.is_deleted', 0);
        $this->db->where('class_type', $class_type);
        $this->db->where('system_number', $system_number);
        $this->db->where("parent_lft BETWEEN {$parent_lft} AND {$parent_rgt}");

        return $this->db->get()->result_array();
    }

    public function get_years()
    {

        $this->db->select('n.year');
        $this->db->distinct();
        $this->db->from(Orm_Node::get_table_name().' AS n');
        $this->db->where('n.is_deleted', 0);

        return $this->db->get()->result_array();
    }

    public function get_max_id()
    {
        $this->db->select_max('id');
        $result = $this->db->get(Orm_Node::get_table_name())->row_array();

        return (!empty($result['id']) ? $result['id'] : 0);
    }

    public function get_max_system_year($class_type)
    {
        $this->db->select_max('year');
        $this->db->where('class_type', $class_type);
        $this->db->where('is_deleted', 0);
        $result = $this->db->get(Orm_Node::get_table_name())->row_array();

        return (!empty($result['year']) ? $result['year'] : 0);
    }

    public function build_parent_tree($system_number = 0)
    {
        $this->build_tree($system_number);
        $this->db->update_batch(Orm_Node::get_table_name(), null, 'id');
    }

    private static $children_tree = array();

    private function build_children_tree($system_number = 0)
    {

        if (empty(self::$children_tree[$system_number]) || Orm::is_integration_mode()) {

            $this->db->select('id, parent_id');
            if ($system_number) {
                $this->db->where('system_number', $system_number);
            }
            $this->db->where('is_deleted', 0);
            $objects = $this->db->get(Orm_Node::get_table_name())->result_array();

            $children_tree = array();

            if ($objects) {
                foreach ($objects as $object) {
                    $children_tree[$object['parent_id']]['children'][] = $object;
                }
            }

            self::$children_tree[$system_number] = $children_tree;
        }

        return self::$children_tree[$system_number];
    }

    private function build_tree($system_number = 0, &$index = 0, $parent_id = 0)
    {

        $children_tree = $this->build_children_tree($system_number);

        $children = (empty($children_tree[$parent_id]['children']) ? array() : $children_tree[$parent_id]['children']);

        if ($children) {
            foreach ($children as $child) {
                $params = array();

                $index++;
                $params['parent_lft'] = $index;

                $this->build_tree($system_number, $index, $child['id']);

                $index++;
                $params['parent_rgt'] = $index;

                $params['id'] = (int) $child['id'];
                $this->db->set_update_batch([$params], 'id');
            }
        }
    }

    public function get_course_ranges($filters = array()) {

        $this->db->select('n.parent_lft');
        $this->db->select('n.parent_rgt');
        $this->db->distinct();
        $this->db->from(Orm_Node::get_table_name().' AS n');
        $this->db->where('n.is_deleted', 0);
        $this->db->where('n.class_type', Orm_Node::COURSE_COURSE);

        if (isset($filters['system_number'])) {
            $this->db->where('n.system_number', $filters['system_number']);
        }

        if (isset($filters['college_id']) || isset($filters['program_id']) || isset($filters['campus_id'])) {
            $this->db->join(Orm_Program_Plan::get_table_name().' AS pp', 'pp.course_id = n.item_id', 'INNER');
            $this->db->join(Orm_Program::get_table_name().' AS p', 'p.id = pp.program_id AND p.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Course::get_table_name().' AS cr', 'cr.id = pp.course_id AND cr.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Department::get_table_name().' AS d', 'd.id = p.department_id AND d.is_deleted = 0', 'INNER');
            $this->db->join(Orm_College::get_table_name().' AS c', 'c.id = d.college_id AND c.is_deleted = 0', 'INNER');
            $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'c.id = cc.college_id', 'INNER');
            $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');

            License::valid_colleges('c.id');
            License::valid_programs('p.id');
        }
        if (isset($filters['college_id'])) {
            $this->db->where('c.id', $filters['college_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('p.id', $filters['program_id']);
        }
        if (isset($filters['campus_id'])) {
            $this->db->where('cp.id', $filters['campus_id']);
        }

        return $this->db->get()->result_array();
    }



    public  function get_node_by_year($year,$class_type ) {

       $this->db->select('n.id');
       $this->db->distinct();
       $this->db->from(Orm_Node::get_table_name().' AS n');
       $this->db->where('n.is_deleted', 0);
       $this->db->where('n.year', $year);
       $this->db->where('n.class_type', $class_type);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        }

        return 0;
    }

}

