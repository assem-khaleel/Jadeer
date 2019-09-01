<?php
/** @var $equipments Orm_Rm_Equipment */
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Equipments Management') ?>

        </div>
        <?php if (!(Orm_User::has_role_teacher() && Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN))) { ?>
            <?php echo filter_block('/room_management/filter', '/room_management/equipments', ['keyword']); ?>
        <?php } ?>
    </div>
    
    <div class="table-responsive m-a-0">
      <table class="table table-bordered">
          <thead>
          <tr>
              <th class="col-md-2">
                  <?php echo lang('Equipment Title') ?>
              </th>

              <th class="col-md-3">
                  <?php echo lang('Notes') ?>
              </th>
              <th class="col-md-2">
                  <?php echo lang('Action') ?>
              </th>
          </tr>
          </thead>
          <tbody>
          <?php if(count($equipments)){?>
              <?php foreach ($equipments as $equipment ) : ?>
                  <tr>
                      <td><?php echo htmlfilter($equipment->get_name())?></td>
                      <td><?php echo htmlfilter($equipment->get_additional())?></td>
                      <td>
                          <?php if($equipment->check_if_can_edit()){?>
                              <a href="/room_management/equipments/create_edit/<?php echo  $equipment->get_id();  ?>"
                                 data-toggle="ajaxModal" class="btn btn-sm btn-block" >
                                  <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span>
                                  <?php echo lang('Edit') ?>
                              </a>
                          <?php } ?>
                          <?php if($equipment->check_if_can_delete()){?>
                              <a href="/room_management/equipments/delete/<?php echo  $equipment->get_id();  ?>"
                                 class="btn btn-sm  btn-block" title="Delete"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction">
                                  <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                                  <?php echo lang('Delete') ?>
                              </a>
                          <?php } ?>
                      </td>
                  </tr>
              <?php endforeach; ?>
          <?php }else{?>
              <tr>
                  <td colspan="3">
                      <div class="well well-sm m-a-0">
                          <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Equipments'); ?></h3>
                      </div>
                  </td>
              </tr>
          <?php }?>

          </tbody>
      </table>
      <?php if (!empty($pager)) { ?>
          <div class="table-footer">
              <?php echo $pager; ?>
          </div>
      <?php } ?>
  </div>
</div>


