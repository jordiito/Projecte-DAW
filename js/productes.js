fetch('http://localhost/botigaup/productes.php', {
    headers: {
        'Accept': 'application/json'
    }
})
    .then(response => response.json())
    .then(data => printData(data))

let printData = (data) => {
    let html = "";
    for (var i = 0; i < data.length; i++) {
        html+=
            '<div class="producte">'+
                '<a href="index.php?url=ProducteController/show&amp;p='+data[i].id+'">'+data[i].nom+'</a>'+
                '<img src="productes/'+data[i].imatge+'">'+
                '<p>'+data[i].preu+'€ (IVA inclòs)</p>'+
                '<button>Afegir al carretó</button>'+
            '</div>'
           // alert('<img src="/productes/'+data[i].imatge+'">');
    }
    document.getElementById("productes").innerHTML+=html;

}
