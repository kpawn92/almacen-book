<script>
  $(document.getElementById('dash')).ready(function() {

    const d = new Date();
    const today = d.toLocaleDateString('en-US')

    const div_item = document.querySelector('#item');
    const fragment = document.createDocumentFragment();

    const print = document.querySelector('#panel_control');

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

    const pdf = ({element, filename, format = 'letter', orientation = 'portrait'}) => {
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
        await console.log(res_post)
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
        div_item.appendChild(fragment)
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
      pdf({element: print, filename: "Informe general" /*orientation: "landscape" format: "tabloid"*/})
    })

  })
</script>