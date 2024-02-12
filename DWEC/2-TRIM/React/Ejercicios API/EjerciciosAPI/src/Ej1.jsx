import React, { useState, useEffect } from 'react';

function listaPersonajes() {
  const [personajes, setPersonajes] = useState([]);

  useEffect(() => {
    const fetchPersonajes = async () => {
      try {
        const response = await fetch('https://swapi.dev/api/people/');
        if (!response.ok) {
          throw new Error('Failed to fetch data');
        }
        const data = await response.json();
        setPersonajes(data.results);
      } catch (error) {
        console.error(error);
      }
    };

    fetchPersonajes();
  }, []);

  return (
    <div>
      <h2>Ejercicio 1 - Lista de Personajes de Star Wars</h2>
      <ul>
        {personajes.map((personaje, index) => (
          <li key={index}>
            <strong>{personaje.name}</strong><br />
            Altura: {personaje.height}<br />
            Peso: {personaje.mass}<br />
            Color de cabello: {personaje.hair_color}<br />
            Color de piel: {personaje.skin_color}<br />
            Color de ojos: {personaje.eye_color}<br />
            Año de nacimiento: {personaje.birth_year}<br />
            Género: {personaje.gender}<br />
            <br />
          </li>
        ))}
      </ul>
    </div>
  );
}

export default listaPersonajes;
