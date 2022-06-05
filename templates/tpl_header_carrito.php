<?php
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: ?page=cart');
    exit;
}
?>
     
     <div id="carrito">
            <p>(21) Producte al carretó</p>
            <table id="taulacarreto">
                <tbody>
                    <tr id="producteid">
                        <td>
                            <img src="productes/1.jpg" class="imgCarreto" />
                        </td>
                        <td>
                            <span>Ordinador portatil</span>
                        </td>
                        <td>
                            <input name="nom" id="producteid" type="number" min="0" value="0" />
                        </td>
                        <td>
                            <span>999,99€</span>
                        </td>
                    </tr>
                    <tr id="producteid">
                        <td>
                            <img src="productes/1.jpg" class="imgCarreto" />
                        </td>
                        <td>
                            <span>Ordinador portatil</span>
                        </td>
                        <td>
                            <input name="nom" id="producteid" type="number" min="0" value="0" />
                        </td>
                        <td>
                            <span>999,99€</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
