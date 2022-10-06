<script>
    $(document.getElementById('libros')).ready(function() {
        document.getElementById("retornoDelB").value = "";
        /* Enviar formulario - libros */
        $('#sub_l').click(function() {
            var formLibro = $('#form2').serialize();
            console.log(formLibro);
            $.ajax({
                    url: '<?php echo base_url('/save_book'); ?>',
                    type: 'POST',
                    data: $('#form2').serialize(),
                })
                .done(function(res) {
                    $('#resp-book').html(res);
                    tableBooks.ajax.reload();
                    var cajaDos = document.getElementById('alert3');
                    cajaDos.style.display = '';
                    $("#alert3").show();
                    setTimeout(function() {
                        $("#alert3").hide();
                    }, 6000);
                })
        });

        /* Mostrar Tabla libros-registrados */

        var accion = "listarLibro";

        var tableBooks = $('#books').DataTable({
            ajax: {
                "url": "<?php echo base_url('/list_book'); ?>",
                "method": "POST",
                "data": {
                    accion: accion
                }
            },
            columns: [{
                    "data": "codigo"
                },
                {
                    "data": "titulo"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "autor"
                },
                {
                    "data": "isbn"
                },
                {
                    "data": "cantidad"
                },
                {
                    "defaultContent": `<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightLibro" aria-controls="offcanvasRight"><i class="dripicons-document-edit"></i></button>
                                       <button type="button" class="del-book btn btn-danger"><i class="dripicons-trash"></i></button>`
                }
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },
        });

        /*  */
        $("#books tbody").on('click', 'tr', function() {
            var data2 = tableBooks.row(this).data();


            console.log(data2);
            $("#id_libro").val(data2.id_book);
            //$("#id-del").val(data.id);
            $("#ecodigo").val(data2.codigo);
            $("#etitulo").val(data2.titulo);
            $("#eprecio").val(data2.precio);
            $("#eautor").val(data2.autor);
            $("#eisbn").val(data2.isbn);
            $("#ecantidad").val(data2.cantidad);

            $(".del-book").on("click", function() {
                var id_libro = data2.id_book;
                borrarLibro(id_libro);
                Swal.fire({
                    title: 'Seguro?',
                    text: "Se eliminaran todos los datos del libro",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, borrarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var borrado = document.getElementById("retornoDelB").value;
                        if (borrado != "false") {
                            delTrue();
                        } else {
                            delFalse();
                        }

                        console.log(borrado);

                    }
                })
            });

            function delTrue() {
                document.getElementById("retornoDelB").value = "";
                Swal.fire(
                    'Borrado!',
                    'Se completo el borrado del registro.',
                    'success'
                );
                tableBooks.ajax.reload();
            }

            function delFalse() {
                document.getElementById("retornoDelB").value = "";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El registro tiene dependencias!'
                });
                tableBooks.ajax.reload();
            }

            function borrarLibro(id_libro) {
                console.log("funcion");
                $.ajax({
                    url: '<?php echo base_url('/del_book'); ?>',
                    type: 'POST',
                    data: {
                        id_libro: id_libro
                    },
                    complete: function(data) {                        
                        var respuesta = JSON.parse(data.responseText);
                        $('#retornoDelB').val(respuesta);              
                    }
                });
            }
        });

        /* Metodo para editar libros */

        $("#edit_book").click(function() {
            $.ajax({
                url: '<?php echo base_url('/edit_book'); ?>',
                type: 'POST',
                data: $('#form-editbook').serialize(),
            }).done(function(res) {
                $('#respuesta-book').html(res);
                tableBooks.ajax.reload();
                var alerta2 = document.getElementById('alerta2');
                alerta2.style.display = '';
                $("#alerta2").show();
                setTimeout(function() {
                    $("#alerta2").hide();
                }, 4000);
            });
        });

        /* Actualizar la tabla-libros */
        $("#btn-update-book").on('click', function() {
            tableBooks.ajax.reload();
            var dataBook = tableBooks.row().data();
            ocultarDivTable(dataBook);
        });

        $("#btn-listbooks").on('click', function() {
            tableBooks.ajax.reload();
            var dataBook = tableBooks.row().data();
            ocultarDivTable(dataBook);
        })

        function ocultarDivTable(dataBook) {
            var divDatatableBook = document.getElementById("dataTable-book");
            if (dataBook == undefined) {
                divDatatableBook.style.display = "none";
                //console.log("bien");
            } else {
                divDatatableBook.style.display = "contents";
            }
        }
    });
</script>

<div class="row" id="dataTable-book" style="display: none;">
    <div class="col-12">
        <div class="shadow-lg p-3 mb-5 mt-4 bg-body rounded">
            <div class="row">
                <h4 class="header-title">Libros registrados<button class="btn btn-primary ms-2" id="btn-update-book"><i class="mdi mdi-autorenew"></i></button></h4>
            </div>
            <p class="text-muted font-13">Lorem ipsum <code>{Breve descripcion del DataTable}</code> dolor sit amet
                consectetur adipisicing elit. Atque iusto cum, vel cupiditate quaerat modi quis porro dolores est
                incidunt exercitationem quibusdam tempore repudiandae, enim deserunt dolorum eos excepturi rerum.
                Aut, culpa mollitia hic quidem, vel ex veritatis assumenda vero minus repudiandae dolor inventore
                accusamus deleniti cum placeat sapiente blanditiis dolorum expedita enim repellendus perspiciatis
                quasi quae. Quia, accusamus commodi?</p>

            <div class="row">
                <table id="books" class="table dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>T&iacute;tulo</th>
                            <th>Precio</th>
                            <th>Autor</th>
                            <th>ISBN</th>
                            <th>Cantidad</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div id="dow-book"></div>
            </div>
        </div>
    </div>
</div>
<div id="editar_libro">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightLibro" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Editar libro:</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="alert alert-info" role="alert" id="alerta2" style="display: none">
                <i class="dripicons-information me-2"></i>
                <p id="respuesta-book"></p>
            </div>
            <form id="form-editbook">
                <div class="row">
                    <input type="hidden" id="id_libro" name="id">
                    <div class="mb-3">
                        <label class="form-label" for="ecodigo">C&oacute;digo:</label>
                        <input type="text" class="form-control" id="ecodigo" name="codigo" placeholder="Entre el c&oacute;digo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="etitulo">T&iacute;tulo:</label>
                        <input type="text" class="form-control" id="etitulo" name="titulo" placeholder="Entre el titulo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="eprecio">Precio:</label>
                        <input type="text" class="form-control" id="eprecio" name="precio" placeholder="Entre el precio">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="eautor">Autor:</label>
                        <input type="text" class="form-control" id="eautor" name="autor" placeholder="Entre el autor">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="eisbn">ISBN:</label>
                        <input type="text" class="form-control" id="eisbn" name="isbn" placeholder="Entre el isbn">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="ecantidad">Cantidad en existencia:</label>
                        <input type="number" class="form-control" id="ecantidad" name="cantidad" placeholder="Entre la cantidad">
                    </div>

                </div>
        </div>
        <button class="btn btn-primary" type="button" id="edit_book">Enviar form</button>
        </form>
    </div>
</div>