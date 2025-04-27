import 'bootstrap';
import 'bootstrap-icons';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';


window.Swal = Swal;

window.Alpine = Alpine;

function windowScroll() {
    const navbar = document.getElementById("navbar");
    if (
        document.body.scrollTop >= 50 ||
        document.documentElement.scrollTop >= 50
    ) {
        navbar.classList.add("nav-sticky");
    } else {
        navbar.classList.remove("nav-sticky");
    }
  }

  window.addEventListener('scroll', (ev) => {
    ev.preventDefault();
    windowScroll();
  })


Alpine.start();


