<?php
$edit_id = isset($_GET['edit-id'])? intval($_GET['edit-id']): 0;
$menu_by_id = get_menu_by_id($edit_id)
?>
<div class="container mrt50">
    <div class="panel panel-border">
       <div class="clearfix panel-custom-color">
	       <?php include 'message.php';?>
           <div class="panel-heading pull-left">Update <?php echo $menu_by_id['name'] ; ?> Menu</div>
         <div class="panel-heading pull-right">
           <a href="admin.php?page=getweb_option_menus" class="btn btn-color">Cancel</a>
           <a href="admin.php?page=getweb_new_menu" class="btn btn-color">Add New</a>
         </div>
       </div>
        <div class="panel-body">
              <form id="frmeditgetweb" class="form-horizontal" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                <input type="hidden" name="edit_menu" value="<?php echo isset($_GET['edit-id'])? intval($_GET['edit-id']): 0; ?>">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="name" class="col-sm-2">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" required name="name" id="name" placeholder="Enter Name" value="<?php echo $menu_by_id['name'] ; ?>">
                          <small class="text-danger form-control-msg">Please enter menu name</small>
                        </div>
                    </div>
                  <div class="form-group">
                    <label for="status" class="col-sm-2">Visibility</label>
                    <div class="col-sm-10">
                      <select name="status" id="status" class="form-control">
                        <option value="1" <?php if ($menu_by_id['status'] == 1):?> selected<?php endif; ?>>Visible</option>
                        <option value="0" <?php if ($menu_by_id['status'] == 0):?> selected<?php endif; ?>>Unvisible</option>
                      </select>
                      <small class="text-danger form-control-msg">Choose visibility</small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="extra_class" class="col-sm-2">Extra Class</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control input-sm" name="extra_class" id="extra_class" value="<?php echo $menu_by_id['extra_class'] ; ?>" placeholder="Enter Extra Class">
                    </div>
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-color">Update</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
</div>

