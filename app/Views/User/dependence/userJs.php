<script>
    window.addEventListener('load', (e) => {
        e.stopPropagation();

        let id__std = 0

        fetch('<?php echo base_url('/nombre'); ?>', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(r => {
                document.querySelector('#idname').innerHTML = "Bienvenido " + r[0].toLowerCase() + " " + r[1].toLowerCase()
                id = r[2]

                console.log(id);

                let tableEntregaID = $('#books-borrowed').DataTable({
                    ajax: {
                        "url": "<?php echo base_url('/libXid'); ?>",
                        "method": "POST",
                        "data": {
                            id: id
                        }
                    },
                    columns: [{
                            "data": "portada",
                            "render": function(name) {
                                return `<img src="${base__url}/uploads/${name}" width="50" alt="portadas">`
                            }
                        },
                        {
                            "data": "titulo"
                        },
                        {
                            "data": "autor"
                        },
                        {
                            "data": "entrega"
                        },
                        {
                            "data": "devolucion"
                        }
                    ],
                    "language": {
                        "url": "assets/json/Spanish.json"
                    }
                });
            });

        document.querySelector('#salir').addEventListener('click', () => {
            fetch('<?php echo base_url('/logoff'); ?>', {
                method: 'POST'
            })
        });

        const base__url = document.querySelector('#baseUrl').value;
        const btn_generar = document.querySelector('#btn_gn');
        const a_pagar = document.querySelector('#pagar');

        a_pagar.innerHTML = "0.00";

        /** ELIMINA LOS DUPLICADOS */
        const del_dupli = (arr) => {
            return arr.filter((v, i) => {
                return arr.indexOf(v) === i
            })
        }

        let accion = "listarLibro";
        let tableBooks = $('#books-disponibles').DataTable({
            ajax: {
                "url": "<?php echo base_url('/libros__disponibles'); ?>",
                "method": "POST",
                "data": {
                    accion: accion
                }
            },
            columns: [{
                    "data": "id_book",
                    "render": function(data) {
                        return `<div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="${data}" disabled>
                                    <label class="form-check-label" for="${data}">&nbsp;</label>
                                </div>`
                    }
                },
                {
                    "data": "portada",
                    "render": function(data) {
                        return `<img src="${base__url}/uploads/${data}" width="50" alt="portadas">`
                    }
                },
                {
                    "data": "titulo"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "autor"
                }
            ],
            "language": {
                "url": "assets/json/Spanish.json"
            },
        });

        let sumaTotal = 0;

        const sumar = (price) => {
            return sumaTotal += price
        }

        const restar = (price) => {
            return sumaTotal -= price
        }



        $("#books-disponibles tbody").on('click', 'tr', function() {
            // Obtengo la fila
            var data2 = tableBooks.row(this).data();
            //console.log(data2.id_book);

            // Obtengo el checkBox
            var check = $(`#${data2.id_book}`);

            /**
             * Buena!
             */
            if (!check.prop('checked') === true) {
                var check = $(`#${data2.id_book}`).prop("checked", true);
                sumar(parseFloat(data2.precio))
                a_pagar.innerHTML = sumaTotal.toFixed(2)
            } else {
                var check = $(`#${data2.id_book}`).prop("checked", false);
                restar(parseFloat(data2.precio))
                a_pagar.innerHTML = sumaTotal.toFixed(2)
            }
        });

        const toastr = (info, text, item) => {
            return $.NotificationApp.send(
                `${info}!`,
                `${text}.`,
                "top-right",
                "rgba(0,0,0,0.2)",
                `${item}`
            );
        }

        const sendOrder = async (cont, books, id) => {
            try {
                if (books.length !== 0) {
                    data = new FormData()
                    data.append('fk_estudiante', id)
                    data.append('libros[]', books)
                    data.append('pay', cont.toFixed(2))
                    const postOrder = await fetch('<?= base_url('/orders') ?>', {
                        method: "POST",
                        body: data
                    })
                    const resPostOrder = await postOrder.text()
                    console.log(resPostOrder);
                    if (resPostOrder === "1") {
                        toastr("Info", "La orden ha sido creada", "success")
                    } else
                        toastr("Alert", "Ha excedido el limite de ordenes!", "error")

                } else {
                    toastr("Alert", "No ha seleccionado ningun libro", "warning")
                }

            } catch (error) {
                console.log(error);
            }
        }

        btn_generar.addEventListener('click', () => {
            document.querySelector('#cuenta').innerHTML = sumaTotal.toFixed(2)
        })



        document.querySelector('#modal').addEventListener('click', async (e) => {
            e.stopPropagation()
            let libros = []

            const trs = document.querySelectorAll('#books-disponibles tbody tr');

            arrTrs = [...trs]

            await arrTrs.map(tr => {
                const checkBox = [
                    [tr][0].children[0]
                ][0].children[0].children[0]
                if (checkBox.checked !== false) {
                    libros.push(checkBox.id)
                }
            })

            await sendOrder(sumaTotal, libros, parseInt(id__std))

            //sendOrder(sumaTotal, libros, id__std)
        })

    })
</script>