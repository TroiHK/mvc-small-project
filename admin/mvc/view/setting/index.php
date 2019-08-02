<!-- Begin Page Content -->
<div class="container-fluid full-height">
  <!-- DataTales Example -->
  <div class="card shadow mb-4 mt-4 custom-table">
    <div class="card-header p-0">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2 class="m-0">Setting</h2>
          </div>

        </div>
      </div>
    </div>
    <div class="card-body">
      <?php
      if ((isset($data['status']) && !empty($data['status'])) || (isset($_GET['status']) && !empty($_GET['status']))) {
        if ($_GET['status'] == 1) {
          printf('<p class="text-success mb-2">Update Success</p>');
        } else {
          if ($data['status'] != 1) {
            printf('<p class="text-danger mb-2">Update Failed</p>');
          }
        }
      }
      ?>
      <form method="POST">
        <div class="row">
          <div class="col-md-6 col-xl-4">
            <div class="form-group row">
              <label for="name-vi" class="col-xl-4 col-sm-4 col-form-label">Language</label>
              <div class="col-xl-8 col-sm-8">
                <select class="form-control" name="setting[default_language]">
                  <option <?php echo $data['user_setting']['default_language'] == 'vi' ? 'selected="selected"' : '' ?> value="vi">Vietnamese</option>
                  <option <?php echo $data['user_setting']['default_language'] == 'ja' ? 'selected="selected"' : '' ?> value="ja">Japanese</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-4">
            <div class="form-group row">
              <label for="name-vi" class="col-xl-4 col-sm-4 col-form-label text-md-right">Row</label>
              <div class="col-xl-8 col-sm-8">
                <select class="form-control text-capitalize" name="setting[row]">
                  <?php
                  $arrRow = array(10, 25, 50, 100);
                  foreach ($arrRow as $value) {
                    printf('<option %2$s value="%1$d">%1$d</option>', $value, $data['user_setting']['row'] == $value ? 'selected="selected"' : '');
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <button class="btn btn-primary border float-right">Update</button>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->