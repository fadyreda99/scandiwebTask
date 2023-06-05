// console.log("test");

$(document).ready(function(){
    
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var typeValue;
            var typeID = $(this).attr("value");
            if(typeID == 1){
                typeValue = "furniture";
            }else if(typeID == 2){
                typeValue = "dvd";
            }else if(typeID == 3){
                typeValue = "book";
            }

            if(typeValue){
                $(".type").not("."+typeValue).hide();
                $("."+typeValue).show();
            }else{
                $(".type").hide();
            }
        })
    })
})









// $(document).ready(function () {
//   $("#productType").on("change", function () {
//     var value = $(this).val();
   
//     if (value == "dvd") {
//       $(".dvd").css("display", "block");
//       $(".book").css("display", "none");
//       $(".furniture").css("display", "none");

//       $("#height").attr("required", false);
//       $("#width").attr("required", false);
//       $("#length").attr("required", false);
//       $("#weight").attr("required", false);
//     } else if (value == "furniture") {
//       $(".dvd").css("display", "none");
//       $(".book").css("display", "none");
//       $(".furniture").css("display", "block");

//       $("#size").attr("required", false);
//       $("#weight").attr("required", false);
//     } else if (value == "book") {
//       $(".dvd").css("display", "none");
//       $(".book").css("display", "block");
//       $(".furniture").css("display", "none");

//       $("#height").attr("required", false);
//       $("#width").attr("required", false);
//       $("#length").attr("required", false);
//       $("#size").attr("required", false);
//     }
//   });

//   $(".reset").on("click", function () {
//     $("#product_form").trigger("reset");
//   });
// });

// var types = document.querySelectorAll(".types>div");
// var options = document.querySelectorAll("select>option");

//  $("#productType").on("change",function(){
//   var value = $(this).val();

//   // console.log($(types).attr('class'));
//   // if($(types).attr('class')== value ){
//   //   console.log('done');
//   // }
//   types.forEach((type) => {
//     // console.log($(type).attr('class'));
//     if($(type).hasClass("book")){
//       console.log("book");

//     }
// console.log( $(type)..classList);
// if($(type).attr('class')== value ){
//   console.log('done');
// }
// type.classList.remove("hide")
// value.classList.remove("hide")
// if($(types).hasClass(value)){
//   this.classList.remove("hide")
// }
// })
// document.querySelectorAll(this.dataset.cat).forEach((ele) => {
//   ele.style.display="block";
// })
// })

// console.log(options);
// $("#productType").on("change",function(){
//       var value = $(this).val();

// // console.log(value);

// // types.forEach((type) => {
// //   // console.log(type);
// //   type.addEventListener("click", function(){
// //     types.forEach((type) => {
// //       type.classList.remove("hide")
// //       this.classList.add("hide")
// //     })
// //   })
// // })

// })
