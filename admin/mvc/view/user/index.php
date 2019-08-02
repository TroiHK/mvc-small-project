<div class="container-fluid full-height">
  <div class="card shadow mb-4 mt-4 custom-table">
    <div class="card-header p-0">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2 class="m-0">User</h2>
          </div>
          <div class="col-sm-6">
            <a href="/admin/user/?action=add" class="btn btn-success"><i class="material-icons d-none d-sm-block">&#xE147;</i> <span>Add</span></a>
            <a href="#deleteUserModal" data-href="/admin/user/?action=deleteItems&arr=" class="btn btn-danger btn-deleteArr" data-toggle="modal"><i class="material-icons d-none d-sm-block">&#xE15C;</i> <span>Delete</span></a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <?php if (is_array($data) && count($data) > 0) {  ?>
          <table class="table table-bordered dataTable-checkbox" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="nosort text-center">
                  <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                  </span>
                </th>
                <th class="nosort" width="100">Name</th>
                <th class="d-none d-xl-table-cell" width="200">Full name</th>
                <th class="nosort" width="200">Email</th>
                <th class="nosort d-none d-xl-table-cell">Address</th>
                <th width="100" class="nosort">Permission</th>
                <th class="nosort text-center">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th width="100">Name</th>
                <th class="d-none d-xl-table-cell" width="200">Full name</th>
                <th width="200">Email</th>
                <th class="d-none d-xl-table-cell">Address</th>
                <th width="100">Permission</th>
                <th class="text-center">Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $i = 0;
              foreach ($data as $value) { ?>
                <tr>
                  <td class="text-center">
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox<?php echo $i; ?>" name="user[]" value="<?php echo $value['user_id']; ?>">
                      <label for="checkbox<?php echo $i; ?>"></label>
                    </span>
                  </td>
                  <td>
                    <?php echo $value['user_name']; ?>
                  </td>
                  <td class="d-none d-xl-table-cell">
                    <?php echo $value['user_fullname']; ?>
                  </td>
                  <td><?php echo $value['user_email']; ?></td>
                  <td class="d-none d-xl-table-cell">
                    <?php echo $value['user_address']; ?>
                  </td>
                  <td>
                    <?php echo $value['user_permission'] == 0 ? 'User' : 'Admin'; ?>
                  </td>
                  <td class="text-center">
                    <a href="/admin/user/?action=edit&id=<?php echo $value['user_id']; ?>" data-id="/admin/user/?action=edit&id=<?php echo $value['user_id']; ?>" class="edit">
                      <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                    </a>
                    <a href="#deleteUserModal" data-href="/admin/user/?action=delete&id=<?php echo $value['user_id']; ?>" class="delete delete-item" data-toggle="modal">
                      <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                    </a>
                  </td>
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
<div id="deleteUserModal" class="modal fade wrap-delete-item">
  <div class="modal-dialog">
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
<div id="deleteMultiUserModal" class="modal fade">
  <div class="modal-dialog">
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