<div class="container-fluid mt-4 custom-table full-height">
  <!-- Search Form -->
  <div class="shadow mt-2 mb-4 p-4 rounded">
    <input type="checkbox" class="d-none" id="label-search">
    <label for="label-search" class="btn btn-danger border rounded-0 px-4"><?php echo _pll('Search'); ?></label>
    <form class="from-search mt-3">
      <input type="hidden" value="<?php echo LANGUAGE_CODE; ?>" name="lang">
      <div class="col from-search__fields text-md-right border border-dark p-3">
        <div class="from-search__title"><?php echo _pll('Search'); ?></div>
        <div class="row mt-3 ">
          <div class="col-xl-10 col-lg">
            <div class="row">
              <div class="col-xl-6 col-xl">
                <div class="form-group row ">
                  <label for="staticEmail" class="col-md-3 col-form-label"><?php echo _pll('Vol'); ?>:</label>
                  <div class="col-md-9 text-left">
                    <select class="form-control rounded-0 select2" name="vol_id[]" multiple>
                      <?php 
                      $select = isset($vol_id) ? $vol_id : array(); 
                      $all_select = isset($vol_id) && in_array('', $select) ? " selected" : "";
                      ?>
                      <option value=''<?php echo $all_select ?>><?php echo _pll('All'); ?></option>
                      <?php foreach ($vol as $value) { ?>
                        <?php $option_select = in_array($value['vol_number'], $select) ? " selected" : ""; ?>
                        <option value='<?php echo $value['vol_number'] ?>' <?php echo $option_select ?>><?php echo $value['vol_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-xl">
                <div class="form-group row ">
                  <label for="staticEmail" class="col-md-3 col-form-label"><?php echo _pll('Category'); ?>:</label>
                  <div class="col-md-9 text-left">
                    <select class="form-control rounded-0 select2" name="category_id">
                      <option value=''><?php echo _pll('All'); ?></option>
                      <?php foreach ($category as $value) { ?>
                        <option value='<?php echo $value['category_id'] ?>' <?php echo $category_id == $value['category_id'] ? " selected" : "" ?>><?php echo $value['category_name_' . LANGUAGE_CODE] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-xl">
                <div class="form-group row ">
                  <label for="staticEmail" class="col-md-3 col-form-label"><?php echo _pll('PDF Page'); ?>:</label>
                  <div class="col-md-9">
                    <input type="number" min="0" name="pdf_page" value="<?php echo $pdf_page; ?>" class="form-control rounded-0" />
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-xl">
                <div class="form-group row ">
                  <label for="staticEmail" class="col-md-3 col-form-label"><?php echo _pll('Book Page'); ?>:</label>
                  <div class="col-md-9">
                    <input type="number" min="0" name="book_page" value="<?php echo $book_page; ?>" class="form-control rounded-0" />
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-xl">
                <div class="form-group row ">
                  <label for="staticEmail" class="col-md-3 col-form-label"><?php echo _pll('Series/Industry'); ?>:</label>
                  <div class="col-md-9">
                    <input name="series_name" value="<?php echo $series_name; ?>" class="form-control rounded-0" />
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-xl">
                <div class="form-group row ">
                  <label for="staticEmail" class="col-md-3 col-form-label"><?php echo _pll('Contents'); ?>:</label>
                  <div class="col-md-9">
                    <input name="content" value="<?php echo $content; ?>" class="form-control rounded-0" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- d-flex align-items-baseline -->
          <div class="col-xl-2 col-lg-auto text-right text-xl-left">
            <button class=" btn btn-secondary border rounded-0 px-4"><?php echo _pll('Search'); ?></button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- End search -->
  <div class="card shadow mb-4">
    <div class="card-header p-0 custom-table">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2 class="m-0">BackNumber</h2>
          </div>
          <div class="col-sm-6">
            <?php if ($_SESSION["permission"] == 1) { ?>
              <a href="#addBnModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add</span></a>
              <a href="#deleteBnmtModal" data-href="/admin/backnumber/?action=deleteItems&arr=" class="btn btn-danger btn-deleteArr" data-toggle="modal"><i class="material-icons d-none d-sm-block">&#xE15C;</i> <span>Delete</span></a>
              <a href="#importModal" class="btn btn-secondary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Import</span></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <?php if ($backnumber_html) { ?>
          <table class="table table-bordered dataTable-checkbox" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="nosort text-center">
                  <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                  </span>
                </th>
                <th class="nosort text-center" width="40"><?php echo _pll('No'); ?></th>
                <th class="nosort text-center" width="40"><?php echo _pll('Vol'); ?></th>
                <th class="nosort text-center" width="130"><?php echo _pll('PDF Page'); ?></th>
                <th class="nosort text-center" width="100"><?php echo _pll('Book Page'); ?></th>
                <th class="nosort" width="100"><?php echo _pll('Category'); ?></th>
                <th class="nosort"><?php echo _pll('Series/Industry'); ?></th>
                <th class="nosort"><?php echo _pll('Contents'); ?></th>
                <th class="nosort" width="75"><?php echo _pll('Image'); ?></th>
                <th class="nosort text-center" width="40"><?php echo _pll('PDF'); ?></th>
                <?php if ($_SESSION["permission"] == 1) {
                  printf('<th class="nosort text-center">Actions</th>');
                } ?>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th></th>
                <th class="nosort text-center" width="40"><?php echo _pll('No'); ?></th>
                <th class="nosort text-center" width="40"><?php echo _pll('Vol'); ?></th>
                <th class="nosort text-center" width="130"><?php echo _pll('PDF Page'); ?></th>
                <th class="nosort text-center" width="100"><?php echo _pll('Book Page'); ?></th>
                <th class="nosort" width="100"><?php echo _pll('Category'); ?></th>
                <th class="nosort"><?php echo _pll('Series/Industry'); ?></th>
                <th class="nosort"><?php echo _pll('Contents'); ?></th>
                <th class="nosort" width="75"><?php echo _pll('Image'); ?></th>
                <th class="nosort text-center" width="40"><?php echo _pll('PDF'); ?></th>
                <?php if ($_SESSION["permission"] == 1) {
                  printf('<th class="text-center">Actions</th>');
                } ?>
              </tr>
            </tfoot>
            <tbody>
              <?php echo $backnumber_html; ?>
            </tbody>
          </table>
          <?php } else {
            printf('<p class="text-danger text-center mb-0" style="font-size: 1.5rem;">No data</p>');
          } ?>
        </div>
      </div>
    </div>

  </div>

  <?php include PATH_APPLICATION . '/mvc/view/blocks/modal-import.php' ?>

  <!-- Delete all Modal HTML -->
  <div id="deleteBnmtModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
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
    <div class="modal-dialog modal-dialog-centered">
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
  <div id="addBnModal" class="modal fade md-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form method="post" action="/admin/backnumber/?lang=<?php echo LANGUAGE_CODE ?>&action=add" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Add BackNumber</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-12 mb-0">
                <label>Image</label>
                <div class="w-100"></div>
                <input type="file" name="image" id="fileToUploadImage" accept="image/*">
              </div>
            </div>

            <hr class="w-100">

            <div class="row">
              <div class="form-group col-md-6">
                <label>Vol</label>
                <select class="form-control rounded-0 select2" name="vol_id">
                  <?php foreach ($vol as $value) { ?>
                    <option value='<?php echo $value['vol_number'] ?>'><?php echo $value['vol_name'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Category</label>
                <select class="form-control rounded-0 select2" name="category_id">
                  <?php foreach ($category as $value) { ?>
                    <option value='<?php echo $value['category_id'] ?>'><?php echo $value['category_name_' . LANGUAGE_CODE] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label>PDF page</label>
                <input type="number" class="form-control" name="pdf_page">
              </div>

              <div class="form-grou col-md-6">
                <label>Book page</label>
                <input type="number" class="form-control" name="book_page">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label>Series Name (vietnamese)</label>
                <input type="text" class="form-control" name="series_name_vi">
              </div>

              <div class="form-group col-md-6">
                <label>Series Name (japanses)</label>
                <input type="text" class="form-control" name="series_name_ja">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label>Content (vietnamese)</label>
                <textarea class="form-control" name="content_vi" rows="3"></textarea>
              </div>

              <div class="form-group col-md-6">
                <label>Content (japanses)</label>
                <textarea class="form-control" name="content_ja" rows="3"></textarea>
              </div>
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