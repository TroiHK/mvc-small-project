<div class="container-fluid mt-4 custom-table full-height">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header p-0 custom-table">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="m-0">BackNumber</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addBnModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New BackNumber</span></a>
                        <a href="#deleteBnmtModal" data-href="/admin/backnumber/?action=deleteItems&arr=" class="btn btn-danger btn-deleteArr" data-toggle="modal"><i class="material-icons d-none d-sm-block">&#xE15C;</i> <span>Delete</span></a>
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
                            <th class="nosort text-center">
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th class="nosort text-center" width="80">No</th>
                            <th class="nosort text-center" width="80">Vol</th>
                            <th class="nosort text-center" width="80">PDF Page</th>
                            <th class="nosort text-center" width="80">Book Page</th>
                            <th class="nosort">Category</th>
                            <th class="nosort">Series</th>
                            <th class="nosort">Contents</th>
                            <th class="nosort text-center">PDF</th>
                            <th class="nosort text-center">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th class="nosort text-center" width="80">No</th>
                            <th class="nosort text-center" width="80">Vol</th>
                            <th class="nosort text-center" width="80">PDF Page</th>
                            <th class="nosort text-center" width="80">Book Page</th>
                            <th class="nosort">Category</th>
                            <th class="nosort">Series</th>
                            <th class="nosort">Contents</th>
                            <th class="nosort text-center">PDF</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $i = 1;
                        foreach ($backnumber as $value) { ?>
                            <tr>
                                <td class="text-center">
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox<?php echo $i; ?>" name="backnumber[]"
                                            value="<?php echo $value['backnumber_id']; ?>">
                                        <label for="checkbox<?php echo $i; ?>"></label>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php echo $i; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $value['backnumber_vol_id']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $value['backnumber_pdf_page']; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $value['backnumber_book_page']; ?>
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
                                <td class="text-center">
                                    <a href="/admin/backnumber/?action=edit&id=<?php echo $value['backnumber_id']; ?>"
                                       class="edit edit-item">
                                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>
                                    <a href="#deleteBnModal"
                                       data-href="/admin/backnumber/?action=delete&id=<?php echo $value['backnumber_id']; ?>"
                                       class="delete delete-item" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                        </tbody>
                    </table>
                <?php } ?>
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

<!-- Delete Modal HTML -->
<div id="deleteBnmtModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete BackNumbers</h4>
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

<!-- Delete Modal HTML -->
<div id="deleteBnModal" class="modal fade wrap-delete-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete BackNumber</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Record?</p>
                <p class="text-warning"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-delete">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal HTML -->
<div id="addBnModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/admin/backnumber/?action=add" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Add BackNumber</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Vol</label>
                        <select class="form-control rounded-0" name="vol_id">
                            <?php foreach ($vol as $value) { ?>
                                <option value='<?php echo $value['vol_number'] ?>'><?php echo $value['vol_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>PDF page</label>
                        <input type="number" class="form-control" name="pdf_page">
                    </div>
                    <div class="form-group">
                        <label>Book page</label>
                        <input type="number" class="form-control" name="book_page">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control rounded-0" name="category_id">
                            <?php foreach ($category as $value) { ?>
                                <option value='<?php echo $value['category_id'] ?>'><?php echo $value['category_name_'.LANGUAGE_CODE] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Series Name (vietnamses)</label>
                        <input type="text" class="form-control" name="series_name_vi">
                    </div>
                    <div class="form-group">
                        <label>Series Name (japanses)</label>
                        <input type="text" class="form-control" name="series_name_ja">
                    </div>
                    <div class="form-group">
                        <label>Content (vietnamses)</label>
                        <textarea class="form-control" name="content_vi" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Content (japanses)</label>
                        <textarea class="form-control" name="content_ja" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Add">
                </div>
            </form>
        </div>
    </div>
</div>