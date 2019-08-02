<div class="container-fluid full-height">
  <div class="card shadow mb-4 mt-4 custom-table">
    <div class="card-header p-0">
      <div class="table-title">
        <div class="row">
          <div class="col-md-4">
            <h2 class="m-0">Category</h2>
          </div>
          <div class="col-md-8">
            <?php if ($_SESSION["permission"] == 1) { ?>
              <a href="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>&action=add" class="btn btn-success"><i class="material-icons d-none d-sm-block">&#xE147;</i> <span>Add</span></a>
              <a href="#deleteVolModal" data-href="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>&action=deleteItems&arr=" class="btn btn-danger btn-deleteArr" data-toggle="modal"><i class="material-icons d-none d-sm-block">&#xE15C;</i> <span>Delete</span></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <?php if (is_array($data) && count($data) > 0) { ?>
          <table class="table table-bordered dataTable-checkbox" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="nosort text-center">
                  <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                  </span>
                </th>
                <th class="nosort" width="200">Name (vietnamese)</th>
                <th class="nosort" width="200">Name (japanses)</th>
                <th class="nosort">Description (vietnamese)</th>
                <th class="nosort">Description (japanses)</th>
                <?php if ($_SESSION["permission"] == 1) {
                  printf('<th class="nosort text-center">Action</th>');
                } ?>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th width="200">Name (vietnamese)</th>
                <th width="200">Name (japanses)</th>
                <th class="">Description (vietnamese)</th>
                <th class="">Description (japanses)</th>
                <?php if ($_SESSION["permission"] == 1) {
                  printf('<th class="text-center">Action</th>');
                } ?>

              </tr>
            </tfoot>
            <tbody>
              <?php $i = 0;
              foreach ($data as $value) { ?>
                <tr>
                  <td class="text-center">
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox<?php echo $i; ?>" name="category[]" value="<?php echo $value['category_id']; ?>">
                      <label for="checkbox<?php echo $i; ?>"></label>
                    </span>
                  </td>
                  <td>
                    <?php echo stripslashes($value['category_name_vi']); ?>
                  </td>
                  <td><?php echo stripslashes($value['category_name_ja']); ?></td>
                  <td>
                    <?php echo stripslashes($value['category_description_vi']); ?>
                  </td>
                  <td>
                    <?php echo stripslashes($value['category_description_ja']); ?>
                  </td>
                  <?php if ($_SESSION["permission"] == 1) { ?>
                    <td class="text-center">
                      <a href="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>&action=edit&id=<?php echo $value['category_id']; ?>" data-id="/category/?action=edit&id=<?php echo $value['category_id']; ?>" class="edit">
                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                      </a>
                      <a href="#deleteVolModal" data-href="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>&action=delete&id=<?php echo $value['category_id']; ?>" class="delete delete-item" data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                      </a>
                    </td>
                  <?php } ?>
                </tr>
                <?php $i++;
              } ?>
            </tbody>
          </table>
        <?php } else {
          printf('<p class="text-danger text-center mb-0" style="font-size: 1.5rem;">No data</p>');
        } ?>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteVolModal" class="modal fade wrap-delete-item">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Employee</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete these Records?</p>
        <p class="text-warning">
          <small>This action cannot be undone.</small>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-danger btn-delete">Delete</a>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteMultiVolModal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete Categories</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete these Records?</p>
        <p class="text-warning"><small>This action cannot be undone.</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="#" class="btn btn-danger btn-delete">Delete</a>
      </div>
    </div>
  </div>
</div>