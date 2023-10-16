class Producto {
  constructor(nombre, precio, cantidad) {
    this.nombre = nombre;
    this.precio = precio;
    this.cantidad = cantidad;
  }

  get nombre() {
    return this.nombre;
  }

  set nombre(nombre) {
    this.nombre = nombre;
  }

  get precio() {
    return this.precio;
  }

  set precio(precio) {
    this.precio = precio;
  }

  get cantidad() {
    return this._cantidad;
  }

  set cantidad(cantidad) {
    this.cantidad = cantidad;
  }
}

let listaProductos = [];

const productosGuardados = localStorage.getItem('listaProductos');

if (productosGuardados) {
  listaProductos = JSON.parse(productosGuardados);
}

function guardarProductosEnLocalStorage() {
  localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
}

function introducirProducto() {
  let nombre = document.getElementById("nombre").value;
  let precio = parseInt(document.getElementById("precio").value);
  let cantidad = parseInt(document.getElementById("cantidad").value);

  let producto = new Producto(nombre, precio, cantidad);

  listaProductos.push(producto);

  guardarProductosEnLocalStorage();
  
  alert("Producto introducido con éxito");
}

function mostrarFormulario() {
  const formulario = document.getElementById("formulario");
  formulario.style.display = "block";
}

// Agregar un controlador de eventos al botón
const mostrarFormularioButton = document.getElementById(
  "mostrarFormularioButton"
);

mostrarFormularioButton.addEventListener("click", mostrarFormulario);

function mostrarLista(){
    listaProductos.forEach((producto) => document.write(`<h1>${verDatosProducto(producto)}</h1>`));
}

function verDatosProducto(producto){
    return `${producto.nombre} ${producto.precio}`;
}
