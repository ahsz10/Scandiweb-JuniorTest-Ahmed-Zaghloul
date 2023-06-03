
<?php
  // require 'Private/Operations/autoloader.php';
  // require 'Private/Database/Connect_DB.php';
  // require 'Private/Controllers/ProductController.php';  //working
  require 'Private/View/ProductsView.php';  //working
  
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  // error_reporting(0);
  include("./assets/pageTitleView.php"); 

  $getProducts = new ProductsView();
  $products = $getProducts->displayAllProducts();

  // $getProducts = new ProductController();
  // $products = $getProducts->displayAllProducts();
  // $getProducts->displayAllProducts();
  
  // $db = new PDO('mysql:host=localhost;dbname=scandiweb_test', 'root', '');
  // $sql = "SELECT p.*, COALESCE(concat ('Weight: ', b.weight, ' KG'), concat ('Size: ', d.size, ' MB'), concat ('Dimensions: ', f.height, 'x', f.width, 'x', f.length, ' CM')) AS attributes FROM products p LEFT JOIN book b ON p.id = b.id LEFT JOIN dvd d ON p.id = d.id LEFT JOIN furniture f ON p.id=f.id ORDER BY p.id";
  // $query = $db->query($sql);
  // // $products = $query->fetchAll(PDO::FETCH_ASSOC);
  // $products = $query->fetchAll();

  // $products = [
  //   ["SKU" => "JVC200123",
  //   "name" => "disc",
  //   "price" => "10",
  //   "attributes" => "99"],
  //   ["SKU" => "fgdghjfg67687876",
  //   "name" => "disc",
  //   "price" => "10",
  //   "attributes" => "99"],
  //   ["SKU" => "JVC200123",
  //   "name" => "disc",
  //   "price" => "10",
  //   "attributes" => "99"],
  //   ["SKU" => "JVC200123",
  //   "name" => "disc",
  //   "price" => "10",
  //   "attributes" => "99"],
  //   ["SKU" => "JVC200123",
  //   "name" => "disc",
  //   "price" => "10",
  //   "attributes" => "99"],
  //   ["SKU" => "JVC200123",
  //   "name" => "disc",
  //   "price" => "10",
  //   "attributes" => "99"]
  // ];
  // var_dump($products);
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

    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            
            <a class="navbar-brand header" href="#" style="color: black;">Product List</a>
          </div>
      
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
              
              <li class="navbar-form navbar-left">
                <button class="btn btn-default add-button btn-primary" id="ADD" onclick="location.href='./add-product.php'">ADD</button>
              </li>
              <!--  -->
              <form action="Private/Operations/deleteProducts.php" method="POST" id="delete-form" class="navbar-form navbar-left">
                <button name="delete" id="deletebtn" class="btn btn-default delete-button btn-danger">MASS DELETE</button>
              </form>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="body2">
      <!-- <button class="btn btn-default add-button btn-primary" id="ADD" onclick="location.href='./add-product.php'">ADD</button> -->
      <div class="container-fluid " >
        <section class="cards my-3">
            <div class="row">
                <!-- for -->
                <!-- <?php foreach ($products as $product): ?> -->
                    <div class="col-lg-3 col-md-5 col-sm-6 pb-3">
                        <div class="card" >
                            <div class="card-body">
                                <input form="delete-form" type="checkbox" class="delete-checkbox m-5 " name="checked[]" value="<?= $product['sku']; ?>"></p>
                                <p class="card-text text-center "><?= $product['sku']; ?> </p>
                                <p class="card-text text-center"><?= $product['name']; ?> </p>
                                <p class="card-text text-center "><?= $product['price']; ?> $ </p>
                                <p class="card-text text-center"><?= $product['attributes']; ?> </p>
                            </div>
                        </div>
                    </div>        
                  <?php endforeach; ?>
                <!-- for end -->
            </div> 
        </section>
      </div>
    </div>
    <?php include ("./assets/footer.php"); ?>
  </body>
</html>


<!-- <script>
  // var checkboxes = document.getElementsByClassName('delete-checkbox');
  //   var count = 0;
  //   for (var i = 0; i < checkboxes.length; i++) {
  //     if (checkboxes[i].checked) {
  //       count++;
  //     }
  //   }
</script> -->


