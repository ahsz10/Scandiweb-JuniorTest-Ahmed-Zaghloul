//Dynamically change form attributes based on type switcher selection
$(document).ready(function () {
    $(".typeSwitch").hide();
    $("#productType").change(function () {
        $(".typeSwitch").hide();
        $('#' + $(this).val()).show();
    });
});

//Retrieving errors using Ajax method to display them to the user without reloading the page
$(document).ready(function() {
    $("#product_form").submit(function(event) {
        // $("#save").val("Please wait ...");
        // $("#save").attr("disabled", true);
        event.preventDefault();
        var sku = $("#sku").val();
        var name = $("#name").val();
        var price = $("#price").val();
        var productType = $("#productType").val();
        var size = $("#size").val();
        var weight = $("#weight").val();
        var height = $("#height").val();
        var width = $("#width").val();
        var length = $("#length").val();
        var save = $("#save").val();
        $(".errorMessage").load("Private/Operations/addNewProduct.php", {
            sku: sku,
            name: name,
            price: price,
            productType: productType,
            size: size,
            weight: weight,
            height: height,
            width: width,
            length: length,
            save: save
        }, function (responseText){
            // alert("stopped");
            if (responseText.search('submitFlag = "1"') > 0) {
                // alert("stoped in submission flag");
                window.location.href= "product-list.php"
            }
        });
    });
});

// $(document).ready(function() {
//     $("#delete-form").submit(function(event) {
//         $("#deletebtn").val("Please wait ...");
//         $("#deletebtn").attr("disabled", true);
//         event.preventDefault();
//         var deleteCheckbox = $(".delete-checkbox").val();
//         var deletebtn = $("#delete-btn").val();
//         // $(".errorMessage").load("Private/Operations/deleteProduct.php", {
//         $(".errorMessage").load("deleteProduct.php", {
//             deleteCheckbox: deleteCheckbox,
//             deletebtn: deletebtn
//         }, function (responseText){
//             // alert("stopped");
//             if (responseText.search('submitFlag = "1"') > 0) {
//                 // alert("stoped in submission flag");
//                 window.location.href= "product-list.php"
//             }
//         });
//     });
// });


// console.log("emptyError-> "+ emptyError) 
// console.log("skuExisting-> " + skuExisting)
// console.log("invalidSKU-> " + invalidSKU)
// console.log("invalidName-> " + invalidName)
// console.log("invalidPrice-> " + invalidPrice)
// console.log("invalidAttribute-> " + invalidAttribute)
// console.log("submitFlag-> " + submitFlag)