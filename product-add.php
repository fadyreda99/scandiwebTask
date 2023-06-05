<?php

use app\models\BookType;
use app\models\DVDType;
use app\models\FurnitureType;
use app\models\Product;
use app\models\TypeOfProduct;

$title = 'Add Product';
include_once "layouts/header.php";


$typesObj = new TypeOfProduct;
$typesRes = $typesObj->read();

$product = new Product;
$dvd = new DVDType;
$book = new BookType;
$furniture = new FurnitureType;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $productErrors = [];
  $dvdErrors = [];
  $bookErrors = [];
  $furnitureErrors = [];



  if (empty($_POST['sku'])) {
    $productErrors['sku']['required'] = 'SKU is required';
  }

  if (empty($_POST['name'])) {
    $productErrors['name']['required'] = 'name is required';
  }

  if (empty($_POST['price'])) {
    $productErrors['price']['required'] = 'price is required';
  }

  if ($_POST['productType'] === "0") {
    $productErrors['productType']['required'] = 'productType is required';
  }


  $product->setSKU($_POST['sku'])
    ->setName($_POST['name'])
    ->setPrice($_POST['price'])
    ->setType_id($_POST['productType']);


  $uniqueSKU = $product->getProductBySKU();
  if ($uniqueSKU->num_rows >= 1) {
    $productErrors['sku']['unique'] = 'SkU is already exists please enter unique one';
    // echo "yes";
  }

  if ($_POST['productType'] === "1") {
    if (empty($_POST['height'])) {
      $furnitureErrors['height']['required'] = 'height is required';
    }

    if (empty($_POST['width'])) {
      $furnitureErrors['width']['required'] = 'width is required';
    }

    if (empty($_POST['length'])) {
      $furnitureErrors['length']['required'] = 'length is required';
    }

    if (empty($furnitureErrors)) {
      $furniture->setHight($_POST['width'])
        ->setWidth($_POST['width'])
        ->setLength($_POST['length'])
        ->setSKU($_POST['sku']);

      if (empty($productErrors) && empty($furnitureErrors)) {
        $product->create();
        $furniture->create();
        header('Location: index.php');
        exit;
      }
    }
  } elseif ($_POST['productType'] === "2") {
    if (empty($_POST['size'])) {
      $dvdErrors['size']['required'] = 'size is required';
    } else {
      $dvd->setSize($_POST['size'])
        ->setSKU($_POST['sku']);

      if (empty($productErrors) && empty($dvdErrors)) {
        $product->create();
        $dvd->create();
        header('Location: index.php');
        exit;
      }
    }
  } elseif ($_POST['productType'] === "3") {
    if (empty($_POST['weight'])) {
      $bookErrors['weight']['required'] = 'weight is required';
    } else {
      $book->setWeight($_POST['weight'])
        ->setSKU($_POST['sku']);


      if (empty($productErrors) && empty($bookErrors)) {
        $product->create();
        $book->create();
        header('Location: index.php');
        exit;
      }
    }
  }
}




?>




<form action="" id="product_form" method="post">
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

              <?php
              if (!empty($productErrors['sku']['required'])) { ?>
                <div class="text-danger">
                  <?php
                  echo $productErrors['sku']['required'];
                  ?>
                </div>
              <?php }
              ?>

              <?php
              if (!empty($productErrors['sku']['unique'])) { ?>
                <div class="text-danger">
                  <?php
                  echo $productErrors['sku']['unique'];
                  ?>
                </div>
              <?php }
              ?>


            </div>
          </div>

          <div class="mb-3 row">
            <label for="name" class="col-sm-2 fw-bolder col-form-label">Name</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" id="name" name="name" />
              <?php
              if (!empty($productErrors['name']['required'])) { ?>
                <div class="text-danger">
                  <?php
                  echo $productErrors['name']['required'];
                  ?>
                </div>
              <?php }
              ?>
            </div>
          </div>

          <div class="mb-3 row">
            <label for="price" class="col-sm-2 fw-bolder col-form-label">Price ($)</label>
            <div class="col-sm-3">
              <input type="number" class="form-control" id="price" name="price" />
              <?php
              if (!empty($productErrors['price']['required'])) { ?>
                <div class="text-danger">
                  <?php
                  echo $productErrors['price']['required'];
                  ?>
                </div>
              <?php }
              ?>
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
              <?php
              if (!empty($productErrors['productType']['required'])) { ?>
                <div class="text-danger">
                  <?php
                  echo $productErrors['productType']['required'];
                  ?>
                </div>
              <?php }
              ?>
            </div>
          </div>

          <!-- -------------------------------------------slect one of this divs depends on type switcher by jqery -->

          <div class="types">
            <!-- dvd -->
            <div class="type dvd">
              <div class="mb-3 row">
                <label for="size" class="col-sm-2 fw-bolder col-form-label">Size (MB)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="size" name="size" />

                  <?php
                  if (!empty($dvdErrors['size']['required'])) { ?>
                    <div class="text-danger">
                      <?php
                      echo $dvdErrors['size']['required'];
                      ?>
                    </div>
                  <?php }
                  ?>
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

                  <?php
                  if (!empty($furnitureErrors['height']['required'])) { ?>
                    <div class="text-danger">
                      <?php
                      echo $furnitureErrors['height']['required'];
                      ?>
                    </div>
                  <?php }
                  ?>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="width" class="col-sm-2 fw-bolder col-form-label">Width (CM)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="width" name="width" />

                  <?php
                  if (!empty($furnitureErrors['width']['required'])) { ?>
                    <div class="text-danger">
                      <?php
                      echo $furnitureErrors['width']['required'];
                      ?>
                    </div>
                  <?php }
                  ?>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="length" class="col-sm-2 fw-bolder col-form-label">Length (CM)</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="length" name="length" />

                  <?php
                  if (!empty($furnitureErrors['length']['required'])) { ?>
                    <div class="text-danger">
                      <?php
                      echo $furnitureErrors['length']['required'];
                      ?>
                    </div>
                  <?php }
                  ?>
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

                  <?php
                  if (!empty($bookErrors['weight']['required'])) { ?>
                    <div class="text-danger">
                      <?php
                      echo $bookErrors['weight']['required'];
                      ?>
                    </div>
                  <?php }
                  ?>
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