<?php

class CarretoController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $carreto = new CarretoController();
        $carreto->show();
    }

    public function add()
    {
        if (isset($_POST['add_to_cart'])) {
            $products_array = array(
                'product_id' => $_POST['add_to_cart'],
                'product_name' => $_POST['nom'],
                'product_price' => $_POST['preu'],
                'product_img' => $_POST['img'],
                'product_qty' => isset($_POST['qty']) ? $_POST['qty'] : 1
            );
        }
        if (isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], "product_id");
            if (!in_array($_POST['add_to_cart'], $item_array_id)) {
                $count = count($_SESSION['cart']);

                $_SESSION["cart"][$count] = $products_array;
            } else {
                echo '<script>alert("Aquest producte ja esta al teu carreto, pots augmentar la quantitat accedint a ell")</script>';
            }
        } else {
            $products_array = array(
                'product_id' => $_POST['add_to_cart'],
                'product_name' => $_POST['nom'],
                'product_price' => $_POST['preu'],
                'product_img' => $_POST['img'],
                'product_qty' => 1
            );
            $_SESSION["cart"][0] = $products_array;
        }
        header("Location: http://localhost/projecte-daw/index.php");
        exit();
    }

    public function update()
    {
        if (isset($_POST['clear'])) {
            unset($_SESSION['cart']);
        }

        if (isset($_POST['updatecart'])) {
        }

        header("Location: http://localhost/projecte-daw/index.php");
    }

    public function remove()
    {
        $column = array_column($_SESSION['cart'], 'product_id');
        $found_key = array_search($_POST['remove'], $column);
        array_splice($_SESSION['cart'], $found_key, 1);
        header("Location: http://localhost/projecte-daw/index.php");
    }
}
