<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Sp_Objective_Model
 */
class Sp_Objective_Model extends CI_Model
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

        $this->db->select('so.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Objective::get_table_name().' AS so');

        if (isset($filters['action_plan_id'])) {
            $this->db->join(Orm_Sp_Initiative::get_table_name().' AS si', 'so.id = si.objective_id', 'left');
            $this->db->join(Orm_Sp_Action_Plan::get_table_name().' AS sa', 'sa.initiative_id = si.id', 'left');
            $this->db->where('si.id', $filters['action_plan_id']);
        }
        if (isset($filters['id'])) {
            $this->db->where('so.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('so.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('so.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('so.id', $filters['not_in_id']);
        }
        if (isset($filters['strategy_id'])) {
            $this->db->where('so.strategy_id', $filters['strategy_id']);
        }
        if (isset($filters['parent_id'])) {
            $this->db->where('so.parent_id', $filters['parent_id']);
        }
        if (!empty($filters['parent_lft']) && !empty($filters['parent_rtl'])) {
            $this->db->where("so.parent_lft BETWEEN {$filters['parent_lft']} AND {$filters['parent_rtl']}");
        }
        if (isset($filters['goal_id'])) {
            $this->db->where('so.goal_id', $filters['goal_id']);
        }
        if (!empty($filters['code'])) {
            $this->db->where('so.code', $filters['code']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('so.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('so.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('so.description_en', $filters['description_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('so.description_ar', $filters['description_ar']);
        }
        if (!empty($filters['perspective'])) {
            $this->db->join(Orm_Sp_Objective_Perspective::get_table_name() . ' AS sop', 'sop.objective_id = so.id');
            $this->db->where('sop.perspective', $filters['perspective']);
        }
        if (isset($filters['owner_id'])) {
            $this->db->where('so.owner_id', $filters['owner_id']);
        }
        if (!empty($filters['budget'])) {
            $this->db->where('so.budget', $filters['budget']);
        }
        if (!empty($filters['resources'])) {
            $this->db->where('so.resources', $filters['resources']);
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
                return Orm_Sp_Objective::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Sp_Objective::to_object($row);
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
        $this->db->insert(Orm_Sp_Objective::get_table_name(), $params);
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
        return $this->db->update(Orm_Sp_Objective::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Objective::get_table_name(), array('id' => (int)$id));
    }
    /**
     * this function get child total budget by its objective id
     * @param int $objective_id the objective id of the get child total budget to be call function
     * @return int the call function
     */
    public function get_child_total_budget($objective_id) {

        $this->db->select('SUM(budget) total');
        $this->db->from(Orm_Sp_Action_Plan::get_table_name().' sap');
        $this->db->join(Orm_Sp_Initiative::get_table_name().' si','sap.initiative_id = si.id','left');
        $this->db->where('si.objective_id',$objective_id);
        $result = $this->db->get()->row_array();

        return isset($result['total']) ? $result['total'] : 0;
    }
    /**
     * this function get date range by its objective id and type
     * @param int $objective_id the objective id of the get date range to be call function
     * @param string $type the type of the get date range to be call function
     * @return string the call function
     */
    public function get_date_range($objective_id, $type = 'start_date'){

        if($type == 'start_date') {
            $this->db->select_min('start_date');
        } else {
            $this->db->select_max('end_date');
        }

        $this->db->where('objective_id', $objective_id);
        $range = $this->db->get(Orm_Sp_Initiative::get_table_name())->row_array();

        return isset($range[$type]) ? $range[$type] : '0000-00-00';
    }
    /**
     * this function update group tree by its old id and new id and lft and rtl
     * @param int $old_id the old id of the update group tree to be call function
     * @param int $new_id the new id of the update group tree to be call function
     * @param string $lft the lft of the update group tree to be call function
     * @param $rtl $type the rtl of the update group tree to be call function
     */
    public function update_group_tree($old_id, $new_id, $lft, $rtl) {
        if($lft && $rtl) {
            $this->db->where("objective_id", $old_id);
            $this->db->where("parent_lft BETWEEN {$lft} AND {$rtl}");
            $this->db->update(Orm_Sp_Objective::get_table_name(), array('objective_id' => intval($new_id)));
        }
    }

    /**
     * this function build parent tree by its objective id
     * @param int $objective_id the objective id of the build parent tree to be call function
     */
    public function build_parent_tree($objective_id = 0) {
        $this->db->trans_start();
        $this->build_tree($objective_id);
        $this->db->trans_complete();
    }

    private static $children_tree = array();

    /**
     * this function build children tree by its objective id
     * @param int $objective_id the objective id of the build children tree to be call function
     * @return mixed the call function
     */
    private function build_children_tree($objective_id = 0){

        if(empty(self::$children_tree[$objective_id])) {

            $this->db->select('id, parent_id');
            if($objective_id) {
                $this->db->where('objective_id', $objective_id);
            }
            $objects = $this->db->get(Orm_Sp_Objective::get_table_name())->result_array();

            $children_tree = array();

            if($objects) {
                foreach($objects as $object) {
                    $children_tree[$object['parent_id']]['children'][] = $object;
                }
            }

            self::$children_tree[$objective_id] = $children_tree;
        }

        return self::$children_tree[$objective_id];
    }
    /**
     * this function build tree by its objective id and index and parent id
     * @param int $objective_id the objective id of the build tree to be call function
     * @param int $index the index of the build tree to be call function
     * @param int $parent_id the parent id  of the build tree to be call function
     */
    private function build_tree($objective_id = 0, &$index = 0, $parent_id = 0) {

        $children_tree = $this->build_children_tree($objective_id);

        $children = (empty($children_tree[$parent_id]['children']) ? array() : $children_tree[$parent_id]['children']);

        if($children) {
            foreach($children as $child) {
                $params = array();

                $index++;
                $params['parent_lft'] = $index;

                $this->build_tree($objective_id, $index, $child['id']);

                $index++;
                $params['parent_rtl'] = $index;

                $this->db->update(Orm_Sp_Objective::get_table_name(), $params, array('id' => (int) $child['id']));
            }
        }
    }
}

