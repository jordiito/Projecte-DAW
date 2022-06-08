<?php

class CarretoController extends Controller
{

    public function __construct()
    {
        parent::__construct();
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
        header("Location: index.php");
        exit();
    }
    

    public function operacions()
    {
        if (isset($_POST['clear'])) {
            unset($_SESSION['cart']);
        }

        if (isset($_POST['updatecart'])) {
            foreach ($_POST['qty'] as $id => $quantitat) {
                $column = array_column($_SESSION['cart'], 'product_id');
                $found_key = array_search($id, $column);
                $_SESSION['cart'][$found_key]['product_qty'] = $quantitat;
            }
        }

        if (isset($_POST['remove'])) {
            if (count($_SESSION['cart']) > 1) {
                $column = array_column($_SESSION['cart'], 'product_id');
                $found_key = array_search($_POST['remove'], $column);
                array_splice($_SESSION['cart'], $found_key, 1);
            } else {
                unset($_SESSION['cart']);
            }
        }

        if (isset($_POST['comprar'])) {
            if (isset($_SESSION['loggedin'])) { 
            $mComanda = new ComandaModelo();
            $this->comanda = new Comanda();
            $this->comanda->setUserId($this->sanitize($_SESSION['user_id']));
            $this->comanda->setPagamentId($this->sanitize('1234'));
            $mComanda->save($this->comanda);
            $ultComanda = $mComanda->getLastId();
            $productoscarrito = $_SESSION['cart'];
            foreach ($productoscarrito as $prod) {
                $subTotal = ($prod['product_price'] * $prod['product_qty']);
                $mDetallsComanda = new DetallsComandaModelo();
                $this->detallsComanda = new DetallsComanda();
                $this->detallsComanda->setProducteId($this->sanitize($prod['product_id']));
                $this->detallsComanda->setComandaId($ultComanda);
                $this->detallsComanda->setQuantitat($this->sanitize($prod['product_qty']));
                $this->detallsComanda->setPreu($this->sanitize($prod['product_price']));
                $this->detallsComanda->setSubtotal($subTotal);
                $mDetallsComanda->save($this->detallsComanda);
                echo $subTotal;
            }
      
            unset($_SESSION['cart']);
            
              
        } else {
            $vUser = new UsuarioView();
            $vUser->login();
        }
        }

        header("Location: index.php");
        exit();
    }
}
