<!-- Begin Page Content -->
<div class="container full-height" style="padding: 50px 15px">
    <h3 class="text-cetner">Edit Category</h3>
    <div>
        <a class="btn btn-danger border mb-4" href="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>">Back</a>
        <?php if (isset($error) && !empty($error)) { ?>
            <p class="text-danger mb-2"><?php echo $error; ?></p>
        <?php } ?>
    </div>
    <form method="POST" action="/admin/category/?lang=<?php echo LANGUAGE_CODE ?>&action=edit&id=<?php echo $data['category_id']; ?>">
        <div id="accordion">
            <div class="card mb-4">
                <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Vietnamese
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name-vi" class="col-sm-4 col-lg-2 col-form-label">Name</label>
                            <div class="col-lg-10 col-sm-8">
                                <input type="text" class="form-control" value="<?php echo $data['category_name_vi']; ?>" required id="name-vi" name="name-vi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description-vi" class="col-sm-4 col-lg-2 col-form-label">Description</label>
                            <div class="col-lg-10 col-sm-8">
                                <textarea class="form-control" name="description-vi" id="description-vi" rows="5"><?php echo $data['category_description_vi']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header p-0" id="headingTwo">
                    <h5 class="mb-0">
                        <button type="button" class="btn collapsed p-3 w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Japanses
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name-ja" class="col-sm-4 col-lg-2 col-form-label">Name</label>
                            <div class="col-lg-10 col-sm-8">
                                <input type="text" class="form-control" value="<?php echo $data['category_name_ja']; ?>" required name="name-ja" id="name-ja">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description-ja" class="col-sm-4 col-lg-2 col-form-label" name="name-ja">Description</label>
                            <div class="col-lg-10 col-sm-8">
                                <textarea class="form-control" name="description-ja" id="description-ja" rows="5"><?php echo $data['category_description_ja']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary border mt-4 float-right">Update</button>
    </form>
</div>
<!-- /.container-fluid -->