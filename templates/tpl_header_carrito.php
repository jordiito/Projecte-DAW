
<div id="carrito">
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
        echo "
                    <tr id=$prod[product_id]>
                        <td>
                            <img src='productes/$prod[product_img]' class='imgCarreto' />
                        </td>
                        <td>
                            <span>$prod[product_name]</span>
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