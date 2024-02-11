import React, { useState, useEffect } from 'react';

function VerUsuarios() {
    const [usuarios, setUsuarios] = useState([]);

    useEffect(() => {
        const fetchUsuarios = async () => {
            try {
                const response = await fetch('https://randomuser.me/api/');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                setUsuarios(data.results);
            } catch (error) {
                console.error(error);
            }
        };

        fetchUsuarios();
    }, []);

    return (
        <div>
            <h1>Ejercicio 5 - Nombres Usuarios + foto</h1>
            <ul>
                {usuarios.map((usuario, index) => (
                    <li key={index}>
                        Name: {usuario.name.first} {usuario.name.last}<br />
                        <img src={`img/${usuario.gender === 'male' ? 'hombre.png' : 'mujer.png'}`} alt={`photo ${usuario.gender}`} width={"300px"}/>
                    </li>
                ))}
            </ul>
        </div>
    );
}

export default VerUsuarios;
