<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_Model extends CI_Model
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

        $this->db->select('p.*');
        $this->db->distinct();
        $this->db->from(Orm_Program::get_table_name().' AS p');
        $this->db->where('p.is_deleted', 0);

        $this->db->join(Orm_Department::get_table_name().' AS d', 'd.id = p.department_id AND d.is_deleted = 0', 'INNER');
        $this->db->join(Orm_College::get_table_name().' AS c', 'c.id = d.college_id AND c.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Campus_College::get_table_name().' AS cc', 'c.id = cc.college_id', 'INNER');
        $this->db->join(Orm_Campus::get_table_name().' AS cp', 'cp.id = cc.campus_id AND cp.is_deleted = 0', 'INNER');

        License::valid_colleges('c.id');
        License::valid_programs('p.id');

        if (isset($filters['id'])) {
            $this->db->where('p.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('p.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('p.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('p.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('p.integration_id', $filters['integration_id']);
        }
        if (isset($filters['campus_id'])) {
            $this->db->where('cp.id', $filters['campus_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('c.id', $filters['college_id']);
        }
        if (isset($filters['department_id'])) {
            $this->db->where('p.department_id', $filters['department_id']);
        }
        if (!empty($filters['is_deleted'])) {
            $this->db->where('p.is_deleted', $filters['is_deleted']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('p.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('p.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['code_en'])) {
            $this->db->where('p.code_en', $filters['code_en']);
        }
        if (!empty($filters['code_ar'])) {
            $this->db->where('p.code_ar', $filters['code_ar']);
        }
        if (!empty($filters['credit_hours'])) {
            $this->db->where('p.credit_hours', $filters['credit_hours']);
        }
        if (!empty($filters['duration'])) {
            $this->db->where('p.duration', $filters['duration']);
        }
        if (isset($filters['degree_id'])) {
            $this->db->where('p.degree_id', $filters['degree_id']);
        }

        if (isset($filters['degree_status'])) {
            $this->db->join(Orm_Degree::get_table_name().' AS deg', 'deg.id = p.degree_id', 'INNER');
            $this->db->where('deg.is_undergraduate', $filters['degree_status']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('p.name_en', $filters['keyword']);
            $this->db->or_like('p.name_ar', $filters['keyword']);
            $this->db->group_end();
        }
        if (!empty($filters['integration_search'])) {
            $this->db->group_start();
            $this->db->like('p.integration_id', $filters['integration_search']);
            $this->db->group_end();
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        } else {
            $orders = array('name_en');
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Program::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Program::to_object($row);
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
        $this->db->insert(Orm_Program::get_table_name(), $params);
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
        return $this->db->update(Orm_Program::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->update(Orm_Program::get_table_name(), array('is_deleted'=>1), array('id' => (int) $id));
    }

}

