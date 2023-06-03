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
            if (responseText.search('submitFlag = "1"') > 0) {
                window.location.href= "index.php"
            }
        });
    });
});



