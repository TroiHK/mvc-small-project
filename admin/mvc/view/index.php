<div class="container-fluid pt-3 full-height">

    <!-- Search Form -->
    <div class="shadow my-4 p-4 rounded">
        <form class="from-search d-md-flex">
            <input type="hidden" value="<?php echo LANGUAGE_CODE; ?>" name="lang">
            <div class="col from-search__fields text-right border border-dark p-3">
                <div class="from-search__title">Search</div>
                <div class="row mt-3">
                    <div class="col-md-5 col-lg">
                        <div class="form-group row ">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Vol:</label>
                            <div class="col-sm-9">
                                <select class="form-control rounded-0" name="vol_id">
                                    <option value=''>All</option>
                                    <?php foreach ($vol as $value) { ?>
                                        <option value='<?php echo $value['vol_number'] ?>'<?php echo $vol_id == $value['vol_number'] ? " selected" : "" ?>><?php echo $value['vol_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Pdf Page:</label>
                            <div class="col-sm-9">
                                <input type="number" name="pdf_page" value="<?php echo $pdf_page; ?>" class="form-control rounded-0" />
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Book Page:</label>
                            <div class="col-sm-9">
                                <input type="number" name="book_page" value="<?php echo $book_page; ?>" class="form-control rounded-0" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg">
                        <div class="form-group row ">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Category:</label>
                            <div class="col-sm-9">
                                <select class="form-control rounded-0" name="category_id">
                                    <option value=''>All</option>
                                    <?php foreach ($category as $value) { ?>
                                        <option value='<?php echo $value['category_id'] ?>'<?php echo $category_id == $value['category_id'] ? " selected" : "" ?>><?php echo $value['category_name_' . LANGUAGE_CODE] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Contents:</label>
                            <div class="col-sm-9">
                                <input name="content" value="<?php echo $content; ?>" class="form-control rounded-0" />
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Series name:</label>
                            <div class="col-sm-9">
                                <input name="series_name" value="<?php echo $series_name; ?>" class="form-control rounded-0" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-auto text-left">
                        <button class="btn btn-secondary border rounded-0 px-4">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 custom-table">
        <div class="card-header p-0">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="m-0">BackNumber</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#importModal" class="btn btn-secondary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Import</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if (is_array($backnumber) && count($backnumber) > 0) { ?>
                    <table class="table table-bordered dataTable-checkbox" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="nosort text-center" width="80">No</th>
                            <th class="nosort text-center" width="80">Vol</th>
                            <th class="nosort text-center" width="80">PDF Page</th>
                            <th class="nosort text-center" width="80">Book Page</th>
                            <th class="nosort">Category</th>
                            <th class="nosort">Series</th>
                            <th class="nosort">Contents</th>
                            <th class="nosort text-center">PDF</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th class="nosort text-center" width="80">No</th>
                            <th class="nosort text-center" width="80">Vol</th>
                            <th class="nosort text-center" width="80">PDF Page</th>
                            <th class="nosort text-center" width="80">Book Page</th>
                            <th class="nosort">Category</th>
                            <th class="nosort">Series</th>
                            <th class="nosort">Contents</th>
                            <th class="nosort text-center">PDF</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $i = 1;
                        foreach ($backnumber as $value) { ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $i; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $value['backnumber_vol_id']; ?>
                                </td>
                                <td class="text-center">
                                    <?php $arrPdfPage = explode(',', $value['group_pdf_page']);
                                    if (count($arrPdfPage) > 1) {
                                        $value['group_pdf_page'] = $arrPdfPage[0] . '~' . $arrPdfPage[count($arrPdfPage) - 1];
                                    }  ?>
                                    <?php echo $value['group_pdf_page']; ?>
                                </td>
                                <td class="text-center">
                                    <?php $arrBookPage = explode(',', $value['group_book_page']);
                                    if (count($arrBookPage) > 1) {
                                        $value['group_book_page'] = $arrBookPage[0] . '~' . $arrBookPage[count($arrBookPage) - 1];
                                    }  ?>
                                    <?php echo $value['group_book_page']; ?>
                                </td>
                                <td>
                                    <?php echo $category[$value['backnumber_category_id']]['category_name_' . LANGUAGE_CODE]; ?>
                                </td>
                                <td>
                                    <?php echo $value['backnumber_series_name_' . LANGUAGE_CODE]; ?>
                                </td>
                                <td>
                                    <?php echo $value['backnumber_content_' . LANGUAGE_CODE]; ?>
                                </td>
                                <td class="text-center">
                                    <a href="/<?php echo $vol[$value['backnumber_vol_id']]['vol_pdf']; ?>#page=<?php echo $value['backnumber_pdf_page']; ?>" target="_blank" title="">
                                        <i class="material-icons text-danger" data-toggle="tooltip" title="Show" style="font-size: 30px;">pageview</i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                        </tbody>
                    </table>
                <?php }else{
                    printf('<p class="text-danger text-center mb-0" style="font-size: 1.5rem;">No data</p>');
                } ?>
            </div>
        </div>
    </div>

</div>

<!-- Add Modal HTML -->
<div id="importModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/admin/?action=import" name="uploadCSV" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Import BackNumber</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose XLS File</label>
                        <input type="file" name="file" id="file" accept=".xls" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Import">
                </div>
            </form>
        </div>
    </div>
</div>