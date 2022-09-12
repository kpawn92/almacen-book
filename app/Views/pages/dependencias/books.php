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
                        //return JSON.stringify(data.responseText);
                        //var respuesta = JSON.stringify(data.responseText);                        
                        var respuesta = JSON.parse(data.responseText);
                        $('#retornoDelB').val(respuesta);
                        //alert(JSON.parse(data.responseText));              
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