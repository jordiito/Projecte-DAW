const queryString = window.location.search;
console.log(queryString);
const urlParams = new URLSearchParams(queryString);
const product = urlParams.get('p')
console.log(product);
alert(product)
fetch('http://localhost/botigaup/productes.php', {
    headers: {
        'Accept': 'application/json'
    }
})
    .then(response => response.json())
    .then(data => printProducte(data))

let printProducte = (data) => {
    for (var i = 0; i < data.length; i++) {
        let html='';
        if (data[i].id == product) {
           //alert(data[i].id);
           html+='<p>'+data[i].id+'</p>'+
           '<p>'+data[i].nom+'</p>'+
           '<img src="productes/'+data[i].imatge+'">';
           document.getElementById("asd").innerHTML+=html;
        }
    }

}
