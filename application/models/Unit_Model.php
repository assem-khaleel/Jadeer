<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_Model extends CI_Model {

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
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('u.*');
        $this->db->distinct();
        $this->db->from(Orm_Unit::get_table_name().' AS u');
        $this->db->where('u.is_deleted',0);

        if (isset($filters['id'])) {
            $this->db->where('u.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('u.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('u.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('u.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('u.integration_id', $filters['integration_id']);
        }
        if (isset($filters['parent_id'])) {
            $this->db->where('u.parent_id', $filters['parent_id']);
        }
        if (!empty($filters['is_deleted'])) {
            $this->db->where('u.is_deleted', $filters['is_deleted']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('u.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('u.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('u.name_en', $filters['keyword']);
            $this->db->or_like('u.name_ar', $filters['keyword']);
            $this->db->group_end();
        }
        if (!empty($filters['class_type'])) {
            $this->db->where('u.class_type', $filters['class_type']);
        }
        if (!empty($filters['not_class_type'])) {
            $this->db->where('u.class_type !=', $filters['not_class_type']);
        }
        if (isset($filters['is_academic'])) {
            $this->db->where('u.is_academic', $filters['is_academic']);
        }
        if (!empty($filters['parent_type'])) {
            $this->db->where('u.parent_type', $filters['parent_type']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                $row = $this->db->get()->row_array();
                return Orm_Unit::to_object($row, (empty($row['class_type']) ? null : $row['class_type']));
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Unit::to_object($row, (empty($row['class_type']) ? '' : $row['class_type']));
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
    public function insert($params = array()) {
        $this->db->insert(Orm_Unit::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Unit::get_table_name(), $params, array('id' => (int) $id));
    }

    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Unit::get_table_name(), array('is_deleted'=>1), array('id' => (int) $id));
//        return $this->db->delete(Orm_Unit::get_table_name(), array('id' => (int) $id));
    }

}

