/* Paginado puro JS */
//console.log(...listaMenu);

let contenedorDivs = document.querySelectorAll('div .cerodiv');
let uls = document.querySelectorAll('#menu-ul a');

contenedorDivs.forEach(divs => {
    divs.classList.toggle('cerodiv')
    divs.classList.add('t-inactive')
})


const arrDiv = [...contenedorDivs]
const arrUl = [...uls]

arrDiv[0].classList.remove('t-inactive')

/*
for (let i = 0; i < arrUl.length; i++) {
    arrUl[i].addEventListener('click', (event) => {
        event.stopPropagation()
        arrDiv[i].classList.toggle('t-inactive')
        const arrResto = arrDiv.filter(div => div != arrDiv[i])
        arrResto.forEach(caja => {
            caja.classList.add('t-inactive')
        })
    })
}
*/

/* 
    console.log(arrDiv[2])
    console.log(arrUl[2]) 
*/

//console.log(arrUl.length)

arrUl.forEach((a, i) => {
    a.addEventListener('click', (event) => {
        event.stopPropagation()
        arrDiv[i].classList.toggle('t-inactive')
        const arrResto = arrDiv.filter(div => div != arrDiv[i])
        arrResto.forEach(caja => {
            caja.classList.add('t-inactive')
        })
    })
})

/*
var st = document.getElementById("estud");
st.addEventListener("click", pagEst);
function pagEst() {
    var dash = document.getElementById('dash');
    var estudiant = document.getElementById('estudiante');
    var book = document.getElementById('libros');
    var entrega = document.getElementById('entrega');
    var venta = document.getElementById('ventaB');
    entrega.style.display = 'none';
    venta.style.display = 'none';
    dash.style.display = 'none';
    estudiant.style.display = 'contents';
    book.style.display = 'none';
};


var dash = document.getElementById("panel");
dash.addEventListener("click", pagDash);
function pagDash() {
    var dash = document.getElementById('dash');
    var estudiant = document.getElementById('estudiante');
    var book = document.getElementById('libros');
    var entrega = document.getElementById('entrega');
    var venta = document.getElementById('ventaB');
    entrega.style.display = 'none';
    venta.style.display = 'none';
    dash.style.display = 'contents';
    estudiant.style.display = 'none';
    book.style.display = 'none';
};

var libro = document.getElementById("book");
libro.addEventListener("click", pagBook);
function pagBook() {
    var dash = document.getElementById('dash');
    var estudiant = document.getElementById('estudiante');
    var book = document.getElementById('libros');
    var entrega = document.getElementById('entrega');
    var venta = document.getElementById('ventaB');
    entrega.style.display = 'none';
    venta.style.display = 'none';
    book.style.display = 'contents';
    estudiant.style.display = 'none';
    dash.style.display = 'none';
};

var prestamos = document.getElementById("prestamo");
prestamos.addEventListener("click", pagPrestamo);
function pagPrestamo() {
    var dash = document.getElementById('dash');
    var estudiant = document.getElementById('estudiante');
    var book = document.getElementById('libros');
    var entrega = document.getElementById('entrega');
    var venta = document.getElementById('ventaB');
    entrega.style.display = 'contents';
    venta.style.display = 'none';
    book.style.display = 'none';
    estudiant.style.display = 'none';
    dash.style.display = 'none';
};

var ventas = document.getElementById("venta");
ventas.addEventListener("click", pagVenta);
function pagVenta() {
    var dash = document.getElementById('dash');
    var estudiant = document.getElementById('estudiante');
    var book = document.getElementById('libros');
    var entrega = document.getElementById('entrega');
    var venta = document.getElementById('ventaB');
    entrega.style.display = 'none';
    venta.style.display = 'contents';
    book.style.display = 'none';
    estudiant.style.display = 'none';
    dash.style.display = 'none';
};
//dash.style.display = 'none';
//console.log(dash);
*/