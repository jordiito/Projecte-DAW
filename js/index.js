/* menu hamburguesa, etc a totes les pagines*/

window.onload = function() {

    // El menu esta tancat al carregar la pagina en mobile
    var widthInicial = window.innerWidth;
    if (widthInicial <= 999) {
        menu.style.display = 'none';
    }

    // Al redimensionar es torna a mostrar
    function reportWindowSize() {
        var width = window.innerWidth;
        if (width > 999) {
            menu.style.display = 'inline-block';
        }
    }
    window.onresize = reportWindowSize;

    // Display del carreto
    document.getElementById("carreto").addEventListener("click", function(e) {
        var carreto = document.getElementById("carrito");
        if (carreto.style.display != "none") {
            carreto.style.display = "none";
        } else {
            carreto.style.display = "block";
        }
    });

    // Display del menu
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