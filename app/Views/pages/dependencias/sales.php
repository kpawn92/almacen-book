<script>
  $(document.getElementById('ventaB')).ready(function() {
    let tb_ventas = $(document).ready(function() {
      
      const getStatus = (item) => {
        if (item === "0") {
          return `<h5><span class="badge badge-warning-lighten"><i class="mdi mdi-timer-sand"></i> Esperando Autorizaci&oacute;n</span></h5>`
        }
        if (item === "1") {
          return `<h5><span class="badge badge-success-lighten"><i class="mdi mdi-account-cash"></i> Pagado</span></h5>`
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
              return `<a href="apps-ecommerce-orders-details.html" class="text-body fw-bold">#BM${id}</a>`
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
            "defaultContent": `<a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-calendar-edit"></i></a>
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-cart-check me-1"></i></a>`
          }
        ],
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
      });
    });
  })
</script>