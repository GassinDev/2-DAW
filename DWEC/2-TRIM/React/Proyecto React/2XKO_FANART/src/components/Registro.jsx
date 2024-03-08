import React, { useState } from 'react';
import Swal from 'sweetalert2';

const Registro = () => {
    // Estado para almacenar los datos del usuario
    const [usuario, setUsuario] = useState({
        nombreUsuario: '',
        contrasena: '',
        fotoPerfil: ''
    });

    // Función para manejar cambios en los inputs del formulario
    const handleChange = (event) => {
        const { name, value } = event.target;
        setUsuario(prevUsuario => ({
            ...prevUsuario,
            [name]: value
        }));
    };

    // Función para generar un número aleatorio que se utilizará para obtener la foto de perfil
    const generarNumeroAleatorio = () => {
        return Math.floor(Math.random() * 200) + 1;
    };

    // Función para manejar el envío del formulario
    const handleSubmit = (event) => {
        event.preventDefault();
        const randomNumber = generarNumeroAleatorio();
        const fotoPerfil = `https://prod.api.assets.riotgames.com/public/v1/asset/lol/14.3.1/CHAMPION/${randomNumber}/ICON`;
        const usuarioConFotoPerfil = { ...usuario, fotoPerfil };

        // Verificar si el usuario ya existe antes de enviar la solicitud de registro
        fetch(`http://localhost:3001/usuarios?nombreUsuario=${usuario.nombreUsuario}`)
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al verificar el usuario');
                }
            })
            .then(data => {
                if (data.length === 0) {
                    // Usuario no existe, procede con el registro
                    registrarUsuario(usuarioConFotoPerfil);
                } else {
                    // Usuario ya existe, muestra un mensaje de error
                    Swal.fire({
                        title: 'Usuario existente',
                        background: 'url("https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExa2VuNXJhOHhheXN0MmN3N2xkdXBlYnpyYm95dzdnZDhxdWY3bHM5ciZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/QWMNhFtiHL9qAGyZkL/giphy.gif")',
                        confirmButtonText: 'OK',
                        customClass: {
                            container: 'exito-swal-container',
                            title: 'my-swal-title',
                            confirmButton: 'my-swal-confirm-button',
                        },
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };

    // Función para realizar el registro del usuario
    const registrarUsuario = (usuario) => {
        fetch('http://localhost:3001/usuarios', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(usuario)
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al registrar el usuario');
                }
            })
            .then(data => {
                Swal.fire({
                    title: 'Registrado con éxito',
                    background: 'url("https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExMTVodTVkOHk2MXIyd20xNmx2cDJlbnhzeXhvZm9qM3R4ZG41aTg2ZCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/8a9dtmjMI6yu7s55xc/giphy.gif")',
                    confirmButtonText: 'OK',
                    customClass: {
                        container: 'exito-swal-container',
                        title: 'my-swal-title',
                        confirmButton: 'my-swal-confirm-button',
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/InicioSesion';
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };

    return (
        <div className='contenedor-formulario'>
            <form onSubmit={handleSubmit} className='formulario-custom'>
                <h2>Registro de Usuario</h2>
                <div>
                    <label>Nombre de usuario:</label>
                    <input className="m-3" type="text" name="nombreUsuario" value={usuario.nombreUsuario} onChange={handleChange} />
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input className="m-3" type="password" name="contrasena" value={usuario.contrasena} onChange={handleChange} />
                </div>
                <button type="submit" className='btn-custom'>Registrarse</button>
            </form>
        </div>
    );
};

export default Registro;
