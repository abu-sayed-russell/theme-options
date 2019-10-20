<div class="container mrt50">
  <div class="panel panel-border">
    <div class="clearfix panel-custom-color">
	    <?php include 'message.php';?>
      <div class="panel-heading pull-left">Add New</div>
      <div class="panel-heading pull-right"><a href="admin.php?page=getweb_option_menus" class="btn btn-color">Back</a></div>
    </div>
    <div class="panel-body">
      <form id="frmgetweb" class="form-horizontal" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
        <div class="col-sm-9">
          <div class="form-group">
            <label for="name" class="col-sm-2">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control input-sm" name="name" id="name" placeholder="Enter Name">
              <small class="text-danger form-control-msg">Please enter menu name</small>
            </div>
          </div>
          <div class="form-group">
            <label for="parent" class="col-sm-2">Parent of</label>
            <div class="col-sm-10">
              <select name="parent" id="parent" class="form-control">
		          <?php $get_menus = get_menus( 1,0 ); ?>
		          <?php if ( isset( $get_menus ) && count( $get_menus ) > 0 ): ?>
                    <option value="0">Parent</option>
			          <?php foreach ( $get_menus as $menu ): ?>
                      <option value="<?php echo $menu->id; ?>"><?php echo $menu->name; ?></option>
			          <?php endforeach ?>
		          <?php else : ?>
                    <option value="">Creating Menu First</option>
		          <?php endif ?>
              </select>
              <small class="text-danger form-control-msg">Choose visibility</small>
            </div>
          </div>
          <div class="form-group">
            <label for="status" class="col-sm-2">Visibility</label>
            <div class="col-sm-10">
              <select name="status" id="status" class="form-control">
                <option value="1">Visible</option>
                <option value="0">Unvisible</option>
              </select>
              <small class="text-danger form-control-msg">Choose visibility</small>
            </div>
          </div>
          <div class="form-group">
            <label for="extra_class" class="col-sm-2">Icon</label>
            <div class="col-sm-10">
                <input type="text" class="icon-class-input" name="menu_icon" value="fa fa-th" />
                <button type="button" class="picker-button">Pick an Icon</button>
                <span class="menu-icon"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="extra_class" class="col-sm-2">Extra Class</label>
            <div class="col-sm-10">
              <input type="text" class="form-control input-sm" name="extra_class" id="extra_class" placeholder="Enter Extra Class">
            </div>
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-color">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include 'icon_picker.php';?>