<script>
    $(document.getElementById('estudiante')).ready(function() {

        const url__Base = document.querySelector('#bu').value
        document.querySelector('#estudiante').addEventListener('click', (e) => e.stopPropagation());
        const expresiones = {
            nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
            lastname: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
            ci: /^[0-9]{6,11}$/, // Solo caracteres numericos.
        }

        const list_paises = () => {
            const json__flagg = `${url__Base}/assets/json/codes_paises.json`
            fetch(json__flagg)
                .then(response => response.json())
                .then(data => {
                    /**@description Iterar un objeto */
                    Object.entries(data).forEach(option => {
                        document.querySelector('#paises').innerHTML += `<option value="${option[1]+"-"+option[0]}"></option>`
                    })
                });

        }

        list_paises()
        document.querySelector('#internacional').addEventListener('click', (e) => {
            e.stopPropagation()
            document.querySelector('#direction_cuba').classList.add('t-inactive')
            document.querySelector('#camp__dir').classList.remove('t-inactive')
        });

        document.querySelector('#nacional').addEventListener('click', (e) => {
            e.stopPropagation()
            document.querySelector('#direction_cuba').classList.remove('t-inactive')
            document.querySelector('#camp__dir').classList.add('t-inactive')
        });


        const bandera = (flag) => {
            // json__banderas = ""

            return `<img
                        src="${url__Base}/banderas/${flag.index}.png"
                        width="20"
                        alt="${flag.pais}"
                        title="${flag.pais}">&nbsp;${flag.cuidad}`
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
                    "data": "direccion",
                    "render": function(data) {
                        if (data) {
                            /**
                             * Metodo para transformar el primer caracter en mayuscula y los demas caracteres de la palabra en minuscula
                             */
                            //var transf_stringPais = select__pais[0];
                            // var pais = transf_stringPais[0].toUpperCase() + transf_stringPais.substring(1);
                            var select__pais = data.split("-")
                            var params = {
                                index: select__pais[1],
                                pais: select__pais[0],
                                cuidad: select__pais[2]
                            }
                            /*----*/
                        }
                        return bandera(params);
                    }
                },
                {
                    "data": "nation",
                    "render": function(e) {
                        if (e == 0) {
                            e = `Nacional`
                        } else if (e == 1) {
                            e = `Internacional`
                        }
                        return e
                    }
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
                    "defaultContent": ` 
                                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="dripicons-document-edit"></i></button>
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
        });

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

            console.log(e.target);

            fD__estudiante = new FormData();
            const {
                nombre,
                lastname,
                ci,
                nation,
                name_pais,
                ciudad,
                direccion,
                fk_carrera,
                fk_year_academico,
                fk_brigada
            } = e.target;

            fD__estudiante.append('nombre', nombre.value.toUpperCase());
            fD__estudiante.append('lastname', lastname.value.toUpperCase());
            fD__estudiante.append('ci', ci.value);
            fD__estudiante.append('nation', nation.value);
            fD__estudiante.append('pais', name_pais.value);
            fD__estudiante.append('ciudad', ciudad.value);
            fD__estudiante.append('direccion', direccion.value);
            fD__estudiante.append('fk_carrera', fk_carrera.value);
            fD__estudiante.append('fk_year_academico', fk_year_academico.value);
            fD__estudiante.append('fk_brigada', fk_brigada.value);


            const setStudentForm = async () => {
                try {
                    document.querySelector('#resp__student').classList.remove('t-inactive');
                    const resPost__std = await fetch('<?php echo base_url('/save_student'); ?>', {
                        method: 'POST',
                        body: fD__estudiante
                    });
                    const post__student = await resPost__std.text();
                    if (post__student === "1") {
                        document.querySelector('#resp__student').innerHTML = `<div class="alert alert-success" role="alert">
                                                                                <i class="dripicons-checkmark me-2"></i> Datos <strong>guardados</strong> correctamente
                                                                            </div>`;
                        document.querySelector('#direction_cuba').classList.remove('t-inactive')
                        document.querySelector('#camp__dir').classList.add('t-inactive')
                        reoladTbestudiante()
                        formulario__estudiante.reset()
                    } else if (post__student === "2") {
                        document.querySelector('#resp__student').innerHTML = `<div class="alert alert-warning" role="alert">
                                                                                <i class="dripicons-warning me-2"></i> El <strong>estudiante</strong> ya existe!
                                                                            </div>`;
                    } else {
                        document.querySelector('#resp__student').innerHTML = `<div class="alert alert-danger" role="alert">
                                                                                <i class="dripicons-wrong me-2"></i> ${post__student}
                                                                            </div>`;
                    }
                    setTimeout(() => {
                        document.querySelector('#resp__student').innerHTML = "";
                    }, 3000);
                } catch (error) {

                }
            }
            setStudentForm();

        });

        $("#students tbody").on('click', 'tr', function() {
            var data = tb__student.row(this).data();
            //console.log(data);
            $("#id").val(data.id);
            $("#id-del").val(data.id);
            $("#enombre").val(data.nombre);
            $("#elastname").val(data.lastname);
            $("#eci").val(data.ci);

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