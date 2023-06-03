<?php
include 'autoloader.php';
// require '../Controllers/ProductController.php';


error_reporting(E_ALL);
ini_set('display_errors', 1);

// error_reporting(0);

// Method to check if the input is valid and not empty
function isEmpty($input){
    $checkResult = false;
    if(is_array($input)){
        foreach ($input as $key => $value) {
            if (empty($value) && !is_numeric($value)) {
                $checkResult = true;
                break;
            }
        }
    }else if(empty($input) && !is_numeric($input)) {
        $checkResult = true;
    } 
    return $checkResult;
}

// Method to check the name and SKU patterns 
function checkPattern($inputPattern, $type){
    $skuPattern = "/^[a-zA-Z0-9]*$/";
    $namePattern= "/^[A-Za-z\d]{2,200}/";

    if($type == "SKU"){
        if (!preg_match($skuPattern, $inputPattern)  === 0) {
            return true;
        }
    }else if($type == "name"){
        if (!preg_match($namePattern, $inputPattern)  === 0) {
            return true;
        }
    }else{
        return false;
    }
}

// 
function isFloat($input){
    // echo "<br> IN ISFLOAT  ";
    $checkResult = false;
    if(is_array($input)){
        foreach ($input as $key => $value) {
            // echo "<br> IN ISFLOAT ARRAY var is ".$key."->".$value;
            if (!is_numeric($value) || $value <= 0) {
                // echo "<br> IN ISFLOAT ARRAY var is ".$key."->".$value;
                $checkResult = true;
                break;
            }
        }
    }else if(!is_numeric($input) || $input <= 0) {
        // echo "<br> IN ISFLOAT var is ".$input;
        $checkResult = true;
    } 
    return $checkResult;
}

function checkErrorsArray(array $errors) { 
    foreach ($errors as $key => $value) {
        if ($value === true ) {
            return true;
            // echo "<br> Error Values -> " .$key." -> ".$value;
            break;
        }
    }
    return false;
}

