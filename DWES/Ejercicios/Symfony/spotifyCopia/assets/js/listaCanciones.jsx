// En tu componente React
import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Canciones = () => {
    const [canciones, setCanciones] = useState([]);

    useEffect(() => {
        axios.get('/api/verCanciones') // Ruta definida en Symfony
            .then(response => {
                setCanciones(response.data);
            })
            .catch(error => {
                console.error('Error al obtener datos desde la API:', error);
            });
    }, []);

    return (
        <div>
            {/* Renderiza los datos de canciones aquí */}
            {canciones.map(cancion => (
                <div key={cancion.id}>{cancion.nombre}</div>
            ))}
        </div>
    );
};

export default Canciones;
