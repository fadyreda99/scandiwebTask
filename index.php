<?php

use app\models\BookType;
use app\models\DVDType;
use app\models\FurnitureType;
use app\models\Product;

$title = 'Product List';
include_once "layouts/header.php";

$dvdTypesObj = new DVDType;
$dvdTypesRes = $dvdTypesObj->read();

$bookTypesObj = new BookType;
$bookTypeRes = $bookTypesObj->read();

$furnitureTypeObj = new FurnitureType;
$furnitureTypeRes = $furnitureTypeObj->read();

$productObj = new Product;

if (isset($_POST["delete"]) && isset($_POST["deleteId"])) {
  foreach ($_POST["deleteId"] as $deleteItems) {
    $productObj->delete($deleteItems);
  }
}
?>
<form action="" method="post">
  <header>
    <div class="container header">
      <div class="row">
        <div class="col-9"><span class="title"> Product List </span></div>
        <div class="col-md-3 ms-auto align-self-center">
          <span class="btns">
            <a href="product-add.php" class="btn btn-primary">Add</a>
            <button type="submit" class="btn btn-danger" name="delete">Mass Delete</button>
          </span>
        </div>
      </div>
    </div>
  </header>

  <div class="body">
    <div class="container">
      <div class="row">

        <?php
        if ($dvdTypesRes->num_rows >= 1) {
          $dvdTypes = $dvdTypesRes->fetch_all(MYSQLI_ASSOC);
          foreach ($dvdTypes as $dvdType) {
        ?>
            <div class="col mb-5">
              <div class="card" style="width: 18rem">
                <div class="card-body text-center">

                  <div class="card-title text-start">
                    <div>
                      <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="deleteId[]" value="<?= $dvdType['SKU'] ?>" aria-label="..." />
                    </div>
                  </div>

                  <div class="card-text text-center" id="card-txt">
                    <p><?= $dvdType['SKU'] ?></p>
                    <p><?= $dvdType['name'] ?></p>
                    <p><?= $dvdType['price'] ?> $</p>
                    <p>size: <?= $dvdType['size'] ?> MB</p>
                  </div>

                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>

        <?php
        if ($bookTypeRes->num_rows >= 1) {
          $bookTypes = $bookTypeRes->fetch_all(MYSQLI_ASSOC);
          foreach ($bookTypes as $bookType) {
        ?>
            <div class="col mb-5">
              <div class="card" style="width: 18rem">
                <div class="card-body text-center">

                  <div class="card-title text-start">
                    <div>
                      <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="deleteId[]" value="<?= $bookType['SKU'] ?>" aria-label="..." />
                    </div>
                  </div>

                  <div class="card-text text-center" id="card-txt">
                    <p><?= $bookType['SKU'] ?></p>
                    <p><?= $bookType['name'] ?></p>
                    <p><?= $bookType['price'] ?> $</p>
                    <p>Weight: <?= $bookType['weight'] ?>KG</p>
                  </div>

                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>

        <?php
        if ($furnitureTypeRes->num_rows >= 1) {
          $furnitureTypes = $furnitureTypeRes->fetch_all(MYSQLI_ASSOC);
          foreach ($furnitureTypes as $furnitureType) {
        ?>
            <div class="col mb-5">
              <div class="card" style="width: 18rem">
                <div class="card-body text-center">

                  <div class="card-title text-start">
                    <div>
                      <input class="form-check-input" type="checkbox" id="checkboxNoLabel" name="deleteId[]" value="<?= $furnitureType['SKU'] ?>" aria-label="..." />
                    </div>
                  </div>

                  <div class="card-text text-center" id="card-txt">
                    <p><?= $furnitureType['SKU'] ?></p>
                    <p><?= $furnitureType['name'] ?></p>
                    <p><?= $furnitureType['price'] ?> $</p>
                    <p>Dimention: <?= $furnitureType['hight'] ?>☓<?= $furnitureType['width'] ?>☓<?= $furnitureType['length'] ?></p>
                  </div>

                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
</form>
<?php
include_once "layouts/footer.php";
?>