const formulario = document.getElementById('formulario_modificar_usuario');
formulario.addEventListener('submit', (event) => {
  event.preventDefault();

  id = formulario.elements['id'];
  persona = formulario.elements['persona'];
  correo = formulario.elements['correo'];
  password = formulario.elements['password'];
  rol = formulario.elements['rol'];

  modificarUsuario(id, persona, correo, password, rol);
})


function modificarUsuario(id, persona, correo, password, rol) {
  setTimeout(() => {
    alert(id, persona, correo, password, rol);
  }, 1000)
}
