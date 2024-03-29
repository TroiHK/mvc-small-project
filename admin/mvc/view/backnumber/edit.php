<!-- Begin Page Content -->
<div class="container full-height" style="padding: 50px 15px">
    <h3 class="text-cetner">Edit BackNumber</h3>
    <div>
        <a class="btn btn-danger border mb-4" href="/admin/backnumber/?lang=<?php echo LANGUAGE_CODE ?>">Back</a>
        <?php if(isset($error) && !empty($error)){ ?>
            <p class="text-danger mb-2"><?php echo $error; ?></p>
        <?php } ?>
    </div>
    <form method="post" action="/admin/backnumber/?lang=<?php echo LANGUAGE_CODE ?>&action=edit&id=<?php echo $backnumber['backnumber_id']; ?>" enctype="multipart/form-data">
        <div id="accordion">
            <div class="card mb-4 pt-2">
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="vol_id" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <?php if ( isset($backnumber['backnumber_image']) ) { ?>
                                    <img src="/<?php echo $backnumber['backnumber_image']; ?>" id="src_backnumber_image" alt="<?php echo $backnumber['backnumber_image']; ?>" width="200">
                                    <div class="w-100 mb-3"></div>
                                <?php } ?>
                                <input type="file" name="image" id="fileToUploadImage" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vol_id" class="col-sm-2 col-form-label">Vol</label>
                            <div class="col-sm-10">
                                <select class="form-control rounded-0 select2" name="vol_id">
                                    <?php foreach ($vol as $value) { ?>
                                        <option value='<?php echo $value['vol_number'] ?>'<?php echo $value['vol_number'] == $backnumber['backnumber_vol_id'] ? ' selected' : ''; ?>><?php echo $value['vol_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pdf_page" class="col-sm-2 col-form-label">PDF page</label>
                            <div class="col-sm-10">
                                <input type="number" value="<?php echo $backnumber['backnumber_pdf_page'] ?>" class="form-control" name="pdf_page">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="book_page" class="col-sm-2 col-form-label">Book page</label>
                            <div class="col-sm-10">
                                <input type="number" value="<?php echo $backnumber['backnumber_book_page'] ?>" class="form-control" name="book_page">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control rounded-0 select2" name="category_id">
                                    <?php foreach ($category as $value) { ?>
                                        <option value='<?php echo $value['category_id'] ?>'<?php echo $value['category_id'] == $backnumber['backnumber_category_id'] ? ' selected' : ''; ?>><?php echo $value['category_name_'.LANGUAGE_CODE] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header p-0" id="headingTwo">
                    <h5 class="mb-0">
                        <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        Vietnamese
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="series_name_vi" class="col-sm-2 col-form-label">Series Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $backnumber['backnumber_series_name_vi'] ?>" class="form-control" name="series_name_vi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content_vi" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content_vi" rows="4"><?php echo $backnumber['backnumber_content_vi'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header p-0" id="headingThree">
                    <h5 class="mb-0">
                        <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Japanses
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="series_name_ja" class="col-sm-2 col-form-label">Series Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $backnumber['backnumber_series_name_ja'] ?>" class="form-control" name="series_name_ja">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content_ja" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content_ja" rows="4"><?php echo $backnumber['backnumber_content_ja'] ?></textarea>
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