<script src="https://kit.fontawesome.com/3cff919dc3.js" crossorigin="anonymous"></script>
<div class='wrap'>
  <?php
  echo ('<h1 class="h1 fw-bold">' . get_admin_page_title() . '</h1>');
  ?>
  <br>
  <hr>
  <!-- Button trigger modal -->
  <button type="button" id="newRate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRate">
    Add
  </button>
  <button class="btn btn-primary u-file" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
    aria-expanded="false" aria-controls="collapseExample">
    Bulk load
  </button>
  <button type="button" id="newRate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePrices">
    Update product prices
  </button>
  <div class="collapse" id="collapseExample">
    <div class="card card-body bg-secondary bg-opacity-25" style='min-width: 100%;'>
      <div style='min-width: 100%; text-align: center;'>
        <button style='width: 100%; text-align: center; font-size: 4em;' id='btn-u' class='btn btn-primary'>
          <i class="fa-solid fa-circle-arrow-up"></i>
          <p class='msjFile fw-bold' style='font-size: 0.3em;'></p>
        </button>
        <button style='width: 100%; text-align: center; font-size: 1.5em; margin-top: 2mm;' id='btn-i'
          class='btn btn-success none'>
          Import
        </button>
      </div>
      <div class="input-group mb-3 none">
        <input type="file" class="form-control" id="i-file" name='file' accept='.xlsx'>
      </div>
    </div>
  </div>
  <br>
  <hr>

  <div class='content-searchBar'>
    <div class="input-group mb-3">
      <input type="text" class="form-control" id='i-searchProducts' placeholder="Search..."
        aria-label="Recipient's username" aria-describedby="button-addon2">
      <button class="btn btn-success" type="button" id="button-addon2"><i
          class="fa-solid fa-magnifying-glass"></i></button>
    </div>
  </div>
  <hr>

  <div class='content-mainTable'>
    <table class='wp-list-table widefast fixed striped pages table'>
      <thead>
        <th scope="col" style='text-align: center; background-color: #000; color: #fff;'>Product</th>
        <th scope="col" style='text-align: center; background-color: #000; color: #fff;'>Weights</th>
        <th scope="col" style='text-align: center; background-color: #000; color: #fff;'>Dimensions</th>
        <th scope="col" style='text-align: center; background-color: #000; color: #fff;'>Prices</th>
        <th scope="col" style='text-align: center; background-color: #000; color: #fff;'>Actions</th>
      </thead>
      <tbody class='the-list' id='pc'>

      </tbody>
    </table>

  </div>
</div>

