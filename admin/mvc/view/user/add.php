<!-- Begin Page Content -->
<div class="container full-height" style="padding: 50px 15px">
  <h3 class="text-cetner">Add User</h3>
  <div>
    <a class="btn btn-danger border mb-4" href="/admin/user">Back</a>
    <?php if (isset($error) && !empty($error)) { ?>
      <p class="text-danger mb-2"><?php echo $error; ?></p>
    <?php } ?>
  </div>
  <form method="POST" action="/admin/user/?action=add">
    <div id="accordion">
      <div class="card mb-4 pt-2">
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
          <div class="card-body">
            <div class="form-group row">
              <label for="user_name" class="col-sm-2 col-form-label">User Name</label>
              <div class="col-sm-10"><input class="form-control" id="user_name" name="user_name" required /></div>
            </div>
            <div class="form-group row">
              <label for="user_fullname" class="col-sm-2 col-form-label">Full name</label>
              <div class="col-sm-10"><input class="form-control" id="user_fullname" name="user_fullname" required /></div>
            </div>
            <div class="form-group row">
              <label for="user_email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" id="user_email" class="form-control" name="user_email" required />
              </div>
            </div>
            <div class="form-group row">
              <label for="user_address" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10"><input class="form-control" id="user_address" name="user_address" /></div>
            </div>
            <div class="form-group row">
              <label for="user_tel" class="col-sm-2 col-form-label">Tel</label>
              <div class="col-sm-10"><input class="form-control" id="user_tel" name="user_tel" /></div>
            </div>
            <div class="form-group row">
              <label for="user_password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10"><input type="password" required class="form-control" name="user_password" /></div>
            </div>
            <div class="form-group row">
              <label for="content_vi" class="col-sm-2 col-form-label">Permission</label>
              <div class="col-sm-10">
                <div class="chiller_cb">
                  <input name="user_permission" value="1" id="chkAmin" type="checkbox">
                  <label for="chkAmin">Admin</label>
                  <span></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button class="btn btn-primary border mt-4 float-right">Add</button>
  </form>
</div>
<!-- /.container-fluid -->