<div id="importModal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="/admin/?lang=<?php echo LANGUAGE_CODE ?>&action=import" name="uploadCSV" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Import BackNumber</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Choose XLSX File</label>
            <input type="file" name="file" id="file" accept=".xlsx" required>
          </div>
          <div class="form-group">
            <label>Update Images</label>
            <input type="checkbox" name="update_img">
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