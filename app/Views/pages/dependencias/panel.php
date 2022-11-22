<script>
  $(document).ready(function() {

    const host = document.querySelector('#host').value
    const div__comments = document.querySelector('#comentarios');
    const div__tb_students_sales = document.querySelector('#table-students-sales')


    const maqGrafic = (grafic) => {

      const {
        acept,
        cancel,
        espera,
        pay,
        total
      } = grafic

      document.querySelector('#indicators_sales').innerHTML = `<p>
                                                                  <i class="mdi mdi-square text-primary"></i> Aprobado
                                                                  <span class="float-end">$${acept.money}</span>
                                                              </p>
                                                              <p>
                                                                  <i class="mdi mdi-square text-danger"></i> Cancelado
                                                                  <span class="float-end">$${cancel.money}</span>
                                                              </p>
                                                              <p>
                                                                  <i class="mdi mdi-square text-success"></i> Pagado
                                                                  <span class="float-end">$${pay.money}</span>
                                                              </p>
                                                              <p>
                                                                  <i class="mdi mdi-square text-warning"></i> Esperando
                                                                  <span class="float-end">$${espera.money}</span>
                                                              </p>`

      const data = [parseInt(acept.estado), parseInt(pay.estado), parseInt(cancel.estado), parseInt(espera.estado)]
      grafica(data)
    }

    const mapComments = (comments) => {
      comments.map(comment => {
        div__comments.innerHTML += `<div class="timeline-item">
                                        <i class="mdi mdi-upload bg-info-lighten text-info timeline-icon"></i>
                                        <div class="timeline-item-info">
                                            <a href="#" class="text-info fw-bold mb-1 d-block">${comment.subject}</a>
                                            <small>${comment.comment}!</small>
                                            <p class="mb-0 pb-2">
                                            <small class="text-muted">${comment.ci}</small>
                                                <small class="text-muted">${comment.nombre} ${comment.lastname}</small>
                                            </p>
                                        </div>
                                    </div>`
      })
    }

    const bandera = (direction) => {

      const select__pais = direction.split("-")
      const params = {
        index: select__pais[1],
        pais: select__pais[0],
        cuidad: select__pais[2]
      }

      return `<img
                        src="${host}/banderas/${params.index}.png"
                        width="20"
                        alt="${params.pais}"
                        title="${params.pais}">&nbsp;${params.cuidad}`
    }

    const mapStudentsDash = students => {
      // console.log(students[0][0].payTotal);
      students.map(std => {

        div__tb_students_sales.innerHTML += `<tr>
                                              <td>
                                                  <h5 class="font-14 my-1 fw-normal">${std.nombre} ${std.estudiante}</h5>
                                                  <span class="text-muted font-13">${bandera(std.direccion)}</span>
                                              </td>
                                              <td>
                                                  <h5 class="font-14 my-1 fw-normal">${parseFloat(std[0].payTotal).toFixed(2)}</h5>
                                                  <span class="text-muted font-13">Monto pagado</span>
                                              </td>
                                          </tr>`
      })
    }


    const getIndicatorsAll = async () => {
      const post = await fetch('<?= base_url('topStudentsMayorSales') ?>', {
        method: "POST"
      })
      const res = await post.json()

      mapStudentsDash(res.data)
      maqGrafic(res.grafica)
      mapComments(res.comments[0])
    }

    getIndicatorsAll()

    const d = new Date();
    const today = d.toLocaleDateString('en-US')

    const div_item = document.querySelector('#item');
    const fragment = document.createDocumentFragment();

    const panel = document.querySelector('#panel_control');

    const indicators = document.querySelectorAll('#panel_control h3');
    const [i_libros, i_estudiantes, i_perdidas, i_ventas] = [...indicators];
    i_ventas.textContent = "$0"

    const div_i_ventas = document.querySelector('#indicators_sales');



    const indicadores = async () => {
      try {
        const post = await fetch('<?= base_url('/indicadores') ?>', {
          method: "POST"
        })
        const res = await post.text()

        const [books, loss, students, ventas] = await res.split('-');
        i_libros.textContent = books
        i_estudiantes.textContent = students
        i_perdidas.textContent = loss
        i_ventas.textContent = "$" + ventas
      } catch (error) {
        console.log(error)
      }
    }
    indicadores()


    const toastr = (info, text, item) => {
      return $.NotificationApp.send(
        `${info}`,
        `${text}`,
        "top-center",
        "rgba(0,0,0,0.2)",
        `${item}`
      );
    }

    const pdf = ({
      element,
      filename,
      format = 'legal',
      orientation = 'landscape'
    }) => {
      html2pdf(element, {
        margin: 0.2,
        filename: `${filename}.pdf`,
        image: {
          type: 'jpeg',
          quality: 0.98
        },
        html2canvas: {
          scale: 2
        },
        jsPDF: {
          unit: 'in',
          format: `${format}`,
          orientation: `${orientation}`
        }
      });
    }

    // const logo = ()
    const setNotif = async () => {
      try {
        const postNotif = await fetch('<?= base_url('/toast') ?>', {
          method: "POST"
        })
        const res_post = await postNotif.json()
        //await console.log(res_post)
        await res_post.map((object, i) => {
          if (object.date_okay === null) {
            let day1 = new Date(`${object.date_orden}`);
            let day2 = new Date(`${today}`);

            let difference = Math.abs(day2 - day1);
            days = difference / (1000 * 3600 * 24)
            // console.log(object.id)
            toastr("<h4><i class='uil-bell'></i> Notificacion</h4>", `Nuevas solicitudes de compra <i class='uil-chat-bubble-user'></i>`, "Info")
            const a = document.createElement('a')
            a.classList.add("noti", "dropdown-item", "notify-item")
            const div_a = document.createElement('div')
            const i_a = document.createElement('i')
            const p_a = document.createElement('p')
            const small_a = document.createElement('small')
            div_a.classList.add("notify-icon", "bg-danger")
            i_a.classList.add("uil-users-alt")
            p_a.classList.add("notify-details")
            small_a.classList.add("text-muted")
            p_a.textContent = `${object.nombre.toLowerCase()} ${object.lastname.toLowerCase()}`
            small_a.textContent = `${days} dias atras`

            div_a.appendChild(i_a)
            p_a.appendChild(small_a)
            a.appendChild(div_a)
            a.appendChild(p_a)
            fragment.appendChild(a)
          }
        });
        await div_item.appendChild(fragment)
      } catch (error) {
        console.log(error)
      }
    }
    setNotif()

    const card_ventas = () => {
      document.querySelector('#ventaB').classList.remove('t-inactive')
      document.querySelector('#dash').classList.add('t-inactive')
      document.querySelector('#entrega').classList.add('t-inactive')
      document.querySelector('#estudiante').classList.add('t-inactive')
      document.querySelector('#libros').classList.add('t-inactive')
    }
    document.querySelector('#card_ventas').addEventListener('click', card_ventas);
    document.querySelector('#export').addEventListener('click', () => {
      pdf({
        element: panel,
        filename: "Informe general" /*orientation: "landscape" format: "tabloid"*/
      })
    })

    document.getElementById("e_std_sales").addEventListener("click", function() {

      html2canvas(document.querySelector('#top_estudiante_compras')).then(function(canvas) {

        saveAs(canvas.toDataURL(), 'top_estudiantes_compras.png');
      });
    });
    document.getElementById("grafica").addEventListener("click", function() {
      const indicadores = document.querySelector('#indicadores_grafica')

      html2canvas(document.querySelector('#average-sales')).then(function(canvas) {
        saveAs(canvas.toDataURL(), 'top_4_mejores_ventas_grafica.png');
      });
    });
    document.getElementById("indicadores_ventas").addEventListener("click", function() {
      html2canvas(document.querySelector('#indicators_sales')).then(function(canvas) {
        saveAs(canvas.toDataURL(), 'top_4_mejores_ventas_indicadores.png');
      });
    });


    function saveAs(uri, filename) {

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


    const grafica = (dat) => {
      !(function(o) {
        "use strict";

        function e() {
          (this.$body = o("body")), (this.charts = []);
        }
        (e.prototype.initCharts = function() {
          window.Apex = {
            chart: {
              parentHeightOffset: 0,
              toolbar: {
                show: !1
              }
            },
            grid: {
              padding: {
                left: 0,
                right: 0
              }
            },
            colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
          };
          var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"],
            t = o("#revenue-chart").data("colors");
          t && (e = t.split(","));
          var r = {
            chart: {
              height: 364,
              type: "line",
              dropShadow: {
                enabled: !0,
                opacity: 0.2,
                blur: 7,
                left: -7,
                top: 7
              },
            },
            dataLabels: {
              enabled: !1
            },
            stroke: {
              curve: "smooth",
              width: 4
            },
            series: [{
                name: "Current Week",
                data: [10, 20, 15, 25, 20, 30, 20]
              },
              {
                name: "Previous Week",
                data: [0, 15, 10, 30, 15, 35, 25]
              },
            ],
            colors: e,
            zoom: {
              enabled: !1
            },
            legend: {
              show: !1
            },
            xaxis: {
              type: "string",
              categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
              tooltip: {
                enabled: !1
              },
              axisBorder: {
                show: !1
              },
            },
            yaxis: {
              labels: {
                formatter: function(e) {
                  return e + "k";
                },
                offsetX: -15,
              },
            },
          };
          new ApexCharts(document.querySelector("#revenue-chart"), r).render();
          e = ["#727cf5", "#e3eaef"];
          (t = o("#high-performing-product").data("colors")) && (e = t.split(","));
          r = {
            chart: {
              height: 257,
              type: "bar",
              stacked: !0
            },
            plotOptions: {
              bar: {
                horizontal: !1,
                columnWidth: "20%"
              }
            },
            dataLabels: {
              enabled: !1
            },
            stroke: {
              show: !0,
              width: 2,
              colors: ["transparent"]
            },
            series: [{
                name: "Actual",
                data: [65, 59, 80, 81, 56, 89, 40, 32, 65, 59, 80, 81],
              },
              {
                name: "Projection",
                data: [89, 40, 32, 65, 59, 80, 81, 56, 89, 40, 65, 59],
              },
            ],
            zoom: {
              enabled: !1
            },
            legend: {
              show: !1
            },
            colors: e,
            xaxis: {
              categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
              ],
              axisBorder: {
                show: !1
              },
            },
            yaxis: {
              labels: {
                formatter: function(e) {
                  return e + "k";
                },
                offsetX: -15,
              },
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function(e) {
                  return "$" + e + "k";
                },
              },
            },
          };
          new ApexCharts(
            document.querySelector("#high-performing-product"),
            r
          ).render();
          e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"];
          (t = o("#average-sales").data("colors")) && (e = t.split(","));
          r = {
            chart: {
              height: 208,
              type: "donut"
            },
            legend: {
              show: !1
            },
            stroke: {
              colors: ["transparent"]
            },
            series: dat, //cantidad distribuida en 4 products
            labels: ["Aprobado", "Pagado", "Cancelado", "Esperando"], //nombres de los products
            colors: e,
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
                },
                legend: {
                  position: "bottom"
                }
              },
            }, ],
          };
          new ApexCharts(document.querySelector("#average-sales"), r).render();
        }),
        (e.prototype.initMaps = function() {
          0 < o("#world-map-markers").length &&
            o("#world-map-markers").vectorMap({
              map: "world_mill_en",
              normalizeFunction: "polynomial",
              hoverOpacity: 0.7,
              hoverColor: !1,
              regionStyle: {
                initial: {
                  fill: "#e3eaef"
                }
              },
              markerStyle: {
                initial: {
                  r: 9,
                  fill: "#727cf5",
                  "fill-opacity": 0.9,
                  stroke: "#fff",
                  "stroke-width": 7,
                  "stroke-opacity": 0.4,
                },
                hover: {
                  stroke: "#fff",
                  "fill-opacity": 1,
                  "stroke-width": 1.5
                },
              },
              backgroundColor: "transparent",
              markers: [{
                  latLng: [40.71, -74],
                  name: "New York"
                },
                {
                  latLng: [37.77, -122.41],
                  name: "San Francisco"
                },
                {
                  latLng: [-33.86, 151.2],
                  name: "Sydney"
                },
                {
                  latLng: [1.3, 103.8],
                  name: "Singapore"
                },
              ],
              zoomOnScroll: !1,
            });
        }),
        (e.prototype.init = function() {
          o("#dash-daterange").daterangepicker({
              singleDatePicker: !0
            }),
            this.initCharts(),
            this.initMaps();
        }),
        (o.Dashboard = new e()),
        (o.Dashboard.Constructor = e);
      })(window.jQuery),
      (function(t) {
        "use strict";
        t(document).ready(function(e) {
          t.Dashboard.init();
        });
      })(window.jQuery);

    }

    grafica()

  })
</script>