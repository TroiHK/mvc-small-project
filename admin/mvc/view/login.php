<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-xl-3 col-lg-5 mx-auto" style=" position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-signin" method="POST" action="">
                        <?php if ( $error ) { ?>
                            <div style="text-align:center;color:red;margin-bottom:10px;"><?php echo $error; ?></div>
                        <?php } ?>

                        <div class="form-label-group">
                            <input type="text" id="inputUser" name="Username" class="form-control" placeholder="UserName" required autofocus>
                            <label for="inputUser">User name</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="Password" class="form-control" placeholder="Password" required>
                            <label for="inputPassword">Password</label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>