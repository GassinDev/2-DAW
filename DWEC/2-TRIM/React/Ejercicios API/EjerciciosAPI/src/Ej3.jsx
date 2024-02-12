import React, { useState, useEffect } from 'react';

function datosPais() {
    const [datos, setDatos] = useState(null);

    useEffect(() => {
        const fetchDatos = async () => {
            try {
                const response = await fetch('https://freegeoip.app/json/');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                setDatos(data);
            } catch (error) {
                console.error(error);
            }
        };

        fetchDatos();
    }, []);

    return (
        <div>
            <h1>Ejercicio 3 - Datos Argentina</h1>
            {datos && (
                <ul>
                    <li>{datos.country_name}, CIUDAD: {datos.city}, C/P: {datos.zip_code}, IP: {datos.ip}</li>
                </ul>
            )}
        </div>
    );
}

export default datosPais;
