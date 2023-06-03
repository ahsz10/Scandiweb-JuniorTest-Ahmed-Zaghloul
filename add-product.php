<?php
    include("assets/pageTitleAdd.php"); 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo"$page_title"?></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css">
  </head>
    <body>

        <div class="header">
            <h2 style="text-align: center; font-size: 5rem;">Add Product</h2>
        </div>

        <hr>
        <div class="body">
            <div class="container-fluid  " >
                <center><form class="form-horizontal vertical-center" method="POST" name="product_form" id="product_form" action="Private/Operations/addNewProduct.php" >
                    <p class="errorMessage"></p>
                    
                    <div class="form-group sku">
                        <label  class="col-sm-2 control-label m-0">SKU</label>
                        <div class="col-sm-6 ">
                            <input type="text" id="sku" name="sku" class="form-control" placeholder="Enter Product SKU">
                            <p class ="error" id="skuErrorMsg"></p>
                        </div>
                    </div>
                    <div class="form-group name">
                        <label  class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-6">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Product Name">
                            <p class ="error" id="nameErrorMsg"></p>
                        </div>
                    </div>
                    <div class="form-group price">
                        <label  class="col-sm-2 control-label">Price ($)</label>
                        <div class="col-sm-6">
                            <input type="text" id="price" name="price" class="form-control" placeholder="Enter Product Price">
                            <p class ="error" id="priceErrorMsg"></p>
                        </div>
                    </div>
                    <div class="form-group type">
                        <label  class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="productType" name="productType">
                                <option >Select Type</option>
                                <option value="DVD">DVD</option>
                                <option value="Book">Book</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group typeSwitch" id="DVD">
                        <label  class="col-sm-2 control-label">Size (MB)</label>
                        <div class="col-sm-6">
                            <input type="text" id="size" name="size" class="attributes form-control">
                            <p class="error detailErrorMsg"></p>
                            <p>Please provide the size of the DVD in MB.</p>
                        </div>
                    </div>
                    <div class="form-group typeSwitch" id="Book">
                        <label  class="col-sm-2 control-label">Weight (KG)</label>
                        <div class="col-sm-6">
                            <input type="text" id="weight" name="weight" class="attributes form-control">
                            <p class="error detailErrorMsg"></p>
                            <p>Please provide the weight of the book in KG.</p>
                        </div>
                    </div>
                    <div class="form-group typeSwitch" id="Furniture">
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Height (CM)</label>
                            <div class="col-sm-6">
                                <input type="text" id="height" name="height" class="attributes form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Width (CM)</label>
                            <div class="col-sm-6">
                                <input type="text" id="width" name="width" class="attributes form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">Length (CM)</label>
                            <div class="col-sm-6">
                                <input type="text" id="length" name="length" class="attributes form-control">
                                <p class="error detailErrorMsg"></p>
                                <p>Please provide the dimensions of the furniture in H x W x L format.</p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <hr>
                    
                    <div class="form-group">
                        <div class="col-sm-10 ">
                            <button type="submit" name ="save" id="save"  class="btn save-button btn-default btn-success"  >Save</button>
                            </form>
                            <!-- <button type="button"name ="cancel" id="cancel" class="btn cancel-button btn-default btn-danger" onclick="location.href='./product-list.php'" >Cancel</button> -->
                            <button type="button"name ="cancel" id="cancel" class="btn cancel-button btn-default btn-danger" onclick="location.href='./index.php'" >Cancel</button>
                        </div>
                    </div>
                </center>
           
            </div>
        </div>

        <?php include ("./assets/footer.php"); ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script src="./assets/script.js"></script>
    </body>
</html>