//Check if save button pressed
if ((isset($_POST['save']))) {
    // User input
    $SKU = $_POST["sku"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $type = $_POST["productType"];
    // var_dump($_POST);
    $attribute;
    // Assign submitted not null attribute(s)  
    if ($_POST['size'] != NULL) {
        $attribute = $_POST["size"];         
    }else if ($_POST['weight'] != NULL) {
        $attribute = $_POST["weight"];     
    }else if ($_POST['width'] != NULL && $_POST['length'] != NULL && $_POST['height'] != NULL) {
        $attribute = [$_POST["height"], $_POST["width"], $_POST["length"]];
    }

    echo $SKU;
    echo $name;
    echo $price;
    echo $type;
    echo $attribute ."<br/>";
    var_dump($_POST);

    // Default input array
    $defaultInput = [$SKU, $name, $price, $type];

    echo "<br/> default input is ".$defaultInput ;

    // Error checking array
    $errors = [
        "emptyError" => "false",
        "skuExisting" => "false",
        "invalidSku" => "false",
        "invalidName" => "false",
        "invalidPrice" => "false",
        "invalidAttribute" => "false"
    ];
    // Successful submission variable
    $submitFlag = false;
    echo "<br> after vardump " .$errors["emptyError"];
    foreach ($defaultInput as $key => $value) {
            echo "<br/>".$key."-> ".$value;
        }

    echo"<br/>/////////////////////////////////";

    foreach ($defaultInput as $key => $value) {
        echo" in loop";
        if (empty($value) && !is_numeric($value)) {
            echo "<br/>". $key ."-> ". $value ." is true";
        }
        
    }

    echo "<br> loop end <br/>";
    echo "<br> after vardump " .$errors["emptyError"];

    // Check if any of the default values is empty
    if(isEmpty($defaultInput)){
        $errors["emptyError"] = true;
    }
    echo "<br> after default input check " .$errors["emptyError"];

    // Check if any of the attributes is empty
    if(isEmpty($attribute)){
        $errors["emptyError"] = true;
    }
    echo "<br> after attr check " .$errors["emptyError"];
    echo "<br>" .$errors["emptyError"];
    
    //Check if SKU pattern is valid
    if (checkPattern($SKU, "SKU")) {
        $errors["invalidSku"] = true;
    }
    echo "<br> invalid sku check " .$errors["invalidSku"];

    //Check if name pattern is valid
    if (checkPattern($name, "name")) {
        $errors["invalidName"] = true;
    }

    echo "<br> invalidName check " .$errors["invalidName"];

    //Check if price is float and greater than or equal zero
    if(isFloat($price)) {
        $errors["invalidPrice"] = true;
    }
    echo "<br> <br>price -> ". $price;
    echo "<br> invalidPrice check " .$errors["invalidPrice"]."<br><br>";
    
    //Check if type-specific attribute(s) value(s) is float and greater than or equal zero
    if (isFloat($attribute)) {
        $errors["invalidAttribute"] = true;
    }
    echo "<br> attribute -> ". $attribute;
    echo "<br> #### invalidAttribute check is " .$errors["invalidAttribute"]."<br><br>";
    
    $errorFlag = checkErrorsArray( $errors);

    $errorFlag = false;
    foreach ($errors as $key => $value) {
        if ($value === true ) {
            $errorFlag = true;
            echo "<br> Error Values -> " .$key." -> ".$value;
            break;
        }
    }
    echo "<br> errors flag is ". $errorFlag;
    
    // Check if there are any errors 
    if (!$errorFlag) {
        echo "<br> in product init condition";
        //Initialization the ProductController to add product 
        $newProduct = new ProductController();

        echo "<br> after creating new product";
        //Check if SKU is duplicated
        $errors["skuExisting"] = $newProduct->skuExists($SKU);

        echo "<br> sku in db check ".$errors["skuExisting"];
        $errorFlag = checkErrorsArray( $errors);

        // Recheck if there are any errors 
        if (!$errorFlag){
            echo "<br> in second error check condition ";

            //Save submission success or failure status to use for redirection in Ajax
            // $submitFlag = ($newProduct->addProduct($SKU, $name, $price, $type, $attribute));
            echo "<br> after submit flag and flag  -> ".$submitFlag;

            //Executing the add product
            $newProduct->addProduct($SKU, $name, $price, $type, $attribute);
            $submitFlag= true;
            echo "<br> after adding product to new product";

        }
    } 


    echo "<br> Error Values Errors array   ";
    foreach ($errors as $key => $value) {
        if ($value === true ) {
            
            echo "<br> Error Values -> " .$key." -> ".$value;
            
        }
    }

}
?>
<!-- <script>
     var emptyError = "<?php echo $errors["emptyError"]; ?>"
    var skuExisting = "<?php echo $errors["skuExisting"]; ?>"
    alert(emptyError);
    alert(skuExisting);
</script> -->

<script> 
    //Ajax script to return errors if found

    //Resetting error classes
    $("#sku, #name, #productType, #price, .detail").removeClass("inputError");
    $("#skuErrorMsg, #nameErrorMsg, #priceErrorMsg, .detailErrorMsg").empty();
    $(".errorMessage").removeClass("errorFormat");

    //Defining error variables
    var emptyError = "<?php echo $errors["emptyError"]; ?>"
    var skuExisting = "<?php echo $errors["skuExisting"]; ?>"
    var invalidSKU = "<?php echo $errors["invalidSku"]; ?>"
    var invalidName = "<?php echo $errors["invalidName"]; ?>"
    var invalidPrice = "<?php echo $errors["invalidPrice"]; ?>"
    var invalidAttribute = "<?php echo $errors["invalidAttribute"]; ?>"
    var submitFlag = "<?php echo $submitFlag; ?>"

    // alert(emptyError);

    if (emptyError == true ) {

        $("#sku, #name, #productType, #price, .attributes").addClass("inputError");
        $(".errorMessage").append("<?php echo "Please, submit required data." ?>");
        $(".errorMessage").addClass("errorFormat");

    } else if (emptyError != true){
        
        if (invalidSKU == true){
            // alert("sku invalid");
            $("#sku").addClass("inputError");
            $("#skuErrorMsg").append("<?php echo "SKU should be minimum of 8 characters of letters or number only." ?>");
        }
        
        if (skuExisting == true){
            // alert("sku in db");
            $("#sku").addClass("inputError");
            $("#skuErrorMsg").append("<?php echo "This SKU is duplicated." ?>");
        }

        if (invalidName == true){
            $("#name").addClass("inputError");
            $("#nameErrorMsg").append("<?php echo "Name should be at least 2 characters of letters or number only." ?>");
        }

        if (invalidPrice == true){
            $("#price").addClass("inputError");
            $("#priceErrorMsg").append("<?php echo "Please, provide a correct price value." ?>");
        } 

        if (invalidAttribute == true){
            $(".detail").addClass("inputError");
            $(".detailErrorMsg").append("<?php echo "Please, provide a correct value." ?>");
        }

        if (skuExisting || invalidSKU || invalidName || invalidPrice || invalidAttribute) {
            $(".errorMessage").append("<?php echo "Please, provide the data of indicated type." ?>");
            $(".errorMessage").addClass("errorFormat");
        }
    }

    // if(submitFlag){
    //     $("#sku, #name, #productType, #price, .detail").val("");
    // }

</script>