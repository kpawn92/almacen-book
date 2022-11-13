<script>
    $(document.getElementById('libros')).ready(function() {
        document.querySelector('#resp__book').classList.add('t-inactive');
        document.querySelector('#resp__book').innerHTML = "";

        function saveBookImg(uri, filename) {

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

        document.getElementById("btn-down-books").addEventListener("click", function() {
            html2canvas(document.querySelector('#books')).then(function(canvas) {
                saveBookImg(canvas.toDataURL(), 'Libros_registrados.png');
            });
        });

        const baseUrl = document.querySelector('#base_url').value

        const formBook = document.querySelector('#form__book');
        document.querySelector('#libros').addEventListener('click', (e) => e.stopPropagation());

        const btn_mostrarBook = document.querySelector('#btn-listbooks');


        /* Mostrar Tabla libros-registrados */


        let accion = "listarLibro";

        let tableBooks = $('#books').DataTable({
            ajax: {
                "url": "<?php echo base_url('/list_book'); ?>",
                "method": "POST",
                "data": {
                    accion: accion
                }
            },
            columns: [{
                    "data": "portada",
                    "render": function(data) {
                        return `<img src="${baseUrl}/uploads/${data}" width="100" alt="portadas">`
                    }
                },
                {
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

        btn_mostrarBook.addEventListener('click', () => {
            //**__verification si la tabla es null
            if (!!tableBooks.data().any()) {
                document.querySelector('#dataTable-book').classList.remove('t-inactive')
            }
        });

        /* Reload table */
        const reoladTblibro = () => {
            setTimeout(() => {
                tableBooks.ajax.reload();
            }, 500);
        }

        document.querySelector('#btn-update-book').addEventListener('click', () => {
            reoladTblibro();
        });

        const mostrarTableBook = (e) => {
            e.stopPropagation();
            if (!tableBooks.data().any()) {
                document.querySelector('#dataTable-book').classList.add('t-inactive')
            }
        }

        document.querySelector('#dataTable-book').addEventListener("mousemove", mostrarTableBook);

        formBook.addEventListener('submit', (event) => {
            event.preventDefault()
            fD__libro = new FormData();
            const {
                codigo,
                portada,
                titulo,
                autor,
                precio,
                isbn,
                cantidad
            } = event.target;

            fD__libro.append('codigo', codigo.value);
            fD__libro.append('portada', portada.files[0]);
            fD__libro.append('titulo', titulo.value.toUpperCase());
            fD__libro.append('autor', autor.value.toUpperCase());
            fD__libro.append('precio', precio.value);
            fD__libro.append('isbn', isbn.value);
            fD__libro.append('cantidad', cantidad.value);

            const setForm = async () => {
                try {
                    const resPost = await fetch('<?php echo base_url('/save_book'); ?>', {
                        method: "POST",
                        body: fD__libro
                    });
                    const post = await resPost.text()
                    await document.querySelector('#dataTable-book').classList.remove('t-inactive');
                    if (post === "1") {
                        document.querySelector('#resp__book').classList.remove('t-inactive');
                        document.querySelector('#resp__book').innerHTML = `<div class="alert alert-success" role="alert">
                                                                                <i class="dripicons-checkmark me-2"></i> Datos <strong>guardados</strong> correctamente
                                                                            </div>`;

                        setTimeout(() => {
                            document.querySelector('#resp__book').classList.add('t-inactive');
                        }, 3000);
                    } else {
                        document.querySelector('#resp__book').classList.remove('t-inactive');
                        document.querySelector('#resp__book').innerHTML = `<div class="alert alert-danger" role="alert">
                                                                                <i class="dripicons-wrong me-2"></i> ${post}
                                                                            </div>`;

                        setTimeout(() => {
                            document.querySelector('#resp__book').classList.add('t-inactive');
                        }, 5000);
                    }
                    await reoladTblibro()
                    await formBook.reset()
                } catch (error) {
                    //console.log(error)
                }
            }

            setForm();



            //console.log(...fD__libro)
        });

        $("#books tbody").on('click', 'tr', function() {
            var data2 = tableBooks.row(this).data();


            //console.log(data2);
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
                reoladTblibro()
            }

            function delFalse() {
                document.getElementById("retornoDelB").value = "";
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El registro tiene dependencias!'
                });
                reoladTblibro();
            }

            function borrarLibro(id_libro) {
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
                reoladTblibro();
                var alerta2 = document.getElementById('alerta2');
                alerta2.style.display = '';
                $("#alerta2").show();
                setTimeout(function() {
                    $("#alerta2").hide();
                }, 4000);
            });
        });
    });
</script>