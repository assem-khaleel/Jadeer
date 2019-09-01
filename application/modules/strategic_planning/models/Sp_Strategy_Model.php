<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sp_Strategy_Model extends CI_Model
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

        $this->db->select('ss.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Strategy::get_table_name().' AS ss');

        if (isset($filters['id'])) {
            $this->db->where('ss.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ss.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ss.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ss.id', $filters['not_in_id']);
        }
        if (isset($filters['strategy_id'])) {
            $this->db->where('ss.strategy_id', $filters['strategy_id']);
        }
        if (isset($filters['parent_id'])) {
            $this->db->where('ss.parent_id', $filters['parent_id']);
        }
        if (!empty($filters['parent_lft']) && !empty($filters['parent_rgt'])) {
            $this->db->where("ss.parent_lft BETWEEN {$filters['parent_lft']} AND {$filters['parent_rgt']}");
        }
        if (!empty($filters['item_class'])) {
            $this->db->where('ss.item_class', $filters['item_class']);
        }
        if (isset($filters['item_id'])) {
            $this->db->where('ss.item_id', $filters['item_id']);
        }
        if (!empty($filters['year'])) {
            $this->db->where('ss.year', $filters['year']);
        }
        if (!empty($filters['between_year'])) {
            if (!empty($filters['or_between_year'])) {
                $this->db->group_start();
            }
            $this->db->group_start();
                $this->db->where('ss.start_year <=', $filters['between_year']);
                $this->db->where('ss.year >=', $filters['between_year']);
            $this->db->group_end();

            if (!empty($filters['or_between_year'])) {

                $this->db->or_group_start();
                    $this->db->where('ss.start_year <=', $filters['or_between_year']);
                    $this->db->where('ss.year >=', $filters['or_between_year']);
                $this->db->group_end();
                $this->db->group_end();
            }
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('ss.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('ss.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['vision_en'])) {
            $this->db->where('ss.vision_en', $filters['vision_en']);
        }
        if (!empty($filters['vision_ar'])) {
            $this->db->where('ss.vision_ar', $filters['vision_ar']);
        }
        if (!empty($filters['mission_en'])) {
            $this->db->where('ss.mission_en', $filters['mission_en']);
        }
        if (!empty($filters['mission_ar'])) {
            $this->db->where('ss.mission_ar', $filters['mission_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('ss.description_en', $filters['description_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('ss.description_ar', $filters['description_ar']);
        }
        if (!empty($filters['year_less_than'])) {
            $this->db->where('ss.year >=', $filters['year_less_than']);
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
                return Orm_Sp_Strategy::to_object($row, (empty($row['item_class']) ? null : $row['item_class']));
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    if(!empty($row['id'])) {
                        $objects[$row['id']] = Orm_Sp_Strategy::to_object($row, (empty($row['item_class']) ? null : $row['item_class']));
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
        $this->db->insert(Orm_Sp_Strategy::get_table_name(), $params);
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
        return $this->db->update(Orm_Sp_Strategy::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Strategy::get_table_name(), array('id' => (int)$id));
    }

    /**
     * this function build parent tree by its strategy id
     * @param int $strategy_id the strategy id of the build parent tree to be call function
     */
    public function build_parent_tree($strategy_id = 0) {
        $this->db->trans_start();
        $this->build_tree($strategy_id);
        $this->db->trans_complete();
    }

    private static $children_tree = array();

    /**
     * this function build children tree by its strategy id
     * @param int $strategy_id the strategy id of the build children tree to be call function
     * @return mixed the call function
     */
    private function build_children_tree($strategy_id = 0){

        if(empty(self::$children_tree[$strategy_id])) {

            $this->db->select('id, parent_id');
            if($strategy_id) {
                $this->db->where('strategy_id', $strategy_id);
            }
            $objects = $this->db->get(Orm_Sp_Strategy::get_table_name())->result_array();

            $children_tree = array();

            if($objects) {
                foreach($objects as $object) {
                    $children_tree[$object['parent_id']]['children'][] = $object;
                }
            }

            self::$children_tree[$strategy_id] = $children_tree;
        }

        return self::$children_tree[$strategy_id];
    }
    /**
     * this function build tree by its strategy id and index and parent id
     * @param int $strategy_id the strategy id of the build tree to be call function
     * @param int $index the index of the build tree to be call function
     * @param int $parent_id the parent id  of the build tree to be call function
     */
    private function build_tree($strategy_id = 0, &$index = 0, $parent_id = 0) {

        $children_tree = $this->build_children_tree($strategy_id);

        $children = (empty($children_tree[$parent_id]['children']) ? array() : $children_tree[$parent_id]['children']);

        if($children) {
            foreach($children as $child) {
                $params = array();

                $index++;
                $params['parent_lft'] = $index;

                $this->build_tree($strategy_id, $index, $child['id']);

                $index++;
                $params['parent_rgt'] = $index;

                $this->db->update(Orm_Sp_Strategy::get_table_name(), $params, array('id' => (int) $child['id']));
            }
        }
    }
    /**
     * this function get date range by its strategy id and type
     * @param int $strategy_id the strategy id of the get date range to be call function
     * @param string $type the type of the get date range to be call function
     * @return string the call function
     */
    public function get_date_range($strategy_id, $type = 'start_date'){

        if($type == 'start_date') {
            $this->db->select_min('start_date');
        } else {
            $this->db->select_max('end_date');
        }
        $this->db->where('so.strategy_id', $strategy_id);
        $this->db->join(Orm_Sp_Strategy::get_table_name().' AS s', 's.id = so.strategy_id', 'left');
        $range = $this->db->get(Orm_Sp_Objective::get_table_name().' AS so')->row_array();

        return isset($range[$type]) ? $range[$type] : '0000-00-00';
    }

    /**
     * @param $table : history table name
     * @param $table_id : type table id
     * @param string $type : lead | lag
     * @param bool|false $last_period
     * @return int
     */
    /**
     * this function get progress type by its table and table id abd type and last period
     * @param string $table the table of the get progress type to be call function
     * @param int $table_id the table id of the get progress type to be call function
     * @param string $type the type of the get progress type to be call function
     * @param bool $last_period the last period of the get progress type to be call function
     * @return int the call function
     */
    public function get_progress_type($table, $table_id, $type = 'lead', $last_period = false) {

        $date = Orm_Sp_Strategy::get_period_date($last_period);

        $sql = "SELECT
                    {$type}
                FROM
                    (SELECT
                        {$type}, date
                    FROM
                        sp_{$table}_history
                    WHERE
                        {$table}_id = {$table_id} UNION SELECT
                        {$type}, CURDATE() AS date
                    FROM
                        sp_{$table}
                    WHERE
                        id = {$table_id}) AS history
                WHERE
                    history.date <= '{$date}'
                ORDER BY date DESC
                LIMIT 1";

        $result = $this->db->query($sql)->row_array();

        return isset($result[$type]) ? $result[$type] : 0;
    }


    /**
     * this function get target type by its table and table id
     * @param string $table the table of the get target type to be call function
     * @param int $table_id the table id of the get target type to be call function
     * @return int the call function
     */
    public function get_target_type($table, $table_id) {

        return 100;

    }
    /**
     * this function get perspectives by its id
     * @param int $id the id of the get perspectives to be call function
     * @return array the call function
     */
    public function get_perspectives($id) {
        $this->db->select('perspective');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Objective::get_table_name().' so');
        $this->db->join(Orm_Sp_Objective_Perspective::get_table_name().' sop', 'sop.objective_id=so.id');
        $this->db->where('so.strategy_id', $id);

        $rs = $this->db->get();

        if($rs->num_rows()) {
            return array_column($rs->result_array(), 'perspective');
        }

        return [];

    }
}

