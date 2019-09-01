<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Book_Model extends CI_Model {
    
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
        
        $this->db->select('fb.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Book::get_table_name().' AS fb');
        
        if (isset($filters['id'])) {
            $this->db->where('fb.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fb.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fb.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fb.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fb.user_id', $filters['user_id']);
        }
        if (!empty($filters['title'])) {
            $this->db->where('fb.title', $filters['title']);
        }
        if (!empty($filters['author_type'])) {
            $this->db->where('fb.author_type', $filters['author_type']);
        }
        if (!empty($filters['authors'])) {
            $this->db->where('fb.authors', $filters['authors']);
        }
        if (!empty($filters['authors_no'])) {
            $this->db->where('fb.authors_no', $filters['authors_no']);
        }
        if (!empty($filters['publish_date'])) {
            $this->db->where('fb.publish_date', $filters['publish_date']);
        }
        if (!empty($filters['publisher'])) {
            $this->db->where('fb.publisher', $filters['publisher']);
        }
        if (!empty($filters['pages_count'])) {
            $this->db->where('fb.pages_count', $filters['pages_count']);
        }
        if (!empty($filters['attachment'])) {
            $this->db->where('fb.attachment', $filters['attachment']);
        }
        if (!empty($filters['is_translate'])) {
            $this->db->where('fb.is_translate', $filters['is_translate']);
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
            return Orm_Fp_Book::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Book::to_object($row);
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
        $this->db->insert(Orm_Fp_Book::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Book::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Book::get_table_name(), array('id' => (int) $id));
    }
    
}

