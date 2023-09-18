<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi</title>
    <!-- <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/assets/custom.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <?php require_once "./lib/db.php"; ?>

    <?php
    // Verileri Çekme Bölümü

    $products = $db->query("SELECT * from products", PDO::FETCH_OBJ)->fetchALL();

    ?>

    <!------------------------------- header --------------------------------------->
    <?php include "lib/navbar.php"; ?>
    <!------------------------------- #header --------------------------------------->

    <!------------------------ Main Content ------------------>
    <div class="container">
        <h2 class="text-center mt-3"><strong>Ürün Listesi</strong></h2>
        <hr>
        <div class="row">

            <?php
            foreach ($products as $product) { ?>

                <div class="col-sm-6 col-md-4">
                    <div class="card mt-3" style="width: 18rem;">
                        <img src="<?php echo $product->img_url; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product->product_name; ?></h5>
                            <p class="card-text"><?php echo $product->detail; ?></p>
                            <p class="float-end mt-0"><strong><?php echo $product->price; ?> TL</strong></p>

                            <button product-id="<?php echo $product->id; ?>" class="btn btn-primary addToCartBtn w-100" role="button"><span class="bi bi-cart" style="font-size: 20px;"></span> Sepete Ekle</button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!------------------------ #Main Content ------------------>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- <script src="/node_modules/jquery/dist/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <!-- <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <!-- <script src="/assets/custom.js"></script> -->
    <script>
        $(document).ready(function() {
            $(".addToCartBtn").click(function() {


                var url = "http://localhost/alisverissepetiPHP/lib/cart_db.php";
                var data = {
                    p: "addToCart",
                    product_id: $(this).attr("product-id"),
                }



                $.post(url, data, function(response) {
                    $(".cart-count").text(response);
                })
            });
        });
    </script>
</body>

</html>