<!-- Modal Update products prices-->
<div class="modal fade" id="updatePrices" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  style="z-index : 10000;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update products prices</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-text fw-bold" id="basic-addon1">Type of increase:</span>
          <select class="form-select" aria-label="Default select example" id='tIncrease'>
            <option selected style='text-align: center;' value='0'>-- Select --</option>
            <option value="1">Percentage</option>
            <option value="2">Rate</option>
          </select>
        </div>
        <hr>
        <div class="cPercentage none">
          <div class="input-group">
            <span class="input-group-text fw-bold" id="basic-addon1">Percentage:</span>
            <input type="number" id='txt-percentage' class="form-control text-uppercase" aria-label="Username"
              aria-describedby="basic-addon1">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-text fw-bold" id="basic-addon1">Categorie:</span>
            <select class="form-select" aria-label="Default select example" id='categorieProduct'>

            </select>
          </div>
        </div>
        <div class="cRate none">
          <div class="input-group">
            <span class="input-group-text fw-bold" id="basic-addon1">Rate:</span>
            <input type="number" id='txt-rate' class="form-control text-uppercase" aria-label="Username"
              aria-describedby="basic-addon1">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-text fw-bold" id="basic-addon1">Categorie:</span>
            <select class="form-select" aria-label="Default select example" id='categorieProduct2'>

            </select>
          </div>
          <hr>
          <div class="input-group">
            <span class="input-group-text fw-bold" id="basic-addon1">Filter price:</span>
            <select class="form-select" aria-label="Default select example" id='filterPrice'>
              <option selected style='text-align: center;' value='0'>-- Select --</option>
              <option value="1">All</option>
              <option value="2">
                < 500$</option>
              <option value="3">> 500$</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCloseUPP">Close</button>
        <button type="button" class="btn btn-primary" id="btnUpdateProductsPrices">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade modal-xl" id="addRate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
  style="z-index : 10000;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLabel">Add product</h5>
        <button type="button" class="btn-close p-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-text fw-bold" id="basic-addon1">Line:</span>
          <select class="form-select" aria-label="Default select example" id='lineP'>
            <option selected style='text-align: center;' value='0'>-- Select --</option>
            <option value="Laboratory">Laboratory</option>
            <option value="Medical Equipment">Medical Equipment</option>
            <option value="Other">Other</option>
          </select>
          <input type="text" id='txt-other-line' class="form-control none" aria-label="Username"
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Category:</span>
          <select class="form-select" aria-label="Default select example" id='categoryP'>
            <option selected style='text-align: center;' value='0'>-- Select --</option>
            <option value="Analyzers">Analyzers</option>
            <option value="Autoclaves">Autoclaves</option>
            <option value="Other">Other</option>
          </select>
          <input type="text" id='txt-other-category' class="form-control none" aria-label="Username"
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Subcategory:</span>
          <select class="form-select" aria-label="Default select example" id='subcategoryP'>
            <option selected style='text-align: center;' value='0'>-- Select --</option>
            <option value="Coagulation">Coagulation</option>
            <option value="Electrolyte">Electrolyte</option>
            <option value="Other">Other</option>
          </select>
          <input type="text" id='txt-other-subcategory' class="form-control none" aria-label="Username"
            aria-describedby="basic-addon1">
        </div>
        <hr>
        <div class="row">
          <div class="col-8">
            <div class="row">
              <div class="col-4">
                <div class="input-group">
                  <span class="input-group-text fw-bold" id="basic-addon1">Model:</span>
                  <input type="text" id='txt-name-product' class="form-control text-uppercase" aria-label="Username"
                    aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="col">
                <div class="input-group">
                  <span class="input-group-text fw-bold" id="basic-addon1">Name:</span>
                  <input type="text" id='txt-name-product' class="form-control" aria-label="Username"
                    aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <h6 class='fw-bold'>Prices</h6>
                <div class="input-group">
                  <span class="input-group-text fw-bold" id="basic-addon1">USD:</span>
                  <input type="text" id='txt-name-product' class="form-control" aria-label="Username"
                    aria-describedby="basic-addon1">
                  <span class="input-group-text fw-bold" id="basic-addon1">EUR:</span>
                  <input type="text" id='txt-name-product' class="form-control" aria-label="Username"
                    aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="col">
                <h6 class='fw-bold'>Weight</h6>
                <div class="input-group">
                  <span class="input-group-text fw-bold" id="basic-addon1">Net:</span>
                  <input type="text" id='txt-name-product' class="form-control" aria-label="Username"
                    aria-describedby="basic-addon1">
                  <span class="input-group-text fw-bold" id="basic-addon1">Gross:</span>
                  <input type="text" id='txt-name-product' class="form-control" aria-label="Username"
                    aria-describedby="basic-addon1">
                </div>
              </div>
            </div>
            <hr>
            <h6 class='fw-bold'>Product Size</h6>
            <div class="input-group">
              <span class="input-group-text fw-bold" id="basic-addon1">Long:</span>
              <input type="number" id='txt-long' class="form-control" aria-label="Username"
                aria-describedby="basic-addon1">
              <span class="input-group-text fw-bold" id="basic-addon1">Width:</span>
              <input type="number" id='txt-width' class="form-control" aria-label="Username"
                aria-describedby="basic-addon1">
              <span class="input-group-text fw-bold" id="basic-addon1">Height:</span>
              <input type="number" id='txt-height' class="form-control" aria-label="Username"
                aria-describedby="basic-addon1">
            </div>
            <hr>
            <h6 class='fw-bold'>Package Size</h6>
            <div class="input-group">
              <span class="input-group-text fw-bold" id="basic-addon1">Long:</span>
              <input type="number" id='txt-long1' class="form-control" aria-label="Username"
                aria-describedby="basic-addon1">
              <span class="input-group-text fw-bold" id="basic-addon1">Width:</span>
              <input type="number" id='txt-width1' class="form-control" aria-label="Username"
                aria-describedby="basic-addon1">
              <span class="input-group-text fw-bold" id="basic-addon1">Height:</span>
              <input type="number" id='txt-height1' class="form-control" aria-label="Username"
                aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="col" style="height: 70mm; padding-right: 3mm; padding-top: 0;">
            <div style="width: 100%; height: 80mm; margin-top: 0;">
              <button class="btn btn-light">
                <img
                  src="http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/upload_image.png"
                  alt="" style="width: 100%; height: 100%;">
              </button>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col">
            <label for="textAreaProduct" class="form-label fw-bold">Product Description</label>
            <div class="input-group">
              <div id="menu-actions1" class="menu-actions">
                <button class="btn b-1" style='height: 9mm; margin-top: 0.5mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-bold"></i></button>
                <button class="btn i-1" style='height: 9mm; margin-top: 0.5mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-italic"></i></button>
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; margin-left: 4mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-list-ol"></i></button>
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-list-ul"></i></button>
                <button class="btn z-1" style='height: 9mm; margin-top: 0.5mm; margin-left: 4mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-arrow-rotate-left"></i></button>
                <button class="btn y-1" style="height: 9mm; margin-top: 0.5mm; text-align: center;"><i
                    class="fa-sharp fa-solid fa-arrow-rotate-right"></i></button>
              </div>
              <textarea class="form-control" id="textAreaProduct" rows="3"></textarea>
            </div>
          </div>
          <div class="col">
            <h6><b>Published View</b></h6>
            <div id="view-1" style="width: 100%;">

            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col">
            <label for="textAreaTechnical" class="form-label fw-bold">Technical Description</label>
            <div class="input-group">
              <div id="menu-actions2" class="menu-actions">
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-bold"></i></button>
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-italic"></i></button>
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; margin-left: 4mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-list-ol"></i></button>
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-list-ul"></i></button>
                <button class="btn" style='height: 9mm; margin-top: 0.5mm; margin-left: 4mm; text-align: center;'><i
                    class="fa-sharp fa-solid fa-arrow-rotate-left"></i></button>
                <button class="btn" style="height: 9mm; margin-top: 0.5mm; text-align: center;"><i
                    class="fa-sharp fa-solid fa-arrow-rotate-right"></i></button>
              </div>
              <textarea class="form-control" id="textAreaTechnical" rows="3"></textarea>
            </div>
          </div>
          <div class="col">
            <div id="view-2">

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary p-close" data-bs-dismiss="modal">Close</button>
        <button type="button" id='btnSavedProduct' class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete the product <button id='modelDeleteP'
            style='background: none; border: none; outline: none; font-weight: bold; cursor: text; margin: 0; padding: 0;'></button>?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClosedDP">Close</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteP">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade modal-lg" id="editP" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group">
          <span class="input-group-text fw-bold" id="basic-addon1">Model:</span>
          <input type="text" id='txt-modelPE' class="form-control" aria-label="Username" readonly
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Name:</span>
          <input type="text" id='txt-namePE' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <hr>
        <h6 class='fw-bold'>Product Weight</h6>
        <div class="input-group">
          <span class="input-group-text fw-bold" id="basic-addon1">Net weight:</span>
          <input type="text" id='txt-netWE' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Gross weight:</span>
          <input type="number" id='txt-grossWE' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
        </div>
        <hr>
        <h6 class='fw-bold'>Product Size</h6>
        <div class="input-group">
          <span class="input-group-text fw-bold" id="basic-addon1">Long:</span>
          <input type="number" id='txt-longE' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Width:</span>
          <input type="number" id='txt-widthE' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Height:</span>
          <input type="number" id='txt-heightE' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
        </div>
        <hr>
        <h6 class='fw-bold'>Package Size</h6>
        <div class="input-group">
          <span class="input-group-text fw-bold" id="basic-addon1">Long:</span>
          <input type="number" id='txt-long1E' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Width:</span>
          <input type="number" id='txt-width1E' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
          <span class="input-group-text fw-bold" id="basic-addon1">Height:</span>
          <input type="number" id='txt-height1E' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1">
        </div>
        <hr>
        <h6 class='fw-bold'>Prices</h6>
        <div class='input-group'>
          <span class="input-group-text fw-bold" id="basic-addon1">EUR:</span>
          <input type="number" id='txt-pricePE' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1" min="0" step="0.00">
          <span class="input-group-text fw-bold" id="basic-addon1">USD:</span>
          <input type="number" id='txt-pricePU' class="form-control" aria-label="Username"
            aria-describedby="basic-addon1" min="0" step="0.00">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id='btnClosedEditProduct' data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id='btnSavedProductChange'>Save changes</button>
      </div>
    </div>
  </div>
</div>