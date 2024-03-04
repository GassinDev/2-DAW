import React from 'react';

// Apartado con información del usuario

const DatosUsuario = () => {
    const sesion = JSON.parse(sessionStorage.getItem('sesion'));

    return (
        <div className='fondoPerfil'>
            <h1 className='namePerfil nombre'>{sesion.usuario.nombreUsuario}</h1>
            <img className='fotoPerfil img-fluid' src={sesion.usuario.fotoPerfil} alt="" />
        </div>
    );
};


export default DatosUsuario;