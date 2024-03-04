import React, { useState } from 'react';
import Swal from 'sweetalert2'; 

// Componente para registro de usuarios

const Registro = () => {

    // Estado para almacenar los datos del usuario
    const [usuario, setUsuario] = useState({
        nombreUsuario: '', 
        contrasena: '', 
        fotoPerfil: '' // Enlace de la foto de perfil (generado aleatoriamente)
    });

    // Manejador de evento para actualizar los datos del usuario cuando cambian los campos del formulario
    const handleChange = (event) => {
        const { name, value } = event.target;
        setUsuario(prevUsuario => ({
            ...prevUsuario,
            [name]: value
        }));
    };

    // Función para generar un número aleatorio para el enlace de la foto de perfil
    const generarNumeroAleatorio = () => {
        return Math.floor(Math.random() * 200) + 1; // Genera un número aleatorio entre 1 y 200
    };

    // Manejador de evento para enviar el formulario de registro
    const handleSubmit = (event) => {
        event.preventDefault(); 

        // Genera un número aleatorio para el enlace de la foto de perfil
        const randomNumber = generarNumeroAleatorio();
        const fotoPerfil = `https://prod.api.assets.riotgames.com/public/v1/asset/lol/14.3.1/CHAMPION/${randomNumber}/ICON`;

        // Crea un nuevo objeto de usuario con el enlace de la foto de perfil generado
        const usuarioConFotoPerfil = { ...usuario, fotoPerfil };

        // Realiza una petición POST para registrar al usuario
        fetch('http://localhost:3001/usuarios', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            // Envía los datos del usuario con el enlace de la foto de perfil
            body: JSON.stringify(usuarioConFotoPerfil) 
        })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Error al registrar el usuario');
                }
            })
            .then(data => {
                // Muestra un mensaje de éxito al usuario
                Swal.fire({
                    title: 'Registrado con éxito',
                    background: 'url("https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExMTVodTVkOHk2MXIyd20xNmx2cDJlbnhzeXhvZm9qM3R4ZG41aTg2ZCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/8a9dtmjMI6yu7s55xc/giphy.gif")',
                    confirmButtonText: 'OK',
                    customClass: {
                        container: 'exito-swal-container',
                        title: 'my-swal-title',
                        confirmButton: 'my-swal-confirm-button',
                    },
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