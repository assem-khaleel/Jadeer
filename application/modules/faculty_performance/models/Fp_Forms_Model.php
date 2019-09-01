<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Forms_Model extends CI_Model {

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

        $this->db->select('ff.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Forms::get_table_name() . ' AS ff');
        $this->db->where('ff.deleted_at',0);
       
        
        if (isset($filters['id'])) {
            $this->db->where('ff.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ff.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ff.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ff.id', $filters['not_in_id']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('ff.type_id', $filters['type_id']);
        }
        if (!empty($filters['form_name_en'])) {
            $this->db->where('ff.form_name_en', $filters['form_name_en']);
        }
        if (!empty($filters['form_name_ar'])) {
            $this->db->where('ff.form_name_ar', $filters['form_name_ar']);
        }
        if (isset($filters['created_at'])) {
            $this->db->where('ff.created_at', $filters['created_at']);
        }
        if (isset($filters['updated_at'])) {
            $this->db->where('ff.updated_at', $filters['updated_at']);
        }
        if (isset($filters['deleted_at'])) {
            $this->db->where('ff.deleted_at', $filters['deleted_at']);
        }
        if (!empty($filters['static_file'])) {
            $this->db->where('ff.static_file', $filters['static_file']);
        }
        if (isset($filters['is_hidden'])) {
            $this->db->where('ff.is_hidden', $filters['is_hidden']);
        }
        if (isset($filters['is_editable'])) {
            $this->db->where('ff.is_editable', $filters['is_editable']);
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
                return Orm_Fp_Forms::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Fp_Forms::to_object($row);
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
        $this->db->insert(Orm_Fp_Forms::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Forms::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Forms::get_table_name(), array('id' => $id));
    }

}

