<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property  CI_DB_query_builder $db
 * Class Program_Plan_Model
 */
class Program_Plan_Model extends CI_Model
{

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

        $this->db->select('pp.*');
        $this->db->distinct();
        $this->db->from(Orm_Program_Plan::get_table_name() . ' AS pp');
        $this->db->join(Orm_Program::get_table_name() . ' AS p', 'p.id = pp.program_id AND p.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Course::get_table_name() . ' AS co', 'co.id = pp.course_id AND co.is_deleted = 0', 'INNER');

        License::valid_programs('p.id');

        $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = co.department_id AND d.is_deleted = 0', 'INNER');
        $this->db->join(Orm_College::get_table_name() . ' AS c', 'c.id = d.college_id AND c.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'c.id = cc.college_id', 'INNER');
        $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');

        License::valid_colleges('c.id');

        if (isset($filters['department_id'])) {
            $this->db->where('d.id', $filters['department_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('c.id', $filters['college_id']);
        }
        if (isset($filters['campus_id'])) {
            $this->db->where('cp.id', $filters['campus_id']);
        }

        if (!empty($filters['semester_id'])) {
            $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', "cs.course_id = pp.course_id AND cs.is_deleted = 0 AND cs.semester_id = {$this->db->escape_str($filters['semester_id'])}", 'INNER');
        }

        if (isset($filters['id'])) {
            $this->db->where('pp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pp.id', $filters['not_in_id']);
        }

        if (isset($filters['integration_id'])) {
            $this->db->where('pp.integration_id', $filters['integration_id']);
        }

        if (isset($filters['program_id'])) {
            $this->db->where('pp.program_id', $filters['program_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('pp.course_id', $filters['course_id']);
        }
        if (isset($filters['course_id_in'])) {
            $this->db->where_in('pp.course_id', $filters['course_id_in']);
        }
        if (!empty($filters['level'])) {
            $this->db->where('pp.level', $filters['level']);
        }
        if (!empty($filters['credit_hours'])) {
            $this->db->where('pp.credit_hours', $filters['credit_hours']);
        }
        if (!empty($filters['is_required'])) {
            $this->db->where('pp.is_required', $filters['is_required']);
        }

        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('co.name_en', $filters['keyword']);
            $this->db->or_like('co.name_ar', $filters['keyword']);
            $this->db->or_like('co.code_ar', $filters['keyword']);
            $this->db->or_like('co.code_en', $filters['keyword']);
            $this->db->group_end();
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
                return Orm_Program_Plan::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Program_Plan::to_object($row);
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
        $this->db->insert(Orm_Program_Plan::get_table_name(), $params);
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
        return $this->db->update(Orm_Program_Plan::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Program_Plan::get_table_name(), array('id' => (int)$id));
    }

    public function levels($program_id, $not_levels = array())
    {
        $this->db->distinct(true);
        $this->db->select('level');
        $this->db->from(Orm_Program_Plan::get_table_name());
        $this->db->where('program_id', $program_id);

        if ($not_levels) {
            $this->db->where_not_in('level', $not_levels);
        }

        $this->db->order_by('level ASC');

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_max($program_id)
    {
        $this->db->select_max('level', 'max_level');
        $this->db->from(Orm_Program_Plan::get_table_name());
        $this->db->where('program_id', $program_id);
        $result = $this->db->get()->row_array();

        return isset($result['max_level']) ? $result['max_level'] : 0;
    }

    public function get_intersect_courses($program_id)
    {
        $this->db->select('id');
        $this->db->from(Orm_Program_Plan::get_table_name());
        $this->db->where('program_id', $program_id);
        $this->db->where_in('course_id', 'select course_id from ' . Orm_Program_Plan::get_table_name() . ' group by course_id having count(*) > 1', false);

        $result = $this->db->get()->result_array();
        return $result;
    }


    public function get_courses($filters)
    {
        $this->db->select('c.integration_id, c.id');
        $this->db->distinct();
        $this->db->from(Orm_Course::get_table_name() . ' AS c');
        $this->db->join(Orm_Program_Plan::get_table_name() . ' AS pp', 'pp.course_id = c.id', 'left');

        if (isset($filters['program_id'])) {
            $this->db->where('pp.program_id', $filters['program_id']);
        }

        if (isset($filters['college_id'])) {
            $this->db->join(Orm_Program::get_table_name() . ' AS p', 'p.id = pp.program_id', 'left');
            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id', 'left');
            $this->db->where('d.college_id', $filters['college_id']);
        }

        $result = $this->db->get()->result_array();
        return $result;
    }
}

