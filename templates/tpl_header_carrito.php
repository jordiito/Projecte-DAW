<div id="carrito">
    <form action='?url=CarretoController/update' method='post'>
        <?php
        if (isset($_SESSION['cart'])) {
            $productoscarrito = $_SESSION['cart'];
            echo "
    <p>(" . count($productoscarrito) . ") Producte";
            if (count($productoscarrito) > 1) {
                echo "s";
            }
            echo " al carretó</p>
    <table id='taulacarreto'>
        <tbody>";
            $total = 0;
            foreach ($productoscarrito as $prod) {

                $preu_qty = ($prod['product_price'] * $prod['product_qty']);
                echo "
                    <tr id=$prod[product_id]>
                        <td>
                            <img src='productes/$prod[product_img]' class='imgCarreto' />
                        </td>
                        <td>
                            <span>$prod[product_name]</span>

                            <button type='submit' name='remove' value=$prod[product_id]>Eliminar</button>

                        </td>
                        <td>
                            <input name='qty[$prod[product_id]]' id='producteqty' type='number' min='0' value='$prod[product_qty]' />
                        </td>
                        <td>
                            <span>$preu_qty €</span>
                        </td>
                    </tr>";
                $total += $prod['product_qty'] * $prod['product_price'];
            }
        } else {
            echo '<p>El carretó està buit :(</p>';
        }

        ?>



        </tbody>
        </table>
        <?php if (isset($_SESSION['cart'])) {
            echo "
    <button type='submit' name='clear' value='Netejar'>Netejar</button>
    <button type='submit' name='updatecart' value='Actualitzar'>Actualitzar</button>
    <p>Import total: $total €</p>
    <button>Comprar</button>";
        } ?>
    </form>
</div>