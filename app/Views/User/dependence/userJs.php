<script>
    window.addEventListener('load', (e) => {
        e.stopPropagation();

        const toastr = (info, text, item) => {
            return $.NotificationApp.send(
                `${info}!`,
                `${text}.`,
                "top-right",
                "rgba(0,0,0,0.2)",
                `${item}`
            );
        }

        const div_solicitudes = document.querySelector('#solicitudes')
        const formComent = document.querySelector('#form-comment')

        const sendComment = async (formData) => {
            const post = await fetch('<?= base_url('/commentSave')?>', { method: "POST", body: formData})
            const resPost = await post.text()
            if(resPost === "1") toastr("Acepatada", "El comentario ha sido enviado satisfactoriamente", "success")
        }

        formComent.addEventListener('submit', (e)=>{
            e.preventDefault()
            const {identificador, subject, comment} = e.target
            const formData = new FormData()
            formData.append('id', identificador.value)
            formData.append('subject', subject.value)
            formData.append('comment', comment.value)

            sendComment(formData)
        })

        let id = 0
        const getBooksSales = async (libros) => {
            const fd_libros = new FormData()
            fd_libros.append('libros', libros)
            const postLibros = await fetch('<?= base_url('/librosSales') ?>', {
                method: "POST",
                body: fd_libros
            })
            const resPostLibros = await postLibros.json()
            return resPostLibros
        }

        const icons_condition = async (status, ico, span, libros, fecha_set, fecha_ok, small_date) => {
            const array_libros = await getBooksSales(libros)

            if (status === "0") {
                ico.classList.add("mdi", "mdi-timer-sand", "text-warning", "font-18")
                span.textContent = " Esperando ser atendido "
                small_date.textContent = fecha_set + " | Libros: " + array_libros.map(title => title)
            }

            if (status === "1") {
                ico.classList.add("mdi", "mdi-account-cash", "text-success", "font-18")
                span.textContent = " Pagado "
                small_date.textContent = fecha_ok + " | Libros: " + array_libros.map(title => title)
            }

            if (status === "3") {
                ico.classList.add("mdi", "mdi-check-outline", "text-primary", "font-18")
                span.textContent = " Aprobado "
                small_date.textContent = fecha_ok + " | Libros: " + array_libros.map(title => title)
            }

            if (status === "2") {
                ico.classList.add("mdi", "mdi-cancel", "text-danger", "font-18")
                span.textContent = " Orden cancelada, contactenos"
                small_date.textContent = fecha_set + " | Libros: " + array_libros.map(title => title)
            }
        }

        const ordenes = (orders) => {

            orders.map(order => {
                const container = document.createElement('div')
                const div_ico = document.createElement('div')
                const div_description = document.createElement('div')
                const div_price = document.createElement('div')

                const ico = document.createElement("i")
                const a_description = document.createElement('a')
                const span_descrition = document.createElement('span')
                const span_price = document.createElement('span')
                const p_description = document.createElement('p')
                const s_date = document.createElement('small')
                container.classList.add("row", "py-1", "align-items-center")
                div_ico.classList.add('col-auto')
                div_description.classList.add("col", "ps-0")
                div_price.classList.add('col-auto')
                a_description.classList.add('text-body', 'fw-bold', 'a_list')
                p_description.classList.add('mb-0', 'text-muted')
                span_price.classList.add('text-info', 'fw-bold', 'pe-2')

                icons_condition(
                    order.condition,
                    ico,
                    span_descrition,
                    order.libros_id,
                    order.fecha_solicitud,
                    order.fecha_aprobado,
                    s_date
                )

                // s_date.textContent = order.fecha_solicitud
                a_description.textContent = "BM" + order.id
                span_price.textContent = "$" + order.pay

                div_ico.appendChild(ico)
                div_description.appendChild(a_description)
                div_description.appendChild(span_descrition)
                p_description.appendChild(s_date)
                div_description.appendChild(p_description)
                div_price.appendChild(span_price)
                container.appendChild(div_ico)
                container.appendChild(div_description)
                container.appendChild(div_price)

                div_solicitudes.appendChild(container)
            })
        }

        const postOrder = async (formData) => {

            const postOrden = await fetch('<?php echo base_url('/p_order') ?>', {
                method: "POST",
                body: formData
            })
            const resOrden = await postOrden.json()
            console.log(resOrden)

            ordenes(resOrden)
        }

        const tableReceived = (item) => {
            $('#books-borrowed').DataTable({
                ajax: {
                    "url": "<?php echo base_url('/libXid'); ?>",
                    "method": "POST",
                    "data": {
                        item: item
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
            })
        }

        const setUser = (res) => {
            document.querySelector('#idname').innerHTML = "Bienvenido " + res[0].toLowerCase() + " " + res[1].toLowerCase()
            id = res[2]

            document.querySelector('#identificador').value = id

            const fid = new FormData()
            fid.append('id', id)

            postOrder(fid)

            tableReceived(id)
        }


        const getDataUser = async () => {
            const postUser = await fetch('<?php echo base_url('/nombre'); ?>', {
                method: 'POST'
            });
            const r = await postUser.json();
            setUser(r)
        }

        getDataUser()

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

            await sendOrder(sumaTotal, libros, parseInt(id))

            //sendOrder(sumaTotal, libros, id__std)
        })


    })
</script>