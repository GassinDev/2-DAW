import React from 'react';
import ListaPersonajes from '../components/ListaPersonajes';

const VerPersonajes = () => {

    if (!sessionStorage.getItem('sesion')) {
        window.location.href = '/InicioSesion';
    }

    return (
        <div>
            <ListaPersonajes/>
        </div>
    );
};

export default VerPersonajes;