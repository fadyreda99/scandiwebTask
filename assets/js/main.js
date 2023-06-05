$(document).ready(function () {
  $("select").change(function () {
    $(this)
      .find("option:selected")
      .each(function () {
        var typeValue;
        var typeID = $(this).attr("value");
        if (typeID == 1) {
          typeValue = "furniture";
        } else if (typeID == 2) {
          typeValue = "dvd";
        } else if (typeID == 3) {
          typeValue = "book";
        }

        if (typeValue) {
          $(".type")
            .not("." + typeValue)
            .hide();
          $("." + typeValue).show();
        } else {
          $(".type").hide();
        }
      });
  });
});
