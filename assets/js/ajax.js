$(document).ready(function () {
  $("#product_form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "proccess.php",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,

      success: function (response) {
        if (response.productRequierdErrors.skuMsg) {
          $(".skuMsg").html(
            "<p>" + response.productRequierdErrors.skuMsg + "</p>"
          );
          setTimeout(() => {
            $(".skuMsg").html(" ");
          }, 2000);
        }

        if (response.productRequierdErrors.nameMsg) {
          $(".nameMsg").html(
            "<p>" + response.productRequierdErrors.nameMsg + "</p>"
          );
          setTimeout(() => {
            $(".nameMsg").html(" ");
          }, 2000);
        }

        if (response.productRequierdErrors.priceMsg) {
          $(".priceMsg").html(
            "<p>" + response.productRequierdErrors.priceMsg + "</p>"
          );
          setTimeout(() => {
            $(".priceMsg").html(" ");
          }, 2000);
        }

        if (response.productRequierdErrors.typeMsg) {
          $(".typeMsg").html(
            "<p>" + response.productRequierdErrors.typeMsg + "</p>"
          );
          setTimeout(() => {
            $(".typeMsg").html(" ");
          }, 2000);
        }

        if (response.uniqueProduct) {
          $(".uniqueSkuMsg").html("<p>" + response.uniqueProduct + "</p>");
          setTimeout(() => {
            $(".uniqueSkuMsg").html(" ");
          }, 2000);
        }

        //furniture type
        if (response.furnitureErrors.height) {
          $(".heightMsg").html(
            "<p>" + response.furnitureErrors.height + "</p>"
          );
          setTimeout(() => {
            $(".heightMsg").html(" ");
          }, 2000);
        }

        if (response.furnitureErrors.width) {
          $(".widthMsg").html("<p>" + response.furnitureErrors.width + "</p>");
          setTimeout(() => {
            $(".widthMsg").html(" ");
          }, 2000);
        }

        if (response.furnitureErrors.length) {
          $(".lengthMsg").html(
            "<p>" + response.furnitureErrors.length + "</p>"
          );
          setTimeout(() => {
            $(".lengthMsg").html(" ");
          }, 2000);
        }

        //dvd type
        if (response.dvdErrors.size) {
          $(".sizeMsg").html("<p>" + response.dvdErrors.size + "</p>");
          setTimeout(() => {
            $(".sizeMsg").html(" ");
          }, 2000);
        }

        //book type
        if (response.bookErrors.weight) {
          $(".weightMsg").html("<p>" + response.bookErrors.weight + "</p>");
          setTimeout(() => {
            $(".weightMsg").html(" ");
          }, 2000);
        }

        if (response.success == 1) {
          window.location.href = "index.php";
        } else {
          console.log("there is an error");
        }
      },
    });
  });
});
