<?php
global $wpdb;
$edit_id = isset( $_GET['edit-id'] ) ? intval( $_GET['edit-id'] ) : 0;
global $wpdb;
$field_by_id = get_fileds_id( $edit_id );
$get_menus   = get_menus( 2, '' );
?>
<div class="container-fluid mrt50">
  <div class="panel panel-border">
    <div class="clearfix panel-custom-color">
    <?php include 'message.php';?>
      <div class="panel-heading pull-left">Update Data</div>
      <div class="panel-heading pull-right">
        <a href="admin.php?page=getweb_option_fields" class="btn btn-color">Cancel</a>
        <a href="admin.php?page=getweb_new_field" class="btn btn-color">Add New</a>
      </div>

    </div>
    <div class="panel-body">
      <form id="frmeditgetwebfield" class="form-horizontal" action="#" method="post" data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        <input type="hidden" name="edit_field" value="<?php echo isset( $_GET['edit-id'] ) ? intval( $_GET['edit-id'] ) : 0; ?>">
        <div class="row">
          <div class="col-sm-9">
            <div class="panel panel-default">
              <div class="panel-heading">Publish</div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="title" class="col-sm-2">Title</label>
                  <div class="col-sm-10">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" value="<?php echo $field_by_id['title']; ?>">
                    <small class="text-danger form-control-msg">Please enter title!</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-2">Description</label>
                  <div class="col-sm-10">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter Description" value="<?php echo $field_by_id['description']; ?>">
                    <small class="text-danger form-control-msg">Please enter description!</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="get_id" class="col-sm-2">Id</label>
                  <div class="col-sm-10">
                    <input type="text" name="get_id" id="get_id" class="form-control" placeholder="Enter Get Data Id" value="<?php echo $field_by_id['get_id']; ?>">
                    <span class="nb_noted">Enter The ID for Get Data.Ex:top_header</span>
                    <small class="text-danger form-control-msg">Please enter id to get data!</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="default_value" class="col-sm-2">Default Value</label>
                  <div class="col-sm-10">
                    <input type="text" name="default_value" id="default_value" class="form-control" placeholder="Enter Default Value" value="<?php echo $field_by_id['default_value']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="field_type" class="col-sm-2">Type</label>
                  <div class="col-sm-10">
                    <select name="field_type" id="field_type" class="form-control" required>
                      <option value="">Select Type</option>
                      <option value="info" <?php if ( $field_by_id['type'] === "info" ): ?> selected<?php endif ?>>Info</option>
                      <option value="text" <?php if ( $field_by_id['type'] === "text" ): ?> selected<?php endif ?>>Text</option>
                      <option value="textarea" <?php if ( $field_by_id['type'] === "textarea" ): ?> selected<?php endif ?>>Textarea</option>
                      <option value="select" <?php if ( $field_by_id['type'] === "select" ): ?> selected<?php endif ?>>Select</option>
                      <option value="multi_select" <?php if ( $field_by_id['type'] === "multi_select" ): ?> selected<?php endif ?>>Multi Select</option>
                      <option value="select_sidebar" <?php if ( $field_by_id['type'] === "select_sidebar" ): ?> selected<?php endif ?>>Select Sidebar</option>
                      <option value="categories" <?php if ( $field_by_id['type'] === "categories" ): ?> selected<?php endif ?>>Categories</option>
                      <option value="custom_taxonomy" <?php if ( $field_by_id['type'] === "custom_taxonomy" ): ?> selected<?php endif ?>>Custom Taxonomy</option>
                      <option value="radio" <?php if ( $field_by_id['type'] === "radio" ): ?> selected<?php endif ?>>Radio</option>
                      <option value="checkbox" <?php if ( $field_by_id['type'] === "checkbox" ): ?> selected<?php endif ?>>Checkbox</option>
                      <option value="multicheck" <?php if ( $field_by_id['type'] === "multicheck" ): ?> selected<?php endif ?>>Multicheck</option>
                      <option value="color" <?php if ( $field_by_id['type'] === "color" ): ?> selected<?php endif ?>>Color</option>
                      <option value="select_google_font" <?php if ( $field_by_id['type'] === "select_google_font" ): ?> selected<?php endif ?>>Google Font</option>
                      <option value="typography" <?php if ( $field_by_id['type'] === "typography" ): ?> selected<?php endif ?>>Typography</option>
                      <option value="border" <?php if ( $field_by_id['type'] === "border" ): ?> selected<?php endif ?>>Border</option>
                      <option value="images" <?php if ( $field_by_id['type'] === "images" ): ?> selected<?php endif ?>>Images</option>
                      <option value="colorchooser" <?php if ( $field_by_id['name'] === "colorchooser" ): ?> selected<?php endif ?>>Color Chooser</option>
                      <option value="slider" <?php if ( $field_by_id['type'] === "slider" ): ?> selected<?php endif ?>>Slider</option>
                      <option value="upload" <?php if ( $field_by_id['type'] === "upload" ): ?> selected<?php endif ?>>upload</option>
                      <option value="media" <?php if ( $field_by_id['type'] === "media" ): ?> selected<?php endif ?>>Media</option>
                    </select>
                    <span class="nb_noted">Please select at least one type!</span>
                    <small class="text-danger form-control-msg">Please select at least one type!</small>
                  </div>
                </div>
				  <?php if ( isset( $field_by_id['more_values'] ) && ! empty( $field_by_id['more_values'] ) && $field_by_id['more_values'] != 'null' && $field_by_id['type'] == 'select' || $field_by_id['type'] == 'multi_select' || $field_by_id['type'] == 'radio' || $field_by_id['type'] == 'multicheck' ): ?>
                    <div class="form-group" id="select_options">
                      <label for="field_type" class="col-sm-2"></label>
                      <div class="col-sm-10">
                        <ol id="appear_filed">
							<?php
							$values = json_decode( $field_by_id['more_values'] );
							foreach ( $values as $key => $val ) {
								?>
                              <li>
                                <div class="option_field_more" style="margin-bottom:5px;">
                                  <input type="text" id="option_title" name="option_title[]" class="form-control" placeholder="Option Title" value="<?php echo $val->select_title ?>"/>
                                  <input type="text" id="option_value" name="option_value[]" class="form-control" placeholder="Option Value" value="<?php echo $val->select_value ?>" style="margin-top:5px;"/>
                                  <a href="javascript:void(0);" class="remove" style="color:#F00;font-weight:bold;">Remove</a>
                                </div>
                              </li>
							<?php } ?>
                        </ol>
                        <a href="javascript:void(0);" class="add_more btn btn-info" style="margin-left:25px;margin-bottom:5px;">Add More</a><br/>
                      </div>
                    </div>
				  <?php endif ?>
				  <?php if ( isset( $field_by_id['other'] ) && ! empty( $field_by_id['other'] ) ): ?>
                    <div class="form-group" id="custom_taxonomy">
                      <label for="custom_taxonomy_name" class="col-sm-2"></label>
                      <div class="col-sm-10">
                        <input type="text" name="custom_taxonomy_name" id="custom_taxonomy_name" class="form-control" placeholder="Enter Taxonomy Name" value="<?php echo $field_by_id['other']; ?>">
                      </div>
                    </div>
				  <?php endif ?>
				  <?php if ( isset( $field_by_id['info'] ) && ! empty( $field_by_id['info'] ) ): ?>
                    <div class="form-group" id="custom_info">
                      <label for="custom_information" class="col-sm-2"></label>
                      <div class="col-sm-10">
                        <textarea name="custom_information" id="custom_information" class="form-control" placeholder="Enter Introduction of Field Section"><?php echo $field_by_id['info']; ?></textarea>
                      </div>
                    </div>
				  <?php endif ?>
				  <?php if ( isset( $field_by_id['more_values'] ) && ! empty( $field_by_id['more_values'] ) && $field_by_id['type'] == 'images' && $field_by_id['more_values'] != 'null' ): ?>
                    <div class="form-group" id="select_images">
                      <label for="option_images" class="col-sm-2"></label>
                      <div class="col-sm-10">
                        <input type="button" id="option_images_button" value="Upload Image">
                        <span id="append_multiple_images">
                          <?php
                          $more_images = json_decode( $field_by_id['more_values'] );
                          foreach ( $more_images as $key => $option ): ?>
                            <div class="image_box">
                        <input type="hidden" name="option_images[]" value="<?php echo $option->image; ?>"/>
                        <img src="<?php echo $option->image; ?>" height="100px;"/><br>
                        <a title="Remove Image" onclick="jQuery(this).parent().remove();">Remove Image</a>
                        </div>
                          <?php endforeach ?>

                      </span>
                      </div>
                    </div>
				  <?php endif ?>
                <div class="form-group">
                  <label for="menu_id" class="col-sm-2">Choose Menu</label>
                  <div class="col-sm-10">
                    <select name="menu_id" id="menu_id" class="form-control" required>
						<?php if ( isset( $get_menus ) && count( $get_menus ) > 0 ): ?>
                          <option value="">Select Place</option>
							<?php foreach ( $get_menus as $menu ): ?>
                            <option value="<?php echo $menu->id; ?>" <?php if ( $field_by_id['menu_id'] === $menu->id ): ?> selected<?php endif ?>><?php echo $menu->name; ?></option>
							<?php endforeach ?>
						<?php else : ?>
                          <option value="">Creating Menu First</option>
						<?php endif ?>
                    </select>
                    <span class="nb_noted">Please select at least one where to display!</span>
                    <small class="text-danger form-control-msg">Please select at least one where to display!</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading" for="status">Visibility</div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-sm-10">
                    <select name="status" id="status" class="form-control" required>
                      <option value="1" <?php if ( $field_by_id['status'] == 1 ): ?> selected<?php endif ?>>Visible</option>
                      <option value="0" <?php if ( $field_by_id['status'] == 0 ): ?> selected<?php endif ?>>Unvisible</option>
                    </select>
                    <small class="text-danger form-control-msg">Please select visibility!</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" for="status">Extra Class</div>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-sm-10">
                    <input type="text" name="custom_class" id="custom_class" class="form-control" placeholder="Extra Class">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-right">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-color">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
