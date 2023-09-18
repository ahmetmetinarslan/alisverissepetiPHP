<?php
session_start();
if (isset($_SESSION["shoppingCart"])) {

    $shoppingCart = $_SESSION["shoppingCart"];

    $total_count = $shoppingCart["summary"]["total_count"];
    $total_price = $shoppingCart["summary"]["total_price"];
    $shopping_products = $shoppingCart["products"];
} else {
    $total_count = 0;
    $total_price = 0.0;
}
?>

<!------------------------------- header ----------------------------------------------->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> A Market</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- nav links, forms, and other  -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link custom-active" aria-current="page" href="index.php">Ürünler</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="shopping-cart.php">
                        <button type="button" class="btn btn-primary">
                            <span class="bi bi-cart" style="font-size: 20px;"></span>
                            <span class="badge text-bg-danger cart-count">
                                <?php echo $total_count; ?>
                            </span>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>