import React, { useState } from 'react';
import Swal from 'sweetalert2';

const Registro = () => {
    const [usuario, setUsuario] = useState({
        nombreUsuario: '',
        contrasena: ''
    });

    const handleChange = (event) => {
        const { name, value } = event.target;
        setUsuario(prevUsuario => ({
            ...prevUsuario,
            [name]: value
        }));
    };

    const handleSubmit = (event) => {
        event.preventDefault();
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
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al registrar el usuario');
            });
    };

    return (
        <div className='contenedor-formulario'>
            <form onSubmit={handleSubmit} className='formulario-custom'>
                <h2>Registro de Usuario</h2>
                <div>
                    <label>Nombre de usuario:</label>
                    <input type="text" name="nombreUsuario" value={usuario.nombreUsuario} onChange={handleChange} />
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input type="password" name="contrasena" value={usuario.contrasena} onChange={handleChange} />
                </div>
                <button type="submit" className='btn-custom'>Registrarse</button>
            </form>
        </div>
    );
};

export default Registro;