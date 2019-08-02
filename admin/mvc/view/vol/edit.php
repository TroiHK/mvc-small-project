<!-- Begin Page Content -->
<div class="container full-height" style="padding: 50px 15px">
    <h3 class="text-cetner">Edit Vol</h3>
    <div>
        <a class="btn btn-danger border mb-4" href="/admin/vol/?php echo LANGUAGE_CODE; ?>">Back</a>
        <?php if(isset($error) && !empty($error)){ ?>
            <p class="text-danger mb-2"><?php echo $error; ?></p>
        <?php } ?>
    </div>
    <form method="post" action="/admin/vol/?lang=<?php echo LANGUAGE_CODE ?>&action=edit&id=<?php echo $data['vol_id']; ?>" enctype="multipart/form-data">
        <div id="accordion">
            <div class="card mb-4 pt-2">
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="vol_number" class="col-sm-4 col-lg-2 col-form-label">Vol Number</label>
                            <div class="col-sm-8 col-lg-10">
                                <input type="text" class="form-control" value="<?php echo $data['vol_number']; ?>" required id="vol_number" name="vol_number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vol_name" class="col-sm-4 col-lg-2 col-form-label">Vol Name</label>
                            <div class="col-sm-8 col-lg-10">
                                <input type="text" class="form-control" value="<?php echo $data['vol_name']; ?>" required id="name-vi" name="vol_name">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="vol_image" class="col-sm-4 col-lg-2 col-form-label">Vol image</label>
                            <div class="col-sm-8 col-lg-10">
                                <?php if ( $data['vol_image'] ) { ?>
                                    <img src="/<?php echo $data['vol_image']; ?>" id="src_vol_image" alt="<?php echo $data['vol_name']; ?>" width="200">
                                    <div class="w-100 mb-3"></div>
                                <?php } ?>
                                <input type="file" name="vol_image" id="vol_image" class="mw-100" accept="image/*">
                            </div>
                        </div>
                        <hr>
                        <div id="bigUpload" class="form-group row">
                            <label for="vol_pdf" class="col-sm-4 col-lg-2 col-form-label">Vol Pdf</label>
                            <div class="col-sm-8 col-lg-10">
                                <?php $pdf_name = explode("/", $data['vol_pdf']); ?>
                                <?php if ($pdf_name) { ?>
                                    <a href="/<?php echo $data['vol_pdf']; ?>" target="_blank" title=""><?= $pdf_name[count($pdf_name) - 1] ?></a>
                                    <div class="w-100 mb-3"></div>
                                <?php } ?>
                                <input type="file" class="mw-100" accept=".pdf" id="file">
                                <input type="hidden" id="fileUpload" name="vol_pdf">
                            </div>

                            <div class="col-sm-12 mt-3">
                                <div id="progressBarContainer">
                                    <div id="progressBarFilled">
                                    </div>
                                    <div id="timeRemaining"></div>
                                </div>
                                <div id="uploadResponse"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary border mt-4 float-right btn-summit-upload" onclick="upload(this)">Update</button>
    </form>
</div>
<!-- /.container-fluid -->