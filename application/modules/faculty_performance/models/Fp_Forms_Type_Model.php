<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Forms_Type_Model extends CI_Model {

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

        $this->db->select('fft.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Forms_Type::get_table_name() . ' AS fft');
        $this->db->where('fft.deleted_at',0);
        
        if (isset($filters['id'])) {
            $this->db->where('fft.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fft.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fft.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fft.id', $filters['not_in_id']);
        }
        if (!empty($filters['type_name_en'])) {
            $this->db->where('fft.type_name_en', $filters['type_name_en']);
        }
        if (!empty($filters['type_name_ar'])) {
            $this->db->where('fft.type_name_ar', $filters['type_name_ar']);
        }
        if (isset($filters['created_at'])) {
            $this->db->where('fft.created_at', $filters['created_at']);
        }
        if (isset($filters['updated_at'])) {
            $this->db->where('fft.updated_at', $filters['updated_at']);
        }
        if (isset($filters['deleted_at'])) {
            $this->db->where('fft.deleted_at', $filters['deleted_at']);
        }
        if (isset($filters['is_removable'])) {
            $this->db->where('fft.is_removable', $filters['is_removable']);
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
                return Orm_Fp_Forms_Type::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Fp_Forms_Type::to_object($row);
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
        $this->db->insert(Orm_Fp_Forms_Type::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Forms_Type::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Forms_Type::get_table_name(), array('id' => $id));
    }
    
}
