<?php if ( ! defined('PATH_SYSTEM')) die ('Bad requested!'); ?>
<!-- Begin Page Content -->
<div class="container-fluid full-height">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4 custom-table">
        <div class="card-header p-0">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="m-0">Vol</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addVolModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Vol</span></a>
                        <a href="#deleteMultiVolModal" data-href="/admin/vol/?action=deleteItems&arr=" class="btn btn-danger btn-deleteArr" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <?php if ( is_array($data) && count($data) > 0 ) { ?>
                    <table class="table table-bordered dataTable-checkbox" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="nosort text-center">
                              <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                              </span>
                            </th>
                            <th class="nosort text-center" width="80">Image</th>
                            <th class="nosort">Name</th>
                            <th class="nosort">PDF file</th>
                            <th class="nosort text-center">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th class="text-center">Image</th>
                            <th>Name</th>
                            <th>PDF file</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php $i = 0; foreach ($data as $value) { ?>
                            <tr>
                                <td class="text-center">
                    <span class="custom-checkbox">
                      <input type="checkbox" id="checkbox<?php echo $i; ?>" name="vol[]" value="<?php echo $value['vol_id']; ?>">
                      <label for="checkbox<?php echo $i; ?>"></label>
                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if ( $value['vol_image'] ) { ?>
                                        <img src="/<?php echo $value['vol_image']; ?>" alt="<?php echo $value['vol_name']; ?>" width="75">
                                    <?php } ?>
                                </td>
                                <td><?php echo $value['vol_name']; ?></td>
                                <?php $pdf_name = explode("/", $value['vol_pdf']); ?>
                                <td>
                                    <?php if ( $pdf_name ) { ?>
                                        <a href="/<?php echo $value['vol_pdf']; ?>" target="_blank" title=""><?= $pdf_name[count($pdf_name) - 1] ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a href="/admin/vol/?action=edit&id=<?php echo $value['vol_id']; ?>"
                                       class="edit edit-item">
                                        <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                    </a>
                                    <a href="#deleteVolModal"
                                       data-href="/admin/vol/?action=delete&id=<?php echo $value['vol_id']; ?>"
                                       class="delete delete-item" data-toggle="modal">
                                        <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Add Modal HTML -->
<div id="addVolModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/admin/vol/?action=add" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Add Vol</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Vol Number</label>
                        <input type="number" class="form-control" name="number" required>
                    </div>
                    <div class="form-group">
                        <label>Vol Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" id="fileToUploadImage" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <label>PDF file</label>
                        <input type="file" name="pdf" accept=".pdf" id="fileToUploadPdf">
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

<!-- Delete Modal HTML -->
<div id="deleteVolModal" class="modal fade wrap-delete-item">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Vol</h4>
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

<!-- Delete Modal HTML -->
<div id="deleteMultiVolModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Multi-Vol</h4>
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