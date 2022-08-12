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

arrUl.forEach((a, i) => {
    a.addEventListener('click', (event) => {
        event.stopPropagation()
        arrDiv[i].classList.remove('t-inactive')
        const arrResto = arrDiv.filter(div => div != arrDiv[i])
        arrResto.forEach(caja => {
            caja.classList.add('t-inactive')
        })
    })
})

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

