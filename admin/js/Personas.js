function getPersonas() {

  fetch('/bookroute/api/controllers/personas_controller.php')
    .then(response => response.json())
    .then(data => {
      const selectPersonas = document.getElementById('personas-selector');

      if (selectPersonas) {
        data.forEach(persona => {
          const optionElement = document.createElement('option');
          optionElement.value = persona.id;
          optionElement.textContent = `${persona.pri_nom} ${persona.pri_ape}`;
          selectPersonas.appendChild(optionElement);
        });
      } else {
        console.error('Element with ID "personas" not found');
      }
    })
    .catch(error => console.error('Error:', error));

}