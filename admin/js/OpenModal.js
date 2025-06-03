function cargarModal(archivoHTML) {
  fetch("modals/" + archivoHTML)
    .then(response => response.text())
    .then(html => {
      const contenedor = document.getElementById('modal-container');
      contenedor.innerHTML = html;
      mostrarModal();
    });
}

function mostrarModal() {
  const modal = document.querySelector('.modal');
  if (modal) {
    modal.style.display = 'block';
  }
}

function cerrarModal() {
  const modal = document.querySelector('.modal');
  if (modal) {
    modal.style.display = 'none';
  }
}
