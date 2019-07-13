<!-- Begin Page Content -->
<div class="container full-height" style="padding: 50px 15px">
    <h3 class="text-cetner">Add Category</h3>
    <div>
        <a class="btn btn-danger border mb-4" href="/admin/category">Back</a>
        <?php if(isset($error) && !empty($error)){ ?>
            <p class="text-danger mb-2"><?php echo $error; ?></p>
        <?php } ?>
    </div>
    <form method="POST" action="/admin/category/?action=add">
        <div id="accordion">
            <div class="card mb-4">
                <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Vietnamses
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name-vi" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required id="name-vi" name="name-vi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description-vi" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description-vi" id="description-vi" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-0" id="headingTwo">
                    <h5 class="mb-0">
                        <button type="button" class="btn btn-link collapsed p-3 w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Japanses
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name-ja" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="name-ja" id="name-ja">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description-ja" class="col-sm-2 col-form-label" name="name-ja">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description-ja" id="description-ja" rows="5"></textarea>
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