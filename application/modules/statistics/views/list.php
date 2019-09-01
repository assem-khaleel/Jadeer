<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/17/16
 * Time: 2:03 PM
 */
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption"><?php echo lang('Statistics Reports'); ?></div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-10"><?php echo lang('Report Name'); ?></th>
            <th class="col-md-1"><?php echo lang('View'); ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td><?php echo lang('Completion Rate Report'); ?></td>
            <td><a href="/statistics/completion_rate" class="btn btn-sm btn-block"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>2</td>
            <td><?php echo lang('Course Grades'); ?></td>
            <td><a href="/statistics/course_grade" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>3</td>
            <td><?php echo lang('Course Statuses'); ?></td>
            <td><a href="/statistics/course_status" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>4</td>
            <td><?php echo lang('Course Completion Rate'); ?></td>
            <td><a href="/statistics/course_students" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>5</td>
            <td><?php echo lang('Program Graduates & Enrolled'); ?></td>
            <td><a href="/statistics/graduate_enrolled" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>6</td>
            <td><?php echo lang('Program by Level Enrolled'); ?></td>
            <td><a href="/statistics/level_enrolled" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>7</td>
            <td><?php echo lang('Program Faculty Profile'); ?></td>
            <td><a href="/statistics/periodic" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>8</td>
            <td><?php echo lang('Preparatory Year Report'); ?></td>
            <td><a href="/statistics/prep_year" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr class="bg-primary">
            <td colspan="3"><strong><?php echo lang('Institution Profile Tables')?></strong></td>
        </tr>
        <tr>
            <td>10</td>
            <td><?php echo lang('Table 2. Preparatory or Foundation Program')?></td>
            <td><a href="/statistics/table_2" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>11</td>
            <td><?php echo lang('Table 3. Program Data')?></td>
            <td><a href="/statistics/table_3" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>12</td>
            <td><?php echo lang("Table 4. Summary of Programs' Teaching Staff")?></td>
            <td><a href="/statistics/table_4" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>13</td>
            <td><?php echo lang('Table 5. Numbers of Graduates in the Most Recent Year')?></td>
            <td><a href="/statistics/table_5" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>14</td>
            <td><?php echo lang('Table 6. Mode of Instruction – Student Enrollment')?></td>
            <td><a href="/statistics/table_6" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr>
            <td>15</td>
            <td><?php echo lang('Table 7. Mode of Instruction – Teaching Staff')?></td>
            <td><a href="/statistics/table_7" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        </tr>
        <tr>
            <td>16</td>
            <td><?php echo lang('Table 8. Program Completion Rate/Graduation Rate')?></td>
            <td><a href="/statistics/table_8" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>
        <tr class="bg-primary">
            <td colspan="3"><strong><?php echo lang('Institution Profile Tables')?> 2018</strong></td>
        </tr>
        <tr>
            <td>17</td>
            <td><?php echo lang('Table 8. Program Completion Rate/Graduation Rate')?></td>
            <td><a href="/statistics/table_8_2018" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-eye"></i></span><?php echo lang('View'); ?></a></td>
        </tr>

        <tr class="bg-primary">
            <td colspan="3"><strong><?php echo lang('Key Performance Indicator Tables')?></strong></td>
        </tr>
        <tr>
            <td>1</td>
            <td><?php echo lang('KPIs Trend Report')?></td>
            <td><a href="/kpi/report/6/1" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-file-pdf-o"></i></span><?php echo lang('PDF'); ?></a></td>
        </tr>
        <tr>
            <td>2</td>
            <td><?php echo lang('KPIs Details Report')?></td>
            <td><a href="/kpi/report/5/1" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-file-pdf-o"></i></span><?php echo lang('PDF'); ?></a></td>
        </tr>
        <tr>
            <td>3</td>
            <td><?php echo lang('KPIs Benchmarks Report')?></td>
            <td><a href="/kpi/report/4/1" class="btn btn-sm"><span class="btn-label-icon left"><i class="fa fa-file-pdf-o"></i></span><?php echo lang('PDF'); ?></a></td>
        </tr>
        </tbody>
    </table>
</div>
