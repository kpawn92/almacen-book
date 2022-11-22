<script>
    $(document).ready(function() {
        const panelEntrega = document.querySelector('#panel-entrega');
        const panelDispo = document.querySelector('#panel-dispo');
        const listCI = document.querySelector('#load-ci');
        const genCI = document.querySelector('#g-entrega');
        const closeEntrega = document.querySelector('#close-entrega');
        const volver = document.querySelector('#load-prestamo');
        const divPrestamo = document.querySelector('#content-prestamo');
        const divDevol = document.querySelector('#devol');
        const divEntrega = document.querySelector('#entreg');
        const sendDevolution = document.querySelector('#load-devolution');
        const sendEntrega = document.getElementById('send-entrega');
        const selectEst = document.getElementById('selectCI');
        const idEst = document.querySelector('#diEstudiant');
        const formE = document.querySelector('#form-entrega');
        const formD = document.querySelector('#form-devolution');
        const contTable = document.querySelector('#prestamosBook tbody');
        const formEntrega = document.querySelector('#form-entrega');
        const divAlert = document.querySelector('#div-alertEntrega');
        const mensaje = document.querySelector('#alert-entrega');
        const selector = document.querySelector('#selector');
        const btnBorrador = document.querySelectorAll('.del-entrega');
        const divDttEntregas = document.querySelector('#dataTable-entrega');
        const urlbase = document.querySelector('#url').value

        document.getElementById('aPrestamo').classList.remove('active');

        document.querySelectorAll('.lista').forEach(li => li.style.cursor = "pointer");


        /* Funcionalidades de los <page-title-box> */
        document.querySelector('#aPrestamo').addEventListener('click', (e) => {
            e.target.classList.remove('active')
            document.querySelector('#aDispo').classList.add('active')
            panelEntrega.classList.remove('t-inactive')
            panelDispo.classList.add('t-inactive')
        });
        document.querySelector('#aDispo').addEventListener('click', (e) => {
            e.target.classList.remove('active')
            document.querySelector('#aPrestamo').classList.add('active')
            panelEntrega.classList.add('t-inactive')
            panelDispo.classList.remove('t-inactive')
            booksEntregar()
        });
        //---.
        /* Table entregas */
        let f = "listarEntregados"
        let tableEntregados = $('#prestamosBook').DataTable({

            ajax: {
                "url": "<?= base_url('/list_entrega'); ?>",
                "method": "POST",
                "data": {
                    f: f
                }
            },

            columns: [{
                    "defaultContent": `<button type="button" class="del-entrega btn btn-danger"><i class="dripicons-trash"></i></button>`
                },
                {
                    "data": "portada",
                    "render": function(data) {
                        return `<img src="${urlbase}/uploads/${data}" width="50">`
                    }
                },
                {
                    "data": "codigo"
                },
                {
                    "data": "fecha_entrega"
                },
                {
                    "data": "fecha_dev"
                },
                {
                    "data": "ci"
                },
            ],
            "language": {
                "url": "assets/json/Spanish.json"
            },
        });

        function saveImgeEntregas(uri, filename) {

            var link = document.createElement('a');

            if (typeof link.download === 'string') {

                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                document.body.appendChild(link);

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild(link);

            } else {

                window.open(uri);

            }
        }

        document.getElementById("btn-down-entrega").addEventListener("click", function() {
            html2canvas(document.querySelector('#prestamosBook')).then(function(canvas) {
                saveImgeEntregas(canvas.toDataURL(), `Libros_entregados_estudiante_${selectEst.value}.png`);
            });
        });


        /* Reload table */
        function reoladTbentrega() {
            setTimeout(function() {
                tableEntregados.ajax.reload();
            }, 500);
        };

        /* Get CI */
        const identidades = () => {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('/ci') ?>',
                success: function(response) {
                    $("#selectCI").html(response).fadeIn();
                }
            });
        }

        /* Libros a entregar */
        const booksEntregar = () => {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('/books'); ?>',
                success: function(res) {
                    $("#idLibro").html(res).fadeIn();
                    $("#idL").html(res).fadeIn();
                }
            });
        }

        const librosDisponibles = () => {
            document.querySelector('#t-libros').innerHTML = "";

            fetch("<?php echo base_url('/tb_dispo') ?>", {
                    method: "POST"
                })
                .then(data => data.json())
                .then(dato => {
                    let tableDispo = document.querySelector('#tb-dispo tbody');
                    tableDispo.innerHTML = "";
                    document.querySelector('#t-libros').innerHTML = "0";
                    // Suma de los disponibles asignados;
                    const sumaTotal = dato.map(item => parseInt(item.c_disponibles, 10)).reduce((prev, curr) => prev + curr, 0);
                    //... 
                    let precios = 0;
                    dato.forEach(element => {
                        let total = element.precio * element.c_disponibles
                        tableDispo.innerHTML += `<tr>
                                                <td>${element.titulo}</td>
                                                <td>$${element.precio}</td>
                                                <td><span class="badge bg-primary">${element.c_disponibles} disponibles</span></td>
                                                <td>$${total.toFixed(2)}</td>
                                            </tr>`;
                        precios += total
                    });
                    document.querySelector('#t-libros').innerHTML = sumaTotal;
                    document.querySelector('#t-recauda').innerHTML = "$" + precios.toFixed(2);
                });
        }

        booksEntregar();
        librosDisponibles();

        /* Form disponibility */
        document.querySelector('#formDispo').addEventListener('submit', (e) => {
            e.preventDefault()
            //console.log(e.target.cantidadL.value)

            let fD = new FormData();
            fD.append('fk_libro', e.target.idL.value);
            fD.append('c_disponibles', e.target.cantidadL.value);

            fetch("<?php echo base_url('/dispo') ?>", {
                method: "POST",
                body: fD
            }).then(response => response.text()).then(res => {
                booksEntregar()
                document.getElementById('message').innerHTML = `
                            <div class="alert alert-warning" role="alert">
                                        <strong id="alert-entrega">${res}</strong>
                                    </div>`;
                document.getElementById('message').classList.remove('t-inactive');

                if (res.length === 0) {
                    document.getElementById('message').innerHTML = `
                            <div class="alert alert-primary" role="alert">
                                        <strong id="alert-entrega">Datos actualizados correctamente</strong>
                                    </div>`;
                }
                setTimeout(() => {
                    document.getElementById('message').classList.add('t-inactive');
                }, 10000);
                librosDisponibles();

            });

        });



        /* Paso #1 - Caja de Entrega */
        const cajaEntrega = (e) => {
            booksEntregar();
            let objetTable = tableEntregados.row().data();

            panelEntrega.classList.remove('col-md-3')
            panelEntrega.classList.add('col-sm-12', 'col-md-12')
            document.querySelector('#select-entrega').classList.add('col-md-3')

            const mostrarTableEntregas = () => {
                if (!tableEntregados.data().any()) {
                    divDttEntregas.classList.add('t-inactive')
                }
            }
            document.querySelector('#upto-dev').addEventListener('click', (e) => {
                e.stopPropagation()
                reoladTbentrega()
                mostrarTableEntregas()
            })



            e.stopPropagation();
            $('#dataTable-entrega input[type=search]').prop({
                'value': selectEst.value
            }).keyup().hide();

            $('#prestamosBook_filter label').hide();
            divPrestamo.classList.toggle('t-inactive');
            closeEntrega.classList.toggle('t-inactive');
            listCI.classList.toggle('t-inactive');
            selectEst.setAttribute('disabled', '');
            genCI.setAttribute('disabled', '');
            //window.location.href = '#entreg';

            /* Get ID del ci seleccionado */
            $.ajax({
                url: '<?php echo base_url('/id_ci') ?>',
                type: 'POST',
                data: {
                    ci: selectEst.value
                }
            }).done(function(r) {
                $('#diEstudiant').val(r);
            });

            /* Eliminar registro */
            $("#prestamosBook tbody").on('click', 'tr', function() {
                let data2 = tableEntregados.row(this).data();

                $(".del-entrega").on("click", function() {
                    let id_entrega = data2.id;
                    Swal.fire({
                        title: 'Seguro?',
                        text: "Se eliminaran todos los datos de la entrega",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, borrarlo!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            borrarEntrega(id_entrega);
                            Swal.fire(
                                'Borrado!',
                                'Se completo el borrado del registro.',
                                'success'
                            );
                        }
                    })
                });

                function borrarEntrega(id_entrega) {
                    $.ajax({
                        url: '<?php echo base_url('/del_entrega'); ?>',
                        type: 'POST',
                        data: {
                            id_entrega: id_entrega
                        }
                    }).done((res) => {
                        console.log(res)
                        reoladTbentrega();
                        booksEntregar();
                        /* *@event {mousemove}
                         * @function {}
                         */
                        divDttEntregas.addEventListener("mousemove", mostrarTableEntregas);
                        //divDttEntregas.removeEventListener("mousemove", mostrarTableEntregas);
                    });

                }
            });

            //console.log(selectEst.value)

        }

        /* click double funtion */
        document.getElementById('copy-devolution').addEventListener('click', () => {
            $('#load-devolution').click();
        });
        /* Click al modal */
        document.getElementById('continue').addEventListener('click', () => {
            $('#send-dispo').click();
        });

        /* Enviar datos de entrega de libros */
        sendEntrega.addEventListener("click", (event) => {
            event.stopPropagation();
            let formData = new FormData();
            formData.append('fk_estudiante', document.getElementById('diEstudiant').value);
            formData.append('fk_libro', document.getElementById('idLibro').value);
            formData.append('fecha_entrega', document.getElementById('dateEntrega').value);

            /**@argument {probar con los Async await} */
            fetch("<?php echo base_url('/save_entrega'); ?>", {
                method: "POST",
                body: formData
            }).then(response => response.text()).then(datos => {
                //console.log(datos);
                mensaje.innerHTML = datos;
                divAlert.classList.remove('t-inactive');
                setTimeout(function() {
                    divAlert.classList.add('t-inactive');
                }, 4000);
                booksEntregar();
                reoladTbentrega();
            });
            setTimeout(() => {
                divDttEntregas.classList.remove('t-inactive')
            }, 1000);
        });


        identidades();



        listCI.addEventListener('click', identidades);
        genCI.addEventListener('click', cajaEntrega);

        closeEntrega.addEventListener('click', (event) => {
            event.stopPropagation();
            divPrestamo.classList.add('t-inactive');
            closeEntrega.classList.add('t-inactive');
            listCI.classList.remove('t-inactive');
            selectEst.removeAttribute('disabled');
            genCI.removeAttribute('disabled');
            divDevol.classList.add('t-inactive');

            panelEntrega.classList.remove('col-md-12')
            panelEntrega.classList.add('col-md-3')
            document.querySelector('#select-entrega').classList.remove('col-md-3')

        });

        /* Generar entrega */
        formE.addEventListener('submit', (e) => {
            e.preventDefault();
            let student = e.target.fk_student.value;
            let fdD = new FormData();
            fdD.append('fk_estudiante', student);

            fetch("<?php echo base_url('/b_entregados') ?>", {
                method: "POST",
                body: fdD
            }).then(respuesta => respuesta.json()).then(datas => {
                document.querySelectorAll('#prestamosBook button').forEach(btn => {
                    btn.classList.add('t-inactive')
                });
                divEntrega.classList.add('t-inactive');
                selector.classList.add('t-inactive');
                divDevol.classList.remove('t-inactive');
                //console.log(datas.data)
                let dat = datas.data;
                lista(dat);
                document.getElementById('copy-devolution').classList.add("t-inactive");

            }).catch(() => {
                console.log("Err");
                mensaje.innerHTML = "No existen libros pendientes";
                divAlert.classList.remove('t-inactive');
                setTimeout(function() {
                    divAlert.classList.add('t-inactive');
                }, 4000);
            });

        });

        formD.addEventListener('submit', (e) => {
            e.preventDefault();
            const inputs = document.querySelectorAll('#to-do input[type=checkbox]');
            const inputsArr = [...inputs];
            const formDevolution = new FormData();

            formDevolution.append('perdido', e.target.check.checked);
            formDevolution.append('date_dev', e.target.fechaD.value);


            inputsArr.forEach((checks) => {
                if (checks.checked) {
                    formDevolution.append('bookss[]', checks.id);

                    //console.log(checks)
                }
            });

            //console.log(inputsArr.find(chek => chek.checked));

            fetch("<?php echo base_url('/devolution') ?>", {
                    method: "POST",
                    body: formDevolution
                })
                .then(r => r.text())
                .then(d => {
                    /* Encontrar un objeto en un array por una de sus propiedades */
                    let condition = inputsArr.find(chek => chek.checked);
                    console.log(condition);
                    if (condition != undefined) {
                        if (d.length === 0) {
                            mensaje.innerHTML = "Libros actualizados";
                            divAlert.classList.remove('t-inactive');
                            setTimeout(function() {
                                divAlert.classList.add('t-inactive');
                            }, 5000);
                            divDevol.classList.remove('t-inactive');
                            $('#load-prestamo').click();
                            reoladTbentrega();
                            booksEntregar();
                        } else {
                            mensaje.innerHTML = d;
                            divAlert.classList.remove('t-inactive');
                            setTimeout(function() {
                                divAlert.classList.add('t-inactive');
                            }, 5000);
                            divDevol.classList.remove('t-inactive');
                            $('#load-prestamo').click();
                        }
                    }
                });
            //console.log(...formDevolution)
            //console.log(inputsArr[0].checked)
            //console.log(inputs)
            //console.log(e.target)
        });

        volver.addEventListener('click', (e) => {
            document.querySelectorAll('#prestamosBook button').forEach(btn => {
                btn.classList.remove('t-inactive')
            });
            e.stopPropagation();
            divEntrega.classList.remove('t-inactive');
            divDevol.classList.add('t-inactive');
            selector.classList.remove('t-inactive');
            document.getElementById('copy-devolution').classList.remove("t-inactive");
            document.querySelector('#check__perdido').checked = false;
            identidades()
        });

        /* Listar los libros pendientes en to-DO.js */
        function lista(dat) {
            ! function(t) {
                "use strict";

                function o() {
                    this.$body = t("body"),
                        this.$todoContainer = t("#todo-container"),
                        this.$todoMessage = t("#todo-message"),
                        this.$todoRemaining = t("#todo-remaining"),
                        this.$todoTotal = t("#todo-total"),
                        this.$archiveBtn = t("#btn-archive"),
                        this.$todoList = t("#todo-list"),
                        this.$todoDonechk = ".todo-done",
                        this.$todoForm = t("#todo-form"),
                        this.$todoInput = t("#todo-input-text"),
                        this.$todoBtn = t("#todo-btn-submit"),
                        this.$todoData = dat,
                        this.$todoCompletedData = [], this.$todoUnCompletedData = []
                }
                o.prototype.markTodo = function(t, o) {
                    for (var e = 0; e < this.$todoData.length; e++) this.$todoData[e].id == t && (this.$todoData[e].done = o)
                }, o.prototype.addTodo = function(t) {
                    this.$todoData.push({
                        id: this.$todoData.length,
                        text: t,
                        done: !1
                    }), this.generate()
                }, o.prototype.archives = function() {
                    this.$todoUnCompletedData = [];
                    for (var t = 0; t < this.$todoData.length; t++) {
                        var o = this.$todoData[t];
                        1 == o.done ? this.$todoCompletedData.push(o) : this.$todoUnCompletedData.push(o)
                    }
                    this.$todoData = [], this.$todoData = [].concat(this.$todoUnCompletedData), this.generate()
                }, o.prototype.generate = function() {
                    this.$todoList.html("");
                    for (var t = 0, o = 0; o < this.$todoData.length; o++) {
                        var e = this.$todoData[o];
                        1 == e.done ? this.$todoList.prepend('<li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="' + e.id + '" checked><label class="form-check-label" for="' + e.id + '"><s>' + e.text + "</s></label></div></li>") : (t += 1, this.$todoList.prepend('<li class="list-group-item border-0 ps-0"><div class="form-check mb-0"><input type="checkbox" class="form-check-input todo-done" id="' + e.id + '"><label class="form-check-label" for="' + e.id + '">' + e.text + "</label></div></li>"))
                    }
                    this.$todoTotal.text(this.$todoData.length), this.$todoRemaining.text(t)
                }, o.prototype.init = function() {
                    var o = this;
                    this.generate(), this.$archiveBtn.on("click", function(t) {
                        return t.preventDefault(), o.archives(), !1
                    }), t(document).on("change", this.$todoDonechk, function() {
                        this.checked ? o.markTodo(t(this).attr("id"), !0) : o.markTodo(t(this).attr("id"), !1), o.generate()
                    }), this.$todoForm.on("submit", function(t) {
                        return t.preventDefault(), "" == o.$todoInput.val() || void 0 === o.$todoInput.val() || null == o.$todoInput.val() ? (o.$todoInput.focus(), !1) : (o.addTodo(o.$todoInput.val()), o.$todoForm.removeClass("was-validated"), o.$todoInput.val(""), !0)
                    })
                }, t.TodoApp = new o, t.TodoApp.Constructor = o
            }(window.jQuery),
            function() {
                "use strict";
                window.jQuery.TodoApp.init()
            }();
        }
    });
</script>