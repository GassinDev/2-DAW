import React, { useState} from 'react';
import Swal from 'sweetalert2';

const Login = () => {
    const [credenciales, setCredenciales] = useState({
        nombreUsuario: '',
        contrasena: ''
    });

    const handleChange = (event) => {
        const { name, value } = event.target;
        setCredenciales(prevCredenciales => ({
            ...prevCredenciales,
            [name]: value
        }));
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        fetch('http://localhost:3001/usuarios')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los usuarios');
                }
                return response.json();
            })
            .then(usuarios => {
                const usuarioEncontrado = usuarios.find(
                    usuario => usuario.nombreUsuario === credenciales.nombreUsuario && usuario.contrasena === credenciales.contrasena
                );

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
                Swal.fire({
                    title: '!Buenas ' + usuarioEncontrado.nombreUsuario + ' !',
                    background: 'url(https://media2.giphy.com/media/n9dOlVuMjXkm4/giphy.gif?cid=ecf05e47x5861v57lwv8o8n7o9q6enmwmoouy1n7u5j4pcb2&ep=v1_gifs_related&rid=giphy.gif&ct=g)',
                    confirmButtonText: 'OK',
                    customClass: {
                        container: 'exito-swal-container',
                        title: 'my-swal-title',
                        confirmButton: 'my-swal-confirm-button',
                    },
                });
            })
    };

    return (
        <div className='contenedor-formulario'>
            <form onSubmit={handleSubmit} className='formulario-custom'>
                <h2>Iniciar Sesión</h2>
                <div>
                    <label>Nombre de usuario:</label>
                    <input type="text" name="nombreUsuario" value={credenciales.nombreUsuario} onChange={handleChange} />
                </div>
                <div>
                    <label>Contraseña:</label>
                    <input type="password" name="contrasena" value={credenciales.contrasena} onChange={handleChange} />
                </div>
                <button type="submit" className='btn-custom'>Iniciar Sesión</button>
            </form>
        </div>
    );
};

export default Login;