import React, { useState } from 'react';
import Swal from 'sweetalert2';

// Componente para el inicio de sesion

const Login = () => {

    // Estado para almacenar las credenciales del usuario (nombre de usuario y contraseña)
    const [credenciales, setCredenciales] = useState({
        nombreUsuario: '',
        contrasena: ''
    });

    // Manejador de evento para actualizar las credenciales cuando cambian los campos del formulario
    const handleChange = (event) => {
        const { name, value } = event.target;
        setCredenciales(prevCredenciales => ({
            ...prevCredenciales,
            [name]: value
        }));
    };

    // Manejador de evento para enviar el formulario de inicio de sesión
    const handleSubmit = (event) => {
         // Evita que se recargue la página al enviar el formulario
        event.preventDefault();

        // Petición para obtener los usuarios desde la API de mi jsonServer
        fetch('http://localhost:3001/usuarios')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los usuarios');
                }
                return response.json();
            })
            .then(usuarios => {
                // Busca el usuario con las credenciales proporcionadas
                const usuarioEncontrado = usuarios.find(
                    usuario => usuario.nombreUsuario === credenciales.nombreUsuario && usuario.contrasena === credenciales.contrasena
                );

                // Si no se encuentra el usuario, muestra un mensaje de error
                if (!usuarioEncontrado) {
                    Swal.fire({
                        title: 'Datos incorrectos',
                        background: 'url(https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExejlrdHVqeGc3eGZ5anJhdTFwcjZhOGphcmFuY2EwcDcwd2UwN3hrdCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/aHoYl67CqH1CNAbzoP/giphy.gif)',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'error-swal-container',
                            title: 'my-swal-title',
                            confirmButton: 'my-swal-confirm-button',
                        },
                    });
                    return;
                }

                // Si se encuentra el usuario, guarda la sesión
                sessionStorage.setItem('sesion', JSON.stringify({ usuario: usuarioEncontrado }));

                // Muestra un mensaje de éxito al usuario
                Swal.fire({
                    title: '!Buenas ' + usuarioEncontrado.nombreUsuario + ' !',
                    background: 'url(https://media2.giphy.com/media/n9dOlVuMjXkm4/giphy.gif?cid=ecf05e47x5861v57lwv8o8n7o9q6enmwmoouy1n7u5j4pcb2&ep=v1_gifs_related&rid=giphy.gif&ct=g)',
                    confirmButtonText: 'OK',
                    customClass: {
                        container: 'exito-swal-container',
                        title: 'my-swal-title',
                        confirmButton: 'my-swal-confirm-button',
                    },
                }).then(() => {
                    // Si el usuario hace clic en el botón de confirmación, redirige al usuario a la página de inicio
                    window.location.href = '/';
                });

            })
            .catch(error => {
                // Maneja los errores de la petición para poder verlos en la consola del navegador
                console.error('Error:', error);
            });
    };

    return (
        <div className='contenedor-formulario'>
            <form onSubmit={handleSubmit} className='formulario-custom'>
                <h2>Iniciar Sesión</h2>
                <div>
                    <label>Nombre de usuario:</label>
                    <input className="m-3" type="text" name="nombreUsuario" value={credenciales.nombreUsuario} onChange={handleChange} />
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input className="m-3" type="password" name="contrasena" value={credenciales.contrasena} onChange={handleChange} />
                </div>
                <button type="submit" className='btn-custom'>Iniciar Sesión</button>
            </form>
        </div>
    );
};

export default Login;