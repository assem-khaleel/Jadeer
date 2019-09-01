<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Kpi_Level extends Orm {

    /**
     * @var $instances Orm_Kpi_Level[]
     */
    protected static $instances = array();
    protected static $table_name = 'kpi_level';

    /**
     * class attributes
     */
    protected $id = 0;
    protected $level = '';
    protected $kpi_id = 0;

    /**
     * @return Kpi_Level_Model
     */
    public static function get_model() {
        return Orm::get_ci_model('Kpi_Level_Model');
    }

    /**
     * get instance
     *
     * @param int $id
     * @return Orm_Kpi_Level
     */
    public static function get_instance($id) {

        $id = intval($id);
        if(isset(self::$instances[$id])) {
            return self::$instances[$id];
        }

        return self::get_one(array('id' => $id));
    }

    /**
     * get all Objects
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     *
     * @return Orm_Kpi_Level[] | int
     */
    public static function get_all($filters = array(), $page = 0, $per_page = 0, $orders = array()) {
        return self::get_model()->get_all($filters, $page, $per_page, $orders, Orm::FETCH_OBJECTS);
    }

    /**
     * get one Object
     *
     * @param array $filters
     * @param array $orders
     * @return Orm_Kpi_Level
     */
    public static function get_one($filters = array(), $orders = array()) {

        $result = self::get_model()->get_all($filters, 1, 1, $orders, Orm::FETCH_OBJECT);

        if ($result && $result->get_id()) {
            return $result;
        }

        return new Orm_Kpi_Level();
    }

    /**
     * get count
     *
     * @param array $filters
     * @return int
     */
    public static function get_count($filters = array()) {
        return self::get_model()->get_all($filters, 0, 0, array(), Orm::FETCH_COUNT);
    }

    public function to_array() {
        $db_params = array();
        if (Orm::is_integration_mode() && $this->get_id()) {
            $db_params['id'] = $this->get_id();
        }
        $db_params['level'] = $this->get_level();
        $db_params['kpi_id'] = $this->get_kpi_id();

        return $db_params;
    }

    public function save() {
        if ($this->get_object_status() == 'new') {
            $insert_id = self::get_model()->insert($this->to_array());
            $this->set_id($insert_id);
        } elseif($this->get_object_fields()) {
            self::get_model()->update($this->get_id(), $this->get_object_fields());
        }

        $this->set_object_status('saved');
        $this->reset_object_fields();
        return $this->get_id();
    }

    public function delete() {
        return self::get_model()->delete($this->get_id());
    }

    public function set_id($value) {
        $this->add_object_field('id',$value);
        $this->id = $value;
        $this->push_instance();
    }

    public function get_id() {
        return $this->id;
    }

    public function set_level($value) {
        $this->add_object_field('level',$value);
        $this->level = $value;
    }

    public function get_level() {
        return $this->level;
    }

    public function set_kpi_id($value) {
        $this->add_object_field('kpi_id',$value);
        $this->kpi_id = $value;
    }

    public function get_kpi_id() {
        return $this->kpi_id;
    }

    /**
     * remove all data of kpi level depends on specific parameters
     * @param $filters
     * @return object
     */
    public static function delete_all($filters) {
        return self::get_model()->delete_all($filters);
    }

    private $legends = NULL;

    /**
     * get all legend of kpi depends on level id
     * @return int|Orm_Kpi_Legend[]
     */
    public function get_legends() {

        if (is_null($this->legends)) {
            $this->legends = Orm_Kpi_Legend::get_all(array('level_id' => $this->get_id()));
        }

        return $this->legends;
    }

    /**
     * get total count of legends that related to level id
     * @return int
     */
    public function get_legends_count() {
        return Orm_Kpi_Legend::get_count(array('level_id' => $this->get_id()));
    }

    /**
     *get the value of trend as a line length
     * @return string
     */
    public function get_trend_lines() {
        $trends = array();
        for ($i = 0; $i < count($this->get_legends()); $i++) {
            $trends[] = $i. ": {type: 'exponential', lineWidth: 2, opacity: .3}";
        }
        return implode(",", $trends);
    }

    /**
     * draw the column of charts depends on kpi data
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_chart_columns($kpi = null) {

        $html = "data.addColumn('string', '" . lang('Benchmarks') . "');" . "\n";
        if ($kpi->get_overall()) {
            $html .= "data.addColumn('number', '" . lang('Avg. Overall') . "');" . "\n";
            $html .= "data.addColumn({type: 'string', role: 'annotation'});" . "\n";
        } else {
            foreach ($this->get_legends() as $legend) {
                $html .= "data.addColumn('number', '" . htmlfilter($legend->get_title()) . "');" . "\n";
                $html .= "data.addColumn({type: 'string', role: 'annotation'});" . "\n";
            }
        }

        if (!$kpi->get_overall() && !count($this->get_legends())) {
            $html .= "data.addColumn('number', '" . lang('Avg. Overall') . "');" . "\n";
            $html .= "data.addColumn({type: 'string', role: 'annotation'});" . "\n";
        }

        return $html;
    }

    /**
     *  draw the column of table (for benchmark) depends on kpi data
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_table_columns($kpi = null) {

        $html = "table_data.addColumn('string', '" . lang('Benchmarks') . "');" . "\n";
        if ($kpi->get_overall()) {
            $html .= "table_data.addColumn('number', '" . lang('Avg. Overall') . "');" . "\n";
        } else {
            foreach ($this->get_legends() as $legend) {
                $html .= "table_data.addColumn('number', '" . htmlfilter($legend->get_title()) . "');" . "\n";
            }
        }

        if (!$kpi->get_overall() && !count($this->get_legends())) {
            $html .= "table_data.addColumn('number', '" . lang('Avg. Overall') . "');" . "\n";
        }

        return $html;
    }

    /**
     * draw table header for legends
     * @return string
     */
    public function draw_html_table_header() {
        $html = '';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="col-md-2"></th>';
        foreach ($this->get_legends() as $legend) {
            $html .= '<th class="col-md-2">' . htmlfilter($legend->get_title()) . '</th>';
        }
        $html .= '</tr>';
        $html .= '</thead>';
        return $html;
    }

    /**
     * drae all external benchmark
     * @param int $type
     * @param array $filters
     * @return string
     */
    public function draw_external_benchmarks($type = 0, $filters = array()) {
        $benchmarks = array();
        foreach ($this->get_legends() as $legend) {
            $externals = Orm_Kpi_Detail::get_external_benchmarks($legend->get_id(), $type, $filters);
            if (!empty($externals)) {
                $benchmarks = array_merge($benchmarks, $externals);
            }
        }
        $benchmarks = array_keys($benchmarks);
        $html = '';
        foreach ($benchmarks as $benchmark) {
            $html .= '<tr>';
            $html .= '<td><div class="input-group"><input class="form-control" name="external_title[' . htmlfilter($this->get_id()) . '][]" value="' . htmlfilter($benchmark) . '"><span class="input-group-btn"><button class="btn" type="button" onclick="removeExternal(this);"><i class="fa fa-minus"></i></button></span></div></td>';
            $html .= Orm_Kpi_Detail::draw_kpi_external_benchmarks_inputs($this->get_id(), $benchmark, $type, $filters);
            $html .= '</tr>';
        }
        return $html;
    }

    /**
     * draw the input of external benchmark
     * @return string
     */
    public function draw_external_benchmarks_inputs() {
        $html = '';
        $html .= '<tr>';
        $html .= '<td class="col-md-2"><div class="input-group"><input class="form-control" name="external_title[' . $this->get_id() . '][]"><span class="input-group-btn"><button class="btn" type="button" onclick="removeExternal(this);"><i class="fa fa-minus"></i></button></span></div></td>';
        foreach ($this->get_legends() as $legend) {
            $html .= '<td class="col-md-2"><input class="form-control" name="external_values_' . htmlfilter($legend->get_id()) . '[]"></td>';
        }
        $html .= '</tr>';
        return $html;
    }

    /**
     * draw the row of charts depends on specific data
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_chart_rows($type = 0, $filters = array(), $kpi = null) {

        $rows = array();

        $actual = Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi);
        $actual_array = explode(',',$actual);
        $aa = array();
        foreach ($actual_array as $a) {
            $aa[] = $a;
            $aa[] = "'{$a}'";
        }

        $target = Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'target_benchmark', $type, $filters, $kpi);
        $target_array = explode(',',$target);
        $bb = array();
        foreach ($target_array as $b) {
            $bb[] = $b;
            $bb[] = "'{$b}'";;
        }

        $internal_college = Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'internal_college_benchmark', $type, $filters, $kpi);
        $internal_college_array = explode(',',$internal_college);
        $cc = array();
        foreach ($internal_college_array as $c) {
            $cc[] = $c;
            $cc[] = "'{$c}'";;
        }

        $internal_institution = Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'internal_institution_benchmark', $type, $filters, $kpi);
        $internal_institution_array = explode(',',$internal_institution);
        $dd = array();
        foreach ($internal_institution_array as $d) {
            $dd[] = $d;
            $dd[] = "'{$d}'";;
        }

        $new = Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'new_benchmark', $type, $filters, $kpi);
        $new_array = explode(',',$new);
        $ee = array();
        foreach ($new_array as $e) {
            $ee[] = $e;
            $ee[] = "'{$e}'";;
        }

        $rows[] = "['" . lang('Actual Benchmark') . "'," . implode(',',$aa) . "]";
        $rows[] = "['". lang('Target Benchmark') ."'," . implode(',',$bb) . "]";
        $rows[] = "['". lang('College Benchmark') ."'," . implode(',',$cc) . "]";
        $rows[] = "['". lang('Institution Benchmark') ."'," . implode(',',$dd) . "]";
        $rows[] = "['". lang('New Benchmark') ."'," . implode(',',$ee) . "]";

        $benchmarks = array();
        foreach ($this->get_legends() as $legend) {
            $externals = Orm_Kpi_Detail::get_external_benchmarks($legend->get_id(), $type, $filters, $kpi);
            if (!empty($externals)) {
                $benchmarks = array_merge($benchmarks, $externals);
            }
        }
        $benchmarks = array_keys($benchmarks);

        foreach ($benchmarks as $benchmark) {

            $external = Orm_Kpi_Detail::draw_kpi_external_benchmarks_chart($this->get_id(), $benchmark, $type, $filters, $kpi);
            $external_array = explode(',',$external);
            $ff = array();
            foreach ($external_array as $f) {
                $ff[] = $f;
                $ff[] = "'{$f}'";;
            }

            $rows[] = "['" . lang('External') . ' ' . $benchmark . "'," . implode(',',$ff) . "]";
        }
        return implode(',', $rows);
    }

    /**
     * draw the row of table depends on specific data
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_table_rows($type = 0, $filters = array(), $kpi = null) {

        $rows = array();

        $rows[] = "['" . lang('Actual Benchmark') . "'," . Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi) . "]";
        $rows[] = "['". lang('Target Benchmark') ."'," . Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'target_benchmark', $type, $filters, $kpi) . "]";
        $rows[] = "['". lang('College Benchmark') ."'," . Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'internal_college_benchmark', $type, $filters, $kpi) . "]";
        $rows[] = "['". lang('Institution Benchmark') ."'," . Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'internal_institution_benchmark', $type, $filters, $kpi) . "]";
        $rows[] = "['". lang('New Benchmark') ."'," . Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'new_benchmark', $type, $filters, $kpi) . "]";

        $benchmarks = array();
        foreach ($this->get_legends() as $legend) {
            $externals = Orm_Kpi_Detail::get_external_benchmarks($legend->get_id(), $type, $filters, $kpi);
            if (!empty($externals)) {
                $benchmarks = array_merge($benchmarks, $externals);
            }
        }
        $benchmarks = array_keys($benchmarks);

        foreach ($benchmarks as $benchmark) {
            $rows[] = "['" . lang('External') . ' ' . $benchmark . "'," . Orm_Kpi_Detail::draw_kpi_external_benchmarks_chart($this->get_id(), $benchmark, $type, $filters, $kpi) . "]";
        }
        return implode(',', $rows);
    }

    /**
     * get all rows of benchmark depends on these parameters
     * @param int $type
     * @param array $filters
     * @param null $kpi
     * @return array
     */
    public function get_rows($type = 0, $filters = array(), $kpi = null) {

        $rows = array();
        $rows['Actual Benchmark'] = Orm_Kpi_Detail::draw_kpi_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi);
        $rows['Target Benchmark'] = Orm_Kpi_Detail::draw_kpi_values($this->get_id(), 'target_benchmark', $type, $filters, $kpi);
        $rows['College Benchmark'] = Orm_Kpi_Detail::draw_kpi_values($this->get_id(), 'internal_college_benchmark', $type, $filters, $kpi);
        $rows['Institution Benchmark'] = Orm_Kpi_Detail::draw_kpi_values($this->get_id(), 'internal_institution_benchmark', $type, $filters, $kpi);
        $rows['New Benchmark'] = Orm_Kpi_Detail::draw_kpi_values($this->get_id(), 'new_benchmark', $type, $filters, $kpi);
        $rows['External'] = array();
        $benchmarks = array();
        foreach ($this->get_legends() as $legend) {
            $externals = Orm_Kpi_Detail::get_external_benchmarks($legend->get_id(), $type, $filters, $kpi);
            if (!empty($externals)) {
                $benchmarks = array_merge($benchmarks, $externals);
            }
        }
        $benchmarks = array_keys($benchmarks);

        foreach ($benchmarks as $benchmark) {
            $rows['External'][$benchmark] = explode(',',Orm_Kpi_Detail::draw_kpi_external_benchmarks_chart($this->get_id(), $benchmark, $type, $filters, $kpi));
        }
        return $rows;
    }

    /**
     * get all rows of benchmark depends on these parameters as html
     * @param int $type
     * @param array $filters
     * @return string
     */
    public function draw_html_inputs($type = 0, $filters = array()) {
        $html = '<tr>';
        $html .= '<td><span>' . lang('Actual Benchmark') . '</span></td>';
        $html .= Orm_Kpi_Detail::draw_kpi_values_inputs($this->get_id(), 'actual_benchmark', $type, $filters);
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><span>' . lang('Target Benchmark') . '</span></td>';
        $html .= Orm_Kpi_Detail::draw_kpi_values_inputs($this->get_id(), 'target_benchmark', $type, $filters);
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><span>' . lang('College Benchmark') . '</span></td>';
        $html .= Orm_Kpi_Detail::draw_kpi_values_inputs($this->get_id(), 'internal_college_benchmark', $type, $filters);
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><span>' . lang('Institution Benchmark') . '</span></td>';
        $html .= Orm_Kpi_Detail::draw_kpi_values_inputs($this->get_id(), 'internal_institution_benchmark', $type, $filters);
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td><span>' . lang('New Benchmark') . '</span></td>';
        $html .= Orm_Kpi_Detail::draw_kpi_values_inputs($this->get_id(), 'new_benchmark', $type, $filters);
        $html .= '</tr>';
        $html .= $this->draw_external_benchmarks($type, $filters);

        return $html;
    }

    /**
     * get values of benchmark
     * @param $type
     * @param $filters
     * @param Orm_Kpi $kpi
     * @return array
     */
    public function get_values($type, $filters, $kpi) {
        $rows = array();

        $rows['actual_benchmark'] = str_replace(',',':',Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi));
        $rows['target_benchmark'] = str_replace(',',':',Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'target_benchmark', $type, $filters, $kpi));
        $rows['internal_college_benchmark'] = str_replace(',',':',Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'internal_college_benchmark', $type, $filters, $kpi));
        $rows['internal_institution_benchmark'] = str_replace(',',':',Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'internal_institution_benchmark', $type, $filters, $kpi));
        $rows['new_benchmark'] = str_replace(',',':',Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'new_benchmark', $type, $filters, $kpi));

        $benchmarks = array();
        foreach ($this->get_legends() as $legend) {
            $externals = Orm_Kpi_Detail::get_external_benchmarks($legend->get_id(), $type, $filters, $kpi);
            if (!empty($externals)) {
                $benchmarks = array_merge($benchmarks, $externals);
            }
        }
        $benchmarks = array_keys($benchmarks);
        $rows['external'] = '';
        foreach ($benchmarks as $benchmark) {
            $rows['external'] .= $benchmark . ": (" . str_replace(',',':',Orm_Kpi_Detail::draw_kpi_external_benchmarks_chart($this->get_id(), $benchmark, $type, $filters, $kpi)) . ") \n";
        }

        return $rows;
    }

    /**
     * draw chart for kpi depends on these parameters
     * @param int $type
     * @param array $filters
     * @param string $label
     * @param bool $is_single
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_chart($type = 0, $filters = array(), $label = '', $is_single = true, $kpi = null) {

        $title = lang('Benchmarks');
        $chart_title = is_numeric($this->get_level()) ? '' : $this->get_level();

        $table_script =
            "
                var table_data = new google.visualization.DataTable();
                {$this->draw_table_columns($kpi)}
                table_data.addRows([{$this->draw_table_rows($type, $filters, $kpi)}]);
                var table = new google.visualization.Table(document.getElementById('kpi-table-{$this->get_id()}-{$kpi->get_id()}'));
						table.draw(table_data, {showRowNumber: false, width: '100%', allowHtml: true, cssClassNames: {headerCell:'col-md-1'}});
						$('.google-visualization-table-table')
						.removeClass('google-visualization-table-table')
						.addClass('table table-bordered table-condensed');
						
						$('.gradient').removeClass('gradient');
                ";
        if (isset($filters['disable_table']) && $filters['disable_table']) {
            $table_script = '';
        }

        $html = '<div id="kpi-chart-' . htmlfilter($this->get_id()) . '-' . htmlfilter($kpi->get_id()) . '" style="height:300px;width:100%;"></div>';
        $html .= $table_script ? '<div id="kpi-table-' . htmlfilter($this->get_id()) . '-' . htmlfilter($kpi->get_id()) . '" class="table-primary text-primary" ></div>' : '';
        $html .= isset($filters['disable_table']) && $filters['disable_table'] ? '<div id="kpi-table-' . htmlfilter($this->get_id()) . '-' . htmlfilter($kpi->get_id()) . '"  class="table-primary"></div>' : '';
        $html .= <<<SCRIPT
				<script>
				    
				    if (typeof google.visualization === 'undefined') {
				        google.load('visualization', '1', {'packages':['corechart', 'bar', 'table']});
                        google.setOnLoadCallback(drawChart_{$this->get_id()}_{$kpi->get_id()});
                    } else {
                        drawChart_{$this->get_id()}_{$kpi->get_id()}();
                    }
                            
					function drawChart_{$this->get_id()}_{$kpi->get_id()}() {
						var data = new google.visualization.DataTable();
						{$this->draw_chart_columns($kpi)}
						data.addRows([{$this->draw_chart_rows($type, $filters, $kpi)}]);
						var options = {
							allowHtml: true,
							title: '{$chart_title}',
							hAxis: {
								title: '{$title}',
								viewWindow: {
									min: [7, 30, 0],
									max: [17, 30, 0]
								}
							},
							vAxis: {
								title: '{$label}',
								viewWindowMode: 'explicit',
								minValue: 0
							},
							bar: { groupWidth: '80%' },
							chartArea: { height: "50%",left: 50},
							annotations: {
							    alwaysOutside: true,
							    textStyle: {
							        fontSize: 10
							    }
							}
						};

						var chart = new google.visualization.ColumnChart(document.getElementById('kpi-chart-{$this->get_id()}-{$kpi->get_id()}'));
						chart.draw(data, options);

						{$table_script}
					}
				</script>
SCRIPT;
        $html .= (isset($filters['is_modal']) ? "<script>drawChart_{$this->get_id()}_{$kpi->get_id()}();</script>" : "");
        $html .= (isset($filters['is_report']) ? "<script>drawChart_{$this->get_id()}_{$kpi->get_id()}();</script>" : "");

        return $html;
    }


    /**
     * draw data of kpi as chart
     * @param int $type
     * @param array $filters
     * @return string
     */
    public function draw_html($type = 0, $filters = array()) {
        $html = '<div class="table-primary">';
        $html .= '<div class="table-header">';
        $html .= '<span class="table-caption">' . (is_numeric($this->get_level()) ? '&nbsp;' : htmlfilter($this->get_level())) . '</span>';
        $html .= '<div class="panel-heading-controls col-sm-4"><button type="button" style="font-size: 11px;" class="btn btn-sm " onclick="addExternal' . $this->get_id() . '(' . $this->get_id() . ')"> <span class="btn-label-icon left""><i class="fa fa-plus"></i></span>' . lang('Add').' '.lang('External Benchmark') . '</button></div>';
        $html .= '</div>';
        $html .= '<table class="table table-responsive" id="level-' . htmlfilter($this->get_id()) . '">';
        $html .= $this->draw_html_table_header();
        $html .= '<tbody>';
        $html .= $this->draw_html_inputs($type, $filters);
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';

        $html .= <<<SCRIPT
		<script>
		function addExternal{$this->get_id()}(id)
		{
			var html = '{$this->draw_external_benchmarks_inputs()}';
			var last_tr = $('#level-'+id+' > tbody > tr:last');
			if (last_tr.length > 0)
			{
				last_tr.after(html);
			}
			else
			{
				$('#level-'+id+' > tbody').append(html);
			}
			return false;
		}
		</script>
SCRIPT;

        return $html;
    }

    /**
     * draw the column of trend in chart depends on:
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function get_trend_chart_columns($kpi = null) {

        $html = "data.addColumn('" . 'string' . "', '" . ($kpi->get_is_semester() ? lang('Semesters') : lang('Years')) . "');" . "\n";
        if ($kpi->get_overall()) {
            $html .= "data.addColumn('number', '" . lang('Avg. Overall') . "');" . "\n";
            $html .= "data.addColumn({type: 'string', role: 'annotation'});" . "\n";
        } else {
            foreach ($this->get_legends() as $legend) {
                $html .= "data.addColumn('number', '" . htmlfilter($legend->get_title()) . "');" . "\n";
                $html .= "data.addColumn({type: 'string', role: 'annotation'});" . "\n";
            }
        }

        return $html;
    }

    /**
     * draw the column of trend depends on:
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function get_trend_table_columns($kpi = null) {
        $html = "table_data.addColumn('string', '" . ($kpi->get_is_semester() ? lang('Semesters') : lang('Years')) . "');" . "\n";
        if ($kpi->get_overall()) {
            $html .= "table_data.addColumn('number', '" . lang('Avg. Overall') . "');" . "\n";
        } else {
            foreach ($this->get_legends() as $legend) {
                $html .= "table_data.addColumn('number', '" . htmlfilter($legend->get_title()) . "');" . "\n";
            }
        }

        return $html;
    }


    /**
     * draw row of trend chart depends on :
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @param array $min_max
     * @return string
     */
    public function draw_trend_chart_rows($type = 0, $filters = array(), $kpi = null, &$min_max) {

        $rows = array();
        $current_semester = Orm_Semester::get_active_semester();
        if ($kpi->get_is_semester()) {
            $slices = Orm_Semester::get_model()->get_last_five_semesters($current_semester->get_id());
        } else {
            $slices = Orm_Semester::get_model()->get_last_five_years($current_semester->get_year());
        }

        foreach ($slices as $slice) {
            if ($kpi->get_is_semester()) {
                $filters['semester_id'] = $slice['id'];
            } else {
                $filters['academic_year'] = $slice['year'];
            }
            $actual = Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi);
            $actual_array = explode(',',$actual);
            $aa = array();
            foreach ($actual_array as $a) {
                $aa[] = $a;
                $aa[] = "'{$a}'";
            }
            $rows[] = "['" . $slice['year'] . "'," . implode(',',$aa) . "]";
            /*
            if (is_numeric($slice['year'])) {
                $rows[] = "[" . $slice['year'] . "," . implode(',',$aa) . "]";
            } else {
                $rows[] = "['" . $slice['year'] . "'," . implode(',',$aa) . "]";
            }
            */
        }
        $revers_rows = array();
        $index = count($rows);
        while ($index) {
            $revers_rows[] = $rows[--$index];
        }
        return implode(',', $revers_rows);
    }

    /**
     * draw row of trend table depends on :
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_trend_table_rows($type = 0, $filters = array(), $kpi = null) {

        $rows = array();
        $current_semester = Orm_Semester::get_active_semester();
        if ($kpi->get_is_semester()) {
            $slices = Orm_Semester::get_model()->get_last_five_semesters($current_semester->get_id());
        } else {
            $slices = Orm_Semester::get_model()->get_last_five_years($current_semester->get_year());
        }
        foreach ($slices as $slice) {
            if ($kpi->get_is_semester()) {
                $filters['semester_id'] = $slice['id'];
            } else {
                $filters['academic_year'] = $slice['year'];
            }

            $rows[] = "['" . $slice['year'] . "'," . Orm_Kpi_Detail::draw_kpi_chart_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi) . "]";
        }
        $revers_rows = array();
        $index = count($rows);
        while ($index) {
            $revers_rows[] = $rows[--$index];
        }
        return implode(',', $revers_rows);
    }

    /**
     * draw value of trend depends on :
     * @param int $type
     * @param array $filters
     * @param Orm_Kpi $kpi
     * @return array
     */
    public function get_trend_values($type = 0, $filters = array(), $kpi = null) {

        $rows = array();
        $current_semester = Orm_Semester::get_active_semester();
        /*
        if ($kpi->get_is_semester()) {
            $slices = Orm_Semester::get_model()->get_last_five_semesters($current_semester->get_id());
        } else {
            $slices = Orm_Semester::get_model()->get_last_five_years($current_semester->get_year());
        }
        */
        $slices = Orm_Semester::get_model()->get_last_five_years($current_semester->get_year());
        foreach ($slices as $slice) {
            /*
            if ($kpi->get_is_semester()) {
                $filters['semester_id'] = $slice['id'];
            } else {
                $filters['academic_year'] = $slice['year'];
            }
            */
            $filters['academic_year'] = $slice['year'];
            $rows[$slice['year']] = Orm_Kpi_Detail::draw_kpi_values($this->get_id(), 'actual_benchmark', $type, $filters, $kpi);
        }
        return array_reverse($rows);
    }

    /**draw chart of trend depends on :
     *
     * @param int $type
     * @param array $filters
     * @param string $label
     * @param bool $is_single
     * @param Orm_Kpi $kpi
     * @return string
     */
    public function draw_trend_chart($type = 0, $filters = array(), $label = '', $is_single = true, $kpi = null) {
        $title = lang('Benchmarks');
        $chart_title = is_numeric($this->level) ? "" : $this->get_level();

        $html = '<div id="kpi-trend-chart-' . htmlfilter($this->get_id()) . '" style="height:300px;"></div>' . "\n";
        $html .= '<div id="kpi-trend-table-' . htmlfilter($this->get_id()) . '" class="table-primary text-primary" ></div>' . "\n";

        $min_max = array();

        $html .= <<<SCRIPT
<script>
    
    if (typeof google.visualization === 'undefined') {
        google.load('visualization', '1', {'packages':['corechart', 'bar', 'table']});
        google.setOnLoadCallback(drawTrendChart_{$this->get_id()});
    } else {
        drawTrendChart_{$this->get_id()}();
    }
                    
	function drawTrendChart_{$this->get_id()}() {
		var data = new google.visualization.DataTable();
		{$this->get_trend_chart_columns($kpi)}
		data.addRows([{$this->draw_trend_chart_rows($type, $filters, $kpi, $min_max)}]);
		var options = {
			title: '{$chart_title}',
			hAxis: {
				title: '{$title}',
				format: ''
			},
			vAxis: {
				title: '{$label}',
				minValue: 0
			},
			bar: { groupWidth: '70%' },
			chartArea: { height: "50%",left: 50},
			annotations: {
			    textStyle: {
				    fontSize: 8
				}
			}
		};
		var chart = new google.visualization.LineChart(document.getElementById('kpi-trend-chart-{$this->get_id()}'));
		chart.draw(data, options);

		var table_data = new google.visualization.DataTable();
		{$this->get_trend_table_columns($kpi)}
        table_data.addRows([{$this->draw_trend_table_rows($type, $filters, $kpi)}]);

		var table = new google.visualization.Table(document.getElementById('kpi-trend-table-{$this->get_id()}'));
        table.draw(table_data, {showRowNumber: true, width: '100%'});
        $(".google-visualization-table-table")
        .removeClass('google-visualization-table-table')
        .addClass('table table-bordered table-condensed');
        
        $('.gradient').removeClass('gradient');
	}
</script>
SCRIPT;
        $html .= (isset($filters['is_report']) ? "<script>drawTrendChart_{$this->get_id()}();</script>" : "");

        return $html;
    }
}