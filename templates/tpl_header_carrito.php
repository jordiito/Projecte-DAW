<div id="carrito">
    <?php
    print_r($_SESSION['cart']);
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
            echo "
                    <tr id=$prod[product_id]>
                        <td>
                            <img src='productes/$prod[product_img]' class='imgCarreto' />
                        </td>
                        <td>
                            <span>$prod[product_name]</span>
                            <form action='?url=CarretoController/remove' method='post'>
                            <button type='submit' name='remove' value=$prod[product_id]>Remove</button>
                            </form>
                        </td>
                        <td>
                            <input name='nom' id='producteid' type='number' min='0' value='$prod[product_qty]' />
                        </td>
                        <td>
                            <span>$prod[product_price]€</span>
                        </td>
                    </tr>";
        }
    } else {
        echo '<p>El carretó està buit :(</p>';
    }

    ?>
    <form action='?url=CarretoController/update' method='post'>
        <button type='submit' name='clear' value="Netejar">Netejar</button>
        <button type='submit' name='updatecart' value="Actualitzar">Actualitzar</button>
    </form>
    <button>Comprar</button>
    </tbody>
    </table>
</div>