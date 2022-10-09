<script>
  $(document.getElementById('dash')).ready(function() {


    const d = new Date();
    const today = d.toLocaleDateString('en-US')


    let arr1 = ["primary", "success", "danger", "info", "warning"];

    let icons = ['uil-user-plus', 'uil-user-circle', 'uil-user-square', 'uil-user-exclamation', 'uil-users-alt'];




    // console.log(days)


    const toastr = (info, text, item) => {
      return $.NotificationApp.send(
        `${info}`,
        `${text}`,
        "top-center",
        "rgba(0,0,0,0.2)",
        `${item}`
      );
    }

    // const logo = ()
    const setNotif = async () => {
      try {
        const postNotif = await fetch('<?= base_url('/toast') ?>', {
          method: "POST"
        })
        const res_post = await postNotif.json()
        await console.log(res_post)
        await res_post.map((object, i) => {
          if (object.date_okay === null) {
            let day1 = new Date(`${object.date_orden}`);
            let day2 = new Date(`${today}`);

            let difference = Math.abs(day2 - day1);
            days = difference / (1000 * 3600 * 24)
            // console.log(object.id)
            toastr("<h4><i class='uil-bell'></i> Notificacion</h4>", `Nuevas solicitudes de compra <i class='uil-chat-bubble-user'></i>`, "Info")
            document.querySelector('#item').innerHTML += `<a href="#" class="noti dropdown-item notify-item">
                                                              <div class="notify-icon bg-${arr1[i]}">
                                                                  <i class="${icons[i]}"></i>
                                                              </div>
                                                              <p class="notify-details">${object.nombre.toLowerCase()} ${object.lastname.toLowerCase()}
                                                                  <small class="text-muted">${days} d&iacute;as atras</small>
                                                              </p>
                                                          </a>`;
          }
        });
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

  })
</script>