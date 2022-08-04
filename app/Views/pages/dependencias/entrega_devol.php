<script>
    $(document).ready(function() {

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
        //const labelBook = document.querySelector('#labelBook');
        const btnBorrador = document.querySelectorAll('.del-entrega');

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
                    "data": "ci"
                },
                {
                    "data": "codigo"
                },
                {
                    "data": "titulo"
                },
                {
                    "data": "fecha_entrega"
                },
                {
                    "data": "fecha_dev"
                }
            ],
            "language": {
                "url": "assets/json/Spanish.json"
            },
        });

        /* Reload table */
        function reoladTbentrega() {
            setInterval(function() {
                tableEntregados.ajax.reload();
            }, 3000);
        }




        /* function tableHistorial(datos) {
            contTable.innerHTML = '';
            for (let i = 0; i < datos.data.length; i++) {
                console.log(datos.data[i].codigo)

                contTable.innerHTML += `<tr>
                                            <td>button</td>
                                            <td>${datos.data[i].ci}</td>
                                            <td>${datos.data[i].codigo}</td>
                                            <td>${datos.data[i].titulo}</td>
                                            <td>${datos.data[i].fecha_entrega}</td>
                                            <td>${datos.data[i].fecha_dev}</td>                                        
                                        </tr>`;
            }

        }

        const traerEntregados = () => {
            let dat = new FormData();
            dat.append('f', selectEst.value);
            fetch("<? //= base_url('/list_entrega'); 
                    ?>", {
                method: "POST",
                body: dat
            }).then(res => res.json()).then(datos => {
                console.log(datos)
                tableHistorial(datos)
            })
        } */





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
                }
            });
        }

        /* Paso #1 - Caja de Entrega */
        const cajaEntrega = (e) => {
            let objetTable = tableEntregados.row().data();
            

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
            window.location.href = '#entreg';

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
                    });
                    reoladTbentrega();
                    console.log(id_entrega);
                }
            });

            //console.log(selectEst.value)

        }

        /* click double funtion */
        document.getElementById('copy-devolution').addEventListener('click', () => {
            $('#load-devolution').click();
        });

        /* Enviar datos de entrega de libros */
        sendEntrega.addEventListener("click", (event) => {
            event.stopPropagation();
            let formData = new FormData();
            formData.append('fk_estudiante', document.getElementById('diEstudiant').value);
            formData.append('fk_libro', document.getElementById('idLibro').value);
            formData.append('fecha_entrega', document.getElementById('dateEntrega').value);

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
            });
            reoladTbentrega();
        });


        identidades();

        booksEntregar();

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
                //console.log(datas.data.length);
                //console.log(datas.data.length);
                /* 
                                labelBook.innerHTML = '';
                                for (let i = 0; i < datas.data.length; i++) {

                                    labelBook.innerHTML += `<option value="${datas.data[i].id}">${datas.data[i].codigo} | ${datas.data[i].titulo}</option>`;
                                } */
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

                    //console.log(checks.id)
                }
            });

            fetch("<?php echo base_url('/devolution') ?>", {
                    method: "POST",
                    body: formDevolution
                })
                .then(r => r.text())
                .then(d => {
                    console.log(d);
                    reoladTbentrega()
                });

            //console.log(...formDevolution)

            //console.log(inputsArr[0].checked)
            //console.log(inputs)

            //console.log(e.target)            
            divDevol.classList.remove('t-inactive');
            $('#load-prestamo').click();

        });

        volver.addEventListener('click', (e) => {
            e.stopPropagation();
            divEntrega.classList.remove('t-inactive');
            divDevol.classList.add('t-inactive');
            selector.classList.remove('t-inactive');
            document.getElementById('copy-devolution').classList.remove("t-inactive");
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