<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sepetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        td {
            vertical-align: middle !important;
        }

        tfoot th {
            padding: 20px !important;
            background-color: #dfdfdf !important;
        }
    </style>
</head>

<body>


    <!-- <?php
            if (isset($_SESSION["shoppingCart"])) {
                $shoppingCart = $_SESSION["shoppingCart"];
                $total_count = $shoppingCart["summary"]["total_count"];
                $total_price = $shoppingCart["summary"]["total_price"];
            } else {
                $total_count = 0;
                $total_price = 0.0;
            }
            ?> -->
    <!------------------------------- header --------------------------------------->
    <?php include "lib/navbar.php"; ?>
    <!------------------------------- #header --------------------------------------->
    <!----------------------------- Main Content ------------------------------------->
    <div class="container mt-5">

        <?php if ($total_count > 0) { ?>
            <h2 class="text-center">Sepetinizde <strong class="text-danger"><?php echo $total_count; ?></strong> adet ürün bulunmaktadır</h2>
            <hr>
            <div class="row">
                <div class="col-md-8 mx-auto mt-5">
                    <table class="table table-hover table-bordered table-stripped">
                        <thead>
                            <th class="text-center">Ürün Resmi</th>
                            <th class="text-center">Ürün Adı</th>
                            <th class="text-center">Ürün Fiyatı</th>
                            <th class="text-center">Ürün Adeti</th>
                            <th class="text-center">Toplam</th>
                            <th class="text-center">Sepetten Çıkar</th>
                        </thead>
                        <tbody>
                            <?php foreach ($shopping_products as $product) { ?>
                                <tr>
                                    <td class="text-center" style="width: 120px;">
                                        <img src="https://www.mamacadiri.com/exclusion-dusuk-tahilli-monoprotein-ton-balikli-yetiskin-kedi-mamasi-yetiskin-kedi-mamasi1-7-yas-exclusion-171-88-K.png" width="50px">
                                    </td>
                                    <td class="text-center"><?php echo $product->product_name; ?>
                                    </td>
                                    <td class="text-center"><strong><?php echo $product->price; ?>TL</strong></td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-success"><i class="bi bi-plus-circle"></i></a>
                                        <input type="text" class="item-count-input mt-0" style="width: 50px;   text-align:center;" value="<?php echo $product->count; ?>">
                                        <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-dash-circle"></i></a>

                                    </td>
                                    <td class="text-center"><?php echo $product->total_price; ?>TL</td>
                                    <td class="text-center" style="width: 150px;">
                                        <button product_id="<?php echo $product->id; ?>" class="btn btn-danger btn-sm removeFromCartBtn">
                                            <i class="bi bi-x-circle"></i>
                                            Sepetten Çıkar</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th colspan="2" class="text-end">
                                Toplam Ürün: <span class="text-danger"><?php echo $total_count; ?></span>
                            </th>
                            <th colspan="4" class="text-end">
                                Toplam Tutar: <span class="text-danger"><?php echo $total_price; ?>TL</span>
                            </th>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php } else { ?>

            <div class="alert alert-info">
                <strong>Sepetinizde henüz bir ürün bulunmamaktadır. Eklemek için <a href="index.php">tıklayınız.</a></strong>
            </div>

        <?php } ?>
    </div>
    <!---------------------------- #Main Content ------------------------------------->



    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <script src="assets/custom.js"></script>
    <script>
        // J-QUERY
        $(".addToCartBtn").click(function() {

            var url = "http://localhost/alisverissepetiPHP/lib/cart_db.php";
            var data = {
                p: "addToCart",
                product_id: $(this).attr("product-id")
            }

            $.post(url, data, function(response) {
                $(".cart-count").text(response);
            })

        })

        // VANILLA-JS

        // document.addEventListener("DOMContentLoaded", function() {
        //     var addToCartButtons = document.querySelectorAll(".addToCartBtn");

        //     addToCartButtons.forEach(function(button) {
        //         button.addEventListener("click", function() {
        //             alert("Ürün sepetinize eklendi.");
        //         });
        //     });
        // });

        // J-QUERY
        $(".removeFromCartBtn").click(function() {

            var url = "http://localhost/alisverissepetiPHP/lib/cart_db.php";
            var data = {
                p: "removeFromCart",
                product_id: $(this).attr("product-id")
            }

            $.post(url, data, function(response) {
                window.location.reload();
            })

        })

        // VANILLA-JS
        // document.addEventListener("DOMContentLoaded", function() {
        //     var removeFromCartBtn = document.querySelectorAll(".removeFromCartBtn");

        //     removeFromCartBtn.forEach(function(button) {
        //         button.addEventListener("click", function() {});
        //     });
        // });
    </script>
</body>

</html>