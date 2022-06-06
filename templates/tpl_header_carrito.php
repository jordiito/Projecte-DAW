<?php
print_r($_SESSION['cart']);
print_r($_COOKIE['cart']);
?>

<div id="carrito">
    <?php
    
    if (isset($_COOKIE['cart'])) {
		$arr = json_decode(($_COOKIE['cart']), true);
        print_r($arr);
        echo "
    <p>(" . count($arr) . ") Producte";
        if (count($arr) > 1) {
            echo "s";
        }
        echo " al carretó</p>
    <table id='taulacarreto'>
        <tbody>";

        foreach ($arr as $prod) {
            echo "
                    <tr id=$prod[product_id]>
                        <td>
                            <img src='productes/$prod[product_img]' class='imgCarreto' />
                        </td>
                        <td>
                            <span>$prod[product_name]</span>
                        </td>
                        <td>
                            <input name='nom' id='producteid' type='number' min='0' value='0' />
                        </td>
                        <td>
                            <span>$prod[product_price]€</span>
                        </td>
                    </tr>";
        }
    }

    ?>
    </tbody>
    </table>
</div>