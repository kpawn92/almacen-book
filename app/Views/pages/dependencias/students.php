<script>
    $(document.getElementById('estudiante')).ready(function() {

        document.querySelector('#estudiante').addEventListener('click', (e) => e.stopPropagation());
        const expresiones = {
            nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
            lastname: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
            ci: /^[0-9]{11}$/, // Solo caracteres numericos.
        }
        let funcion = "listar";
        let tb__student = $('#students').DataTable({
            ajax: {
                "url": "<?php echo base_url('/list_student'); ?>",
                "method": "POST",
                "data": {
                    funcion: funcion
                }
            },
            columns: [{
                    "data": "nombre"
                },
                {
                    "data": "lastname"
                },
                {
                    "data": "ci"
                },
                {
                    "data": "direccion"
                },
                {
                    "data": "municipio"
                },
                {
                    "data": "carrera"
                },
                {
                    "data": "anno_academico"
                },
                {
                    "data": "brigada"
                },
                {
                    "defaultContent": `<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="dripicons-document-edit"></i></button>
                                       <button type="button" class="del-student btn btn-danger"><i class="dripicons-trash"></i></button>`
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },
        });

        /* Reload table */
        const reoladTbestudiante = () => {
            setTimeout(() => {
                tb__student.ajax.reload();
            }, 500);
        };


        const formulario__estudiante = document.querySelector('#form__student');
        const inputs__std = document.querySelectorAll('#form__student input');
        const alertBack = document.querySelector('#resp__back');
        const divMSG = document.querySelector('#msg-back');
        const divDatatableStudent = document.querySelector('#dataTable-student');
        const btn_mostrarStudent = document.querySelector('#btn-liStd');

        btn_mostrarStudent.addEventListener('click', () => {
            //**__verification si la tabla es null
            if (!!tb__student.data().any()) {
                divDatatableStudent.classList.remove('t-inactive')
            }
        })

        const mostrarTableEstudiantes = (e) => {
            e.stopPropagation();
            if (!tb__student.data().any()) {
                divDatatableStudent.classList.add('t-inactive')
            }
        }

        document.querySelector('#dataTable-student').addEventListener("mousemove", mostrarTableEstudiantes);


        const validarForm = (e) => {
            //console.log(e.target.name);
            switch (e.target.name) {
                case "nombre":
                    validarCampo(expresiones.nombre, e.target, 'nombre');
                    break;
                case "lastname":
                    validarCampo(expresiones.lastname, e.target, 'lastname');
                    break;
                case "ci":
                    validarCampo(expresiones.ci, e.target, 'ci');
                    break;
            }
        }

        const validarCampo = (expresion, input, campo) => {
            if (expresion.test(input.value)) {
                document.querySelector(`#empty__${campo}`).classList.add('t-inactive')
                document.querySelector(`#novalidate__${campo}`).classList.add('t-inactive')
                document.querySelector(`#validate__${campo}`).classList.remove('t-inactive')
                document.querySelector(`#validate__${campo}`).classList.add('badge', 'badge-success-lighten')
            } else if (input.value.length === 0) {
                document.querySelector(`#empty__${campo}`).classList.add('badge', 'badge-warning-lighten')
                document.querySelector(`#empty__${campo}`).classList.remove('t-inactive')
                document.querySelector(`#validate__${campo}`).classList.add('t-inactive')
                document.querySelector(`#novalidate__${campo}`).classList.add('t-inactive')
            } else {
                document.querySelector(`#empty__${campo}`).classList.add('t-inactive')
                document.querySelector(`#validate__${campo}`).classList.add('t-inactive')
                document.querySelector(`#novalidate__${campo}`).classList.remove('t-inactive')
                document.querySelector(`#novalidate__${campo}`).classList.add('badge', 'badge-danger-lighten')
            }
        }

        inputs__std.forEach((input) => {
            input.addEventListener('keyup', validarForm)
            input.addEventListener('blur', validarForm)
        })


        formulario__estudiante.addEventListener('submit', (e) => {
            e.preventDefault();

            fD__estudiante = new FormData();
            const {
                nombre,
                lastname,
                ci,
                direccion,
                fk_municipio,
                fk_carrera,
                fk_year_academico,
                fk_brigada
            } = e.target;

            fD__estudiante.append('nombre', nombre.value.toUpperCase());
            fD__estudiante.append('lastname', lastname.value.toUpperCase());
            fD__estudiante.append('ci', ci.value);
            fD__estudiante.append('direccion', direccion.value);
            fD__estudiante.append('fk_municipio', fk_municipio.value);
            fD__estudiante.append('fk_carrera', fk_carrera.value);
            fD__estudiante.append('fk_year_academico', fk_year_academico.value);
            fD__estudiante.append('fk_brigada', fk_brigada.value);


            fetch('<?php echo base_url('/save_student'); ?>', {
                    method: 'POST',
                    body: fD__estudiante
                })
                .then(res => res.text())
                .then(respuesta => {
                    alertBack.innerHTML = respuesta
                    divMSG.classList.remove('t-inactive')
                    setTimeout(() => {
                        divMSG.classList.add('t-inactive')
                    }, 4000);
                    reoladTbestudiante();
                    setTimeout(() => {
                        document.querySelector('#dataTable-student').classList.remove('t-inactive')
                    }, 600);
                });
            //console.log(...fD__estudiante);



        });

        $("#students tbody").on('click', 'tr', function() {
            var data = tb__student.row(this).data();
            //console.log(data);
            $("#id").val(data.id);
            $("#id-del").val(data.id);
            $("#enombre").val(data.nombre);
            $("#elastname").val(data.lastname);
            $("#eci").val(data.ci);
            $("#edireccion").val(data.direccion);

            $(".del-student").on("click", function() {
                var id = data.id;
                borrarEstudiante(id);
                Swal.fire({
                    title: 'Seguro?',
                    text: "Se borraran todos los datos del registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var eborrado = document.getElementById("retornoDelE").value;
                        if (eborrado != "false") {
                            deletTrue();
                        } else {
                            deletFalse();
                        }
                    }
                })
            });

            function deletTrue() {
                document.getElementById("retornoDelE").value = "";
                Swal.fire(
                    'Borrado!',
                    'Se completo el borrado del registro.',
                    'success'
                );
                reoladTbestudiante()
            }

            function deletFalse() {
                document.getElementById("retornoDelE").value = "";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El registro tiene dependencias!'
                });
                reoladTbestudiante()
            }

            function borrarEstudiante(id) {
                console.log("funcion");
                $.ajax({
                    url: '<?php echo base_url('/del_student'); ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    complete: function(data) {
                        var response = JSON.parse(data.responseText);
                        $('#retornoDelE').val(response);
                    }
                });
            }
        });

        /**@argument {pasar los paramentos con toUpperCase()} */
        $("#edit_student").click(function() {
            $.ajax({
                url: '<?php echo base_url('/edit_student'); ?>',
                type: 'POST',
                data: $('#form-edit').serialize(),
            }).done(function(res) {
                $('#respuesta').html(res);
                reoladTbestudiante()
                var alerta = document.getElementById('alerta');
                alerta.style.display = '';
                $("#alerta").show();
                setTimeout(function() {
                    $("#alerta").hide();
                }, 4000);
            });
        });
    });
</script>