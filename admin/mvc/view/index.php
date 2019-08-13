<div class="container-fluid pt-3 full-height">
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

  <!-- DataTales Example -->
  <div class="card shadow mb-4 custom-table">
    <div class="card-header p-0">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-6">
            <h2 class="m-0">BackNumber</h2>
          </div>
          <div class="col-sm-6">
            <?php if ($_SESSION["permission"] == 1) {
              print('<a href="#importModal" class="btn btn-secondary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Import</span></a>');
            } ?>
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
                <th class="nosort text-center not-first-child" width="40">No</th>
                <th class="nosort text-center" width="40"><?php echo _pll('Vol') ?></th>
                <th class="nosort text-center" width="130"><?php echo _pll('PDF Page') ?></th>
                <th class="nosort text-center" width="100"><?php echo _pll('Book Page'); ?></th>
                <th class="nosort" width="100"><?php echo _pll('Category'); ?></th>
                <th class="nosort"><?php echo _pll('Series/Industry'); ?></th>
                <th class="nosort"><?php echo _pll('Contents'); ?></th>
                <th class="nosort text-center" width="75"><?php echo _pll('Image'); ?></th>
                <!-- <th class="nosort text-center not-last-child" width="40"><?php //echo _pll('PDF'); ?></th> -->
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="nosort text-center not-first-child" width="40">No</th>
                <th class="nosort text-center" width="40"><?php echo _pll('Vol') ?></th>
                <th class="nosort text-center" width="130"><?php echo _pll('PDF Page') ?></th>
                <th class="nosort text-center" width="100"><?php echo _pll('Book Page'); ?></th>
                <th class="nosort" width="100"><?php echo _pll('Category'); ?></th>
                <th class="nosort"><?php echo _pll('Series/Industry'); ?></th>
                <th class="nosort"><?php echo _pll('Contents'); ?></th>
                <th class="nosort text-center" width="75"><?php echo _pll('Image'); ?></th>
                <!-- <th class="nosort text-center not-last-child" width="40"><?php //echo _pll('PDF'); ?></th> -->
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

<?php include 'blocks/modal-import.php' ?>

<!-- Show PDF Modal HTML -->
<div id="showPdfModal" class="modal fade md-modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">          
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body loadding text-center">
      </div>
      <div class="modal-footer d-block">
      </div>
    </div>
  </div>
</div>