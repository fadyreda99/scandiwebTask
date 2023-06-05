<?php


use app\models\TypeOfProduct;

$title = 'Add Product';
include_once "layouts/header.php";

$typesObj = new TypeOfProduct;
$typesRes = $typesObj->read();

?>

<form id="product_form">
  <header>
    <div class="container header">
      <div class="row">
        <div class="col-9"><span class="title">Add Product </span></div>
        <div class="col-md-3 ms-auto align-self-center">
          <span class="btns">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="index.php" class="reset btn btn-danger"> Cancel </a>
          </span>
        </div>
      </div>
    </div>
  </header>

  <div class="body">
    <div class="container">
      <div class="row">
        <div class="">
          <div class="mb-3 row">
            <label for="sku" class="col-sm-2 fw-bolder col-form-label">SKU</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="sku" name="sku" />
              <div class="skuMsg text-danger"></div>
              <div class="uniqueSkuMsg text-danger"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="name" class="col-sm-2 fw-bolder col-form-label">Name</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="name" name="name" />
              <div class="nameMsg text-danger"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="price" class="col-sm-2 fw-bolder col-form-label">Price ($)</label>
            <div class="col-sm-3">
              <input type="number" class="form-control" id="price" name="price" />
              <div class="priceMsg text-danger"></div>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 fw-bolder col-form-label">
              Type Switcher</label>
            <div class="col-sm-3">
              <select class="form-select" aria-label="Default select example" id="productType" name="productType">
                <option value="0" selected>Type Switcher</option>
                <?php
                foreach ($typesRes as $type) { ?>
                  <option data-cat=".<?= $type['type'] ?>" value="<?= $type['id'] ?>"><?= strtoupper($type['type']) ?></option>
                <?php }
                ?>
                <!-- <option data-cat=".dvd" value="dvd">DVD</option>
                    <option data-cat=".furniture" value="furniture">Furniture</option>
                    <option data-cat=".book" value="book">Book</option> -->
              </select>
              <div class="typeMsg text-danger"></div>
            </div>
          </div>

          <!-- -------------------------------------------select one of this divs depends on type switcher by jqery -->

          <div class="types">
            <!-- dvd -->
            <div class="type dvd">
              <div class="mb-3 row">
                <label for="size" class="col-sm-2 fw-bolder col-form-label">Size (MB)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="size" name="size" />

                  <div class="sizeMsg text-danger"></div>
                </div>
              </div>
              <p>"Please, provide size"</p>
            </div>

            <!-- furniture -->
            <div class="type furniture">
              <div class="mb-3 row">
                <label for="height" class="col-sm-2 fw-bolder col-form-label">Height (CM)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="height" name="height" />

                  <div class="heightMsg text-danger"></div>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="width" class="col-sm-2 fw-bolder col-form-label">Width (CM)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="width" name="width" />

                  <div class="widthMsg text-danger"></div>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="length" class="col-sm-2 fw-bolder col-form-label">Length (CM)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="length" name="length" />

                  <div class="lengthMsg text-danger"></div>
                </div>
              </div>
              <p>"Please, provide dimensions"</p>
            </div>

            <!-- book -->
            <div class="type book">
              <div class="mb-3 row">
                <label for="weight" class="col-sm-2 fw-bolder col-form-label">Weight (KG)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="weight" name="weight" />

                  <div class="weightMsg text-danger"></div>
                </div>
              </div>
              <p>"Please, provide weight"</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</form>
<?php
include_once "layouts/footer.php";
?>