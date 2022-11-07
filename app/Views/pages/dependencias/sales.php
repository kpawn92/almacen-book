<script>
  $(document.getElementById('ventaB')).ready(function() {
    let tb_ventas = $(document).ready(function() {
      const form_date = document.querySelector('#form_edit_modal')
      const form_cancel = document.querySelector('#form-delOrden')
      const form_pay = document.querySelector('#form_pay')

      form_pay.addEventListener('submit', async (e) => {
        e.preventDefault()
        const fdpay = new FormData()
        fdpay.append('id', e.target.id_pay.value)
        const postPay = await fetch('<?= base_url('/set_pay')?>', {
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
                         <label class="form-check-label" for="${id}">&nbsp;</label>
                      </div>`
            }
          },
          {
            "data": "id",
            "render": function(id) {
              return `<a href="#" class="text-body fw-bold">#BM${id}</a>`
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
        //console.log(data);
        $("#id_book_ok").val(data.id);
        $("#del-order").val(data.id);
        $("#id_pay").val(data.id);

      });

      document.querySelector('#checkAll').addEventListener('click', () => {
        const checkBoxSales = document.querySelectorAll('tbody input')
        checkBoxSales.forEach(check => check.checked = !check.checked)
      })

    });
  })
</script>