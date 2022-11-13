<script>
  $(document.getElementById('ventaB')).ready(function() {
    let tb_ventas = $(document).ready(function() {
      const form_date = document.querySelector('#form_edit_modal')
      const form_cancel = document.querySelector('#form-delOrden')
      const form_pay = document.querySelector('#form_pay')
      const tbodyOrder = document.querySelector('#tb_order_sales')
      const url = document.querySelector('#burl').value
      const headerOrder = document.querySelector('#header_order')
      const btnEdit = document.querySelector('#editOrder')
      const btnCancel = document.querySelector('#cancelOrder')
      const btnPay = document.querySelector('#payOrder')
      const checkAll = document.querySelector('#checkAll')
      const formEditSalesAll = document.querySelector('#editAllSales')
      const div_mesanjeSales = document.querySelector('#mensaje_tableSales')



      function saveIMG(uri, filename) {

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

      const img_export = (btn, table, name) => {
        btn.addEventListener("click", function() {
          html2canvas(table).then(function(canvas) {
            saveIMG(canvas.toDataURL(), name);
          });
        });
      }

      img_export(document.getElementById("btn-img-ventas"), document.querySelector('#tb__orders'), 'Ordenes_de_compras.png')

      img_export(document.getElementById("btn-down-descriptionOrder"), document.querySelector('#tb_ordenID'), `Descripcion de la orden.png`)


      checkAll.addEventListener('click', () => {
        const checkBoxSales = document.querySelectorAll('tbody input')
        checkBoxSales.forEach(check => check.checked = !check.checked)
      })

      const mensajePost = (post) => {
        div_mesanjeSales.classList.remove('t-inactive')
        console.log(post)
        if (post === "0") {
          div_mesanjeSales.innerHTML = " <strong>Error en la actualizaci&oacute;n de las &oacute;rdenes</strong>"
        }

        if (post === "1") {
          div_mesanjeSales.classList.remove('alert-danger', 'text-danger')
          div_mesanjeSales.classList.add('alert-success', 'text-success')
          div_mesanjeSales.innerHTML = " <strong>Actualizaci&oacute;n realizada</strong>"
        }

        setTimeout(() => {
          div_mesanjeSales.classList.add('t-inactive')
          div_mesanjeSales.classList.add('alert-danger', 'text-danger')
          div_mesanjeSales.classList.remove('alert-success', 'text-success')
        }, 5000)
      }

      const fetchIds = async (url, formData) => {
        const post = await fetch(url, {
          method: "POST",
          body: formData
        })
        const resPost = await post.text()
        await mensajePost(resPost)
      }

      const setCheckBox = (btn, url) => {
        btn.addEventListener('click', () => {
          formData = new FormData()
          document.querySelectorAll('tbody input').forEach(check => {
            if (check.checked !== false) {
              formData.append('id', check.id)
              fetchIds(url, formData)
            }
          })
        })
      }

      const setEditAllsales = (form, url) => {
        form.addEventListener('submit', (e) => {
          e.preventDefault()
          formData = new FormData()
          formData.append('fecha', e.target.fecha_edit.value)

          document.querySelectorAll('tbody input').forEach(check => {
            if (check.checked !== false) {
              formData.append('id', check.id)
              fetchIds(url, formData)
            }
          })


        })
      }

      setEditAllsales(formEditSalesAll, "<?= base_url('/editSalesAll') ?>")
      setCheckBox(btnCancel, "<?= base_url('/cancelSales') ?>")
      setCheckBox(btnPay, "<?= base_url('/paySales') ?>")



      tbodyOrder.innerHTML = ''



      const tableOfOrder = (element) => {
        element.map(e => {
          tbodyOrder.innerHTML += `              <tr>
                                                    <td><img src="${url}/uploads/${e.portada}" width="30" alt="portadas"></td>
                                                    <td>${e.titulo}</td>
                                                    <td>${e.autor}</td>
                                                    <td>$${e.precio}</td>
                                                </tr>`
        })
      }

      const getLibrosOrder = async (element) => {
        const libros = new FormData()
        libros.append('libros', element)
        const postLibros = await fetch('<?= base_url('/librosSalesRoot') ?>', {
          method: "POST",
          body: libros
        })
        const resPostLibros = await postLibros.json()
        tableOfOrder(resPostLibros)
      }

      form_pay.addEventListener('submit', async (e) => {
        e.preventDefault()
        const fdpay = new FormData()
        fdpay.append('id', e.target.id_pay.value)
        const postPay = await fetch('<?= base_url('/set_pay') ?>', {
          method: "POST",
          body: fdpay
        })
        const resPostPay = await postPay.text()

        console.log(resPostPay)

      })


      form_cancel.addEventListener('submit', async (e) => {
        e.preventDefault()
        const fd_cancel = new FormData()
        fd_cancel.append('id', e.target.cancel_order.value)
        const postCancel = await fetch('<?= base_url('/cancel_order') ?>', {
          method: "POST",
          body: fd_cancel
        })

        const resPostCancel = await postCancel.text()
        console.log(resPostCancel)

      })



      const postmsg = (post) => {
        if (post === "0") {
          document.querySelector('#msg-danger').innerHTML = `<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                <strong>Error - </strong> Al entrar la fecha de venta!
                                                            </div>`
        }
        if (post === "3") {
          document.querySelector('#msg-danger').innerHTML = `<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                <strong>Aceptada - </strong> La fecha ha sido creada satisfactoriamente!
                                                            </div>`
        }
      }

      const update_aprobado = async (formData) => {
        const postDate = await fetch('<?= base_url('/date_aprobado') ?>', {
          method: "POST",
          body: formData
        })
        const resPostDate = await postDate.text()
        console.log(resPostDate)
        postmsg(resPostDate)
      }


      form_date.addEventListener('submit', (e) => {
        e.preventDefault()
        const fd_sales = new FormData()
        const {
          id_book_ok,
          date_ok
        } = e.target

        fd_sales.append('id', id_book_ok.value)
        fd_sales.append('date', date_ok.value)

        update_aprobado(fd_sales)


      })

      const getStatus = (item) => {
        if (item === "0") {
          return `<h5><span class="badge badge-warning-lighten"><i class="mdi mdi-timer-sand"></i> Esperando Autorizaci&oacute;n</span></h5>`
        }
        if (item === "1") {
          return `<h5><span class="badge badge-success-lighten"><i class="mdi mdi-account-cash"></i> Pagado</span></h5>`
        }

        if (item === "2") {
          return `<h5><span class="badge badge-danger-lighten"><i class="mdi mdi-cancel "></i> Cancelada </span></h5>`
        }

        return `<h5><span class="badge badge-primary-lighten"><i class="mdi mdi-check-outline"></i> Aprobado</span></h5>`
      }

      const pos = "listarOrden"
      const table_order = $('#tb__orders').DataTable({
        ajax: {
          "url": "<?= base_url('/order'); ?>",
          "method": "POST",
          "data": {
            pos: pos
          }
        },
        columns: [{
            "data": "id",
            "render": function(id) {
              return `<div class="form-check">
                         <input type="checkbox" class="form-check-input" id="${id}">
                         <label class="form-check-label" for="${id}">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      </div>`
            }
          },
          {
            "data": "id",
            "render": function(id) {
              return `<a href="#" class="text-body fw-bold" data-bs-toggle="modal" data-bs-target="#info-description">#BM${id}</a>`
            }
          },
          {
            "data": "fecha_solicitud"
          },
          {
            "data": "nombre"
          },
          {
            "data": "lastname"
          },
          {
            "data": "pay",
            "render": function(pay) {
              return `<span>$${pay}</span>`
            }
          },
          {
            "data": "condition",
            "render": function(status) {
              return getStatus(status)
            }
          },
          {
            "data": "fecha_aprobado"
          },
          {
            "defaultContent": `<a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#warning-header-modal"> <i class="mdi mdi-calendar-edit"></i></a>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#danger-alert-modal"> <i class="mdi mdi-delete"></i></a>
                                        <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#info-alert-modal"> <i class="mdi mdi-cart-check me-1"></i></a>`
          }
        ],
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
      });

      document.querySelector('#up_tbOrder').addEventListener('click', () => {
        table_order.ajax.reload();
      })

      $("#tb__orders tbody").on('click', 'tr', function() {
        const data = table_order.row(this).data();
        $("#id_book_ok").val(data.id);
        $("#del-order").val(data.id);
        $("#id_pay").val(data.id);
        headerOrder.innerHTML = ''
        $("#id_libros_order").val(data.libros_id);
        headerOrder.innerHTML = data.id

        tbodyOrder.innerHTML = ''

        getLibrosOrder(document.querySelector('#id_libros_order').value)

      });

    });
  })
</script>