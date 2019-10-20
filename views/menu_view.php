<?php $get_menus = get_menus( - 1, - 1 ); ?>
<div class="container mrt50">
  <div class="panel panel-border">
    <div class="clearfix panel-custom-color">
      <div id="of-popup-save" class="of-save-popup">
        <div class="of-save-save"><i class="fa fa-check"></i> <?php esc_html_e( 'Data Deleted', 'rs_russell' ); ?></div>
      </div>
      <div id="of-popup-fail" class="of-save-popup">
        <div class="of-save-fail"><i class="icon-remove"></i> <?php esc_html_e( 'Error! Not Saved', 'rs_russell' ); ?></div>
      </div>
      <div class="panel-heading pull-left">All Menus</div>
      <div class="panel-heading pull-right"><a href="admin.php?page=getweb_new_menu" class="btn btn-color">Add New</a></div>
    </div>
    <div class="panel-body">
      <table id="theme_option_table" class="table table-striped table-hover table-bordered" style="width:100%">
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Icon</th>
          <th>Parent</th>
          <th>Status</th>
          <th>Create Time</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
		<?php if ( isset( $get_menus ) && count( $get_menus ) > 0 ): ?>
			<?php $i = 1;
			foreach ( $get_menus as $row ): ?>
              <tr data-del="<?php echo $row->id; ?>">
                <td><?php echo $i ++; ?></td>
                <td><?php echo $row->name; ?></td>
                <td><i class="<?php echo $row->icon; ?>"></i></td>
                <td>
                <?php
                if ( $row->parent == 0 ) {
                  echo 'No Child';
                } else {
                  echo 'Child of '.menu_name_by_id( $row->parent );
                } ?>
                </td>
                <td>
					<?php if ( ! empty( $row->status == 1 ) ): ?>
                      <button type="button" class="btn btn-primary btn-sm " disabled>Visible</button>
					<?php else: ?>
                      <button type="button" class="btn btn-danger btn-sm " disabled>Unvisible</button>
					<?php endif ?>

                </td>
                <td><?php echo create_before( $row->created_at ); ?></td>
                <td>
                  <a href="admin.php?page=getweb_edit_menu&edit-id=<?php echo $row->id; ?>" class="btn btn-primary" data-id="<?php echo $row->id; ?>">Edit</a>
                  <a class="btn btn-danger deletegetweb" href="javascript:void(0)" data-id="<?php echo $row->id; ?>">Delete</a>
                </td>
              </tr>
			<?php endforeach ?>
		<?php endif ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
