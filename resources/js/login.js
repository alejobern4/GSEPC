const btnRegistrar = document.getElementById('btn-registrar');
const btnIniciar = document.getElementById('btn-iniciar');
const container = document.getElementById('container');

btnRegistrar.addEventListener('click', () => {
  container.classList.add("right-panel-active");
});

btnIniciar.addEventListener('click', () => {
  container.classList.remove("right-panel-active");
});