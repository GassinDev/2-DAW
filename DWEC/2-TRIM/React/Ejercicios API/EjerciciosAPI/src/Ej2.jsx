import React, { useState, useEffect } from 'react';

function ProvinciasArgentinas() {
    const [provincias, setProvincias] = useState([]);

    useEffect(() => {
        const fetchProvincias = async () => {
            try {
                const response = await fetch('https://apis.datos.gob.ar/georef/api/provincias');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                setProvincias(data.provincias);
            } catch (error) {
                console.error(error);
            }
        };

        fetchProvincias();
    }, []);

    return (
        <div>
            <h2>Ejercicio 2 - Lista de Provincias Argentinas</h2>
            <ul>
                {provincias.map((provincia, index) => (
                    <li key={index}>
                        <strong>{provincia.nombre}</strong>, Id: {provincia.id}, Centroide: {provincia.centroide.lat}, {provincia.centroide.lon}<br />
                        <br />
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default ProvinciasArgentinas;
