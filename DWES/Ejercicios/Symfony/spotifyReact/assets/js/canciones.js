import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

const Canciones = () => {
    const [canciones, setCanciones] = useState([]);

    useEffect(() => {
        fetch('/api/canciones')
            .then(response => response.json())
            .then(data => setCanciones(data))
            .catch(error => console.error('Error al obtener las canciones:', error));
    }, []);

    return (
        <div>
            <h1>Lista de Canciones</h1>
            <ul>
                {canciones.map(cancion => (
                    <li key={cancion.id}>{cancion.title}</li>
                ))}
            </ul>
        </div>
    );
};

export default Canciones;
