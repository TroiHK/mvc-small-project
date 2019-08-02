<?php if (!defined('PATH_SYSTEM')) die('Bad requested!'); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-xl-3 col-lg-5 mx-auto" style=" position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Sign In</h5>
          <form class="form-signin" method="POST" action="/admin/login/">
            <?php if (isset($error) && !empty($error)) { ?>
              <div class="text-danger" style="text-align:center;margin-bottom:10px;"><?php echo $error; ?></div>
            <?php } ?>
            <?php
            $status_forgort = isset($_GET['status']) && !empty($_GET['status']) ? $_GET['status'] : 0;
            ?>
            <?php if (!empty($status_forgort)) {
              $msg = ($status_forgort == 1) ? 'Password has been reset' : 'Email does not exist'; ?>
              <div class="text-success" style="text-align:center;margin-bottom:10px;"><?php echo $msg; ?></div>
            <?php } ?>

            <div class="form-label-group">
              <input type="text" id="inputUser" name="username" class="form-control" placeholder="UserName" required autofocus>
              <label for="inputUser">User name</label>
            </div>

            <div class="form-label-group">
              <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
              <label for="inputPassword">Password</label>
            </div>
            <a href="#addForgotPasswordModal" class="mb-3 d-block text-right" data-toggle="modal">Forgot password</a>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="addForgotPasswordModal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="/admin/login/?action=forgot_password">
        <div class="modal-header">
          <h4 class="modal-title">Forgot Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="user-email" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-success" value="Send">
        </div>
      </form>
    </div>
  </div>
</div>