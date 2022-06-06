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

        foreach ($productoscarrito as $prod) {
            $preu_qty = ($prod['product_price']*$prod['product_qty']);
            echo "
                    <tr id=$prod[product_id]>
                        <td>
                            <img src='productes/$prod[product_img]' class='imgCarreto' />
                        </td>
                        <td>
                            <span>$prod[product_name]</span>
                            <form action='?url=CarretoController/remove' method='post'>
                            <button type='submit' name='remove' value=$prod[product_id]>Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <input name='qty[$prod[product_id]]' id='producteqty' type='number' min='0' value='$prod[product_qty]' />
                        </td>
                        <td>
                            <span>$preu_qty €</span>
                        </td>
                    </tr>";
        }
    } else {
        echo '<p>El carretó està buit :(</p>';
    }
    ?>

        <button type='submit' name='clear' value="Netejar">Netejar</button>
        <button type='submit' name='updatecart' value="Actualitzar">Actualitzar</button>
    </form>
    <button>Comprar</button>
    </tbody>
    </table>
</div>