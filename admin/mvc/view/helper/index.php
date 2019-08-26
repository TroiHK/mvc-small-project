<div class="container-fluid pt-4 full-height">
  <script src="/assets/vendor/pdfjs/js/pdf.js"></script>
  <script src="/assets/vendor/pdfjs/js/pdf.worker.js"></script>
  <style type="text/css">
    #upload-button {
      width: 150px;
      display: block;
      margin: 20px auto;
    }

    #file-to-upload {
      display: none;
    }

    #pdf-main-container {
      width: 400px;
      margin: 20px auto;
    }

    #pdf-loader {
      display: none;
      text-align: center;
      color: #999999;
      font-size: 13px;
      line-height: 100px;
      height: 100px;
    }

    #pdf-contents {
      display: none;
    }

    #pdf-meta {
      overflow: hidden;
      margin: 0 0 20px 0;
    }

    #pdf-buttons {
      float: left;
    }

    #page-count-container {
      float: right;
    }

    #pdf-current-page {
      display: inline;
    }

    #pdf-total-pages {
      display: inline;
    }

    #pdf-canvas {
      border: 1px solid rgba(0, 0, 0, 0.2);
      box-sizing: border-box;
    }

    #page-loader {
      height: 100px;
      line-height: 100px;
      text-align: center;
      display: none;
      color: #999999;
      font-size: 13px;
    }
  </style>
  </head>

  <div id="accordion">
    <!-- <div class="card mb-4">
      <div class="card-header p-0" id="headingOne">
        <h5 class="mb-0">
          <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Convert PDF to Image (.png, .jpg)
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
        <div class="card-body">
          <button id="upload-button">Select PDF</button>
          <input type="file" id="file-to-upload" accept="application/pdf" />

          <div id="pdf-main-container">
            <div id="pdf-loader">Loading document ...</div>
            <div id="pdf-contents">
              <div id="pdf-meta">
                <div id="pdf-buttons">
                  <button id="pdf-prev">Previous</button>
                  <button id="pdf-next">Next</button>
                </div>
                <div id="page-count-container">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div>
                </div>
              </div>
              <canvas id="pdf-canvas" width="400"></canvas>
              <div style="min-height: 552px; padding-top: 50%;" id="page-loader">Loading page ...</div>
              <a id="download-image-jpg" href="javascript:void(0)" class="d-block text-center">Download JPG</a>
              <a id="download-image-png" href="javascript:void(0)" class="d-block text-center">Download PNG</a>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <?php if ($_SESSION['permission'] == 1) { ?>
      <div class="card mb-4">
        <div class="card-header p-0" id="headingTranslate">
          <h5 class="mb-0">
            <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseTranslate" aria-expanded="true" aria-controls="collapseTranslate">
              Translate Language
            </button>
          </h5>
        </div>
        <div id="collapseTranslate" class="collapse show" aria-labelledby="headingTranslate">
          <div class="card-body">
            <form method="POST" action="/admin/helper/?lang=<?php echo LANGUAGE_CODE ?>&action=language">

              <div class="table-responsive">
                <?php if ($data['language']) { ?>
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th class="nosort not-first-child">String</th>
                        <th class="nosort"><?php echo _pll('Vietnamese') ?></th>
                        <th class="nosort"><?php echo _pll('Japanses') ?></th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th class="nosort not-first-child">String</th>
                        <th class="nosort"><?php echo _pll('Vietnamese') ?></th>
                        <th class="nosort"><?php echo _pll('Japanses') ?></th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php foreach ($data['language'] as $k => $v) {
                        printf('<tr><td style="vertical-align: middle">%1$s</td><td style="vertical-align: middle"><input type="text" name="language[%2$s][vi]" value="%3$s" class="form-control" /></td><td style="vertical-align: middle"><input type="text" name="language[%2$s][ja]" value="%4$s" class="form-control" /></td></tr>', base64_decode($k) , $k, isset($v['vi']) && !empty($v['vi']) ? $v['vi'] : base64_decode($k), isset($v['ja']) && !empty($v['ja']) ? $v['ja'] : base64_decode($k) );
                      } ?>
                    </tbody>
                  </table>
                  <button class="btn btn-primary border float-right">Save</button>
                <?php } else {
                  printf('<p class="text-danger text-center mb-0" style="font-size: 1.5rem;">No data</p>');
                } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ($_SESSION['permission'] == 1 && IMAGICK) { ?>
      <div class="card mb-4">
        <div class="card-header p-0" id="headingUploadVolImage">
          <h5 class="mb-0">
            <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseploadVolImage" aria-expanded="true" aria-controls="collapseploadVolImage">
              Vol Images Upload
            </button>
          </h5>
        </div>
        <div id="collapseploadVolImage" class="collapse show" aria-labelledby="headingploadVolImage">
          <div class="card-body">
            <form action="/admin/helper/?lang=<?php echo LANGUAGE_CODE ?>&action=vol_images" class="dropzone dz-clickable" id="my-dropzone">
              <div class="dz-message d-flex flex-column">
                <i class="material-icons text-muted">cloud_upload</i>
                Drag &amp; Drop here or click
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ($_SESSION['permission'] == 1 && IMAGICK) { ?>
      <div class="card mb-4">
        <div class="card-header p-0" id="headingTranslate">
          <h5 class="mb-0">
            <button type="button" class="btn p-3  w-100 text-left text-uppercase" data-toggle="collapse" data-target="#collapseImgO" aria-expanded="true" aria-controls="collapseImgO">
              Image Thumbnail
            </button>
          </h5>
        </div>
        <div id="collapseImgO" class="collapse show" aria-labelledby="headingImgO">
          <div class="card-body">
            <?php
            if ((isset($_GET['imgop_status']) && !empty($_GET['imgop_status']))) {
              if ($_GET['imgop_status'] == 1) {
                printf('<p class="text-success mb-2">Optimization Success</p>');
              } else {
                printf('<p class="text-danger mb-2">Optimization Failed. The folder invalid.</p>');
              }
            }
            ?>
            <form method="POST" action="/admin/helper/?lang=<?php echo LANGUAGE_CODE ?>&action=imagick">
              <div class="form-group row">
                <label for="name-vi" class="col-auto col-form-label">Folder: data/uploads/</label>
                <div class="col">
                  <input type="text" class="form-control" placeholder="vol/images/" name="folder" required>
                </div>
              </div>
              <div class="row">
                <div class="col-auto ml-auto">
                  <button class="btn btn-primary border">Run</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <script>
    var namePDF = '';
    // Download button (PNG)
    $("#download-image-png").on('click', function() {
      $(this).attr('href', $('#pdf-canvas').get(0).toDataURL());
      var page = $('#pdf-current-page').html();
      if (namePDF) {
        var img_name = namePDF.replace('.pdf', '_' + page + '.png');
      }
      // Specfify download option with name
      $(this).attr('download', img_name);
    });

    // Download button (JPE)
    $("#download-image-jpg").on('click', function() {
      $(this).attr('href', $('#pdf-canvas').get(0).toDataURL("image/jpeg", 1));
      var page = $('#pdf-current-page').html();
      if (namePDF) {
        var img_name = namePDF.replace('.pdf', '_' + page + '.jpg');
      }
      // Specfify download option with name
      $(this).attr('download', img_name);
    });

   <?php /* var __PDF_DOC,
      __CURRENT_PAGE,
      __TOTAL_PAGES,
      __PAGE_RENDERING_IN_PROGRESS = 0,
      __CANVAS = $('#pdf-canvas').get(0),
      __CANVAS_CTX = __CANVAS.getContext('2d');

    function showPDF(pdf_url) {
      $("#pdf-loader").show();

      PDFJS.getDocument({
        url: pdf_url
      }).then(function(pdf_doc) {
        __PDF_DOC = pdf_doc;
        __TOTAL_PAGES = __PDF_DOC.numPages;

        // Hide the pdf loader and show pdf container in HTML
        $("#pdf-loader").hide();
        $("#pdf-contents").show();
        $("#pdf-total-pages").text(__TOTAL_PAGES);

        // Show the first page
        showPage(1);
      }).catch(function(error) {
        // If error re-show the upload button
        $("#pdf-loader").hide();
        $("#upload-button").show();

        alert(error.message);
      });;
    }

    function showPage(page_no) {
      __PAGE_RENDERING_IN_PROGRESS = 1;
      __CURRENT_PAGE = page_no;

      // Disable Prev & Next buttons while page is being loaded
      $("#pdf-next, #pdf-prev").attr('disabled', 'disabled');

      // While page is being rendered hide the canvas and show a loading message
      $("#pdf-canvas").hide();
      $("#page-loader").show();

      // Update current page in HTML
      $("#pdf-current-page").text(page_no);

      // Fetch the page
      __PDF_DOC.getPage(page_no).then(function(page) {
        // As the canvas is of a fixed width we need to set the scale of the viewport accordingly
        var scale_required = __CANVAS.width / page.getViewport(1).width;

        // Get viewport of the page at required scale
        var viewport = page.getViewport(scale_required);

        // Set canvas height
        __CANVAS.height = viewport.height;

        var renderContext = {
          canvasContext: __CANVAS_CTX,
          viewport: viewport
        };

        // Render the page contents in the canvas
        page.render(renderContext).then(function() {
          __PAGE_RENDERING_IN_PROGRESS = 0;

          // Re-enable Prev & Next buttons
          $("#pdf-next, #pdf-prev").removeAttr('disabled');

          // Show the canvas and hide the page loader
          $("#pdf-canvas").show();
          $("#page-loader").hide();
        });
      });
    }

    // Upon click this should should trigger click on the #file-to-upload file input element
    // This is better than showing the not-good-looking file input element
    $("#upload-button").on('click', function() {
      $("#file-to-upload").trigger('click');
    });

    // When user chooses a PDF file
    $("#file-to-upload").on('change', function() {
      namePDF = $("#file-to-upload").get(0).files[0].name;
      // Validate whether PDF
      if (['application/pdf'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
        alert('Error : Not a PDF');
        return;
      }

      $("#upload-button").hide();

      // Send the object url of the pdf
      showPDF(URL.createObjectURL($("#file-to-upload").get(0).files[0]));
    });

    // Previous page of the PDF
    $("#pdf-prev").on('click', function() {
      if (__CURRENT_PAGE != 1)
        showPage(--__CURRENT_PAGE);
    });

    // Next page of the PDF
    $("#pdf-next").on('click', function() {
      if (__CURRENT_PAGE != __TOTAL_PAGES)
        showPage(++__CURRENT_PAGE);
    });
    */ ?>
  </script>
</div>