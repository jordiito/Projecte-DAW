/* menu hamburguesa categories */

window.onload = function() {
    document.getElementById("carreto").addEventListener("click", function(e) {
        var carreto = document.getElementById("carrito");
        if (carreto.style.display != "none") {
            carreto.style.display = "none";
        } else {
            carreto.style.display = "block";
        }
    });
    document.getElementById("catboto").addEventListener("click", function(e) {
        var cat = document.getElementById("categories");
        if (cat.style.display != "none") {
            cat.style.display = "none";
        } else {
            cat.style.display = "block";
        }
    });

    document.getElementById("catmenu").addEventListener("click", function(e) {
        console.log(screen.width)
        var menu = document.getElementById("menu");
        if (menu.style.display != "none") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }

    });



    $('.toggleSeccio').click(function(e) {
        e.preventDefault();
        console.log('hola');
        $(this).next("ul").toggleClass("show");
      });

    function ocultarHamburger(x) {
        if (x.matches) {
            var menu = document.getElementById('menu');
            menu.style.display = 'inline-block';
        }
    }
    var x = window.matchMedia("(min-width: 767px)");
    ocultarHamburger(x);
    x.addListener(ocultarHamburger);
};