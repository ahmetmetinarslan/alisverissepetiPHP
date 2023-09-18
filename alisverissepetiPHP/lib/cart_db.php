<?php include "db.php";
session_start();

function addToCart($product_item)
{
    // SESSION 
    /** 
     * products
     *kedi maması....2....100....200
     * 
     */

    if (isset($_SESSION["shoppingCart"])) {

        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    } else {
        $products = array();
    }

    // adet kontrolü

    if (array_key_exists($product_item->id, $products)) {
        $products[$product_item->id]->count++;
    } else {
        $products[$product_item->id] = $product_item;
    }


    //Sepetin Hesaplanması

    $total_price = 0.0;
    $total_count = 0;

    foreach ($products as $product) {
        $product->total_price = $product->count * $product->price;
        $total_price = $total_price + $product->total_price;
        $total_count += $product->count;
    }

    $summary["total_price"] = $total_price;
    $summary["total_count"] = $total_count;

    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;

    return $total_count;
}

function removeFromCart($product_id)
{

    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = $_SESSION["shoppingCart"];
        $products = $shoppingCart["products"];
    }

    if (array_key_exists($product_id, $products)) {
        unset($products[$product_id]);
    }

    // Sepeti tekrar hesapla

    $total_price = 0.0;
    $total_count = 0;

    foreach ($products as $product) {
        $product->total_price = $product->count * $product->price;
        $total_price = $total_price + $product->total_price;
        $total_count += $product->count;
    }

    $summary["total_price"] = $total_price;
    $summary["total_count"] = $total_count;

    $_SESSION["shoppingCart"]["products"] = $products;
    $_SESSION["shoppingCart"]["summary"] = $summary;

    return true;
}

function incCount($product_id)
{
}

function decCount($product_id)
{
}



if (isset($_POST["p"])) {
    $islem = $_POST["p"];

    if ($islem == "addToCart") {
        $id = $_POST["product_id"];
        $product = $db->query("SELECT * FROM products WHERE id={$id}", PDO::FETCH_OBJ)->fetch();
        $product->count = 1;
        echo addToCart($product);
    } else if ($islem == "removeFromCart") {
        $id = $_POST["product_id"];

        echo removeFromCart($id);
    }
}


// addToCart

/**
 * urun id al
 * cart_db.php dosyasına post et.
 * veritabanınnda urunun bilgilerini al.
 * session daki sepete ekle
 * sepeti tekrar hesapla
 *  **/
