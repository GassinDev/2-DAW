import React, { useState } from 'react';
import { Card } from 'react-bootstrap';
import personajesDatos from '../data/personajes.json';
import ProgressBar from 'react-bootstrap/ProgressBar';

// Componente para mostrar los personajes del json
const ListaPersonajes = () => {

    // Declaración de estados utilizando useState
    const [personajeSeleccionado, setPersonajeSeleccionado] = useState(null); // Estado para el personaje seleccionado
    const [filtroEstilo, setFiltroEstilo] = useState(''); // Estado para el filtrado por estilos
    const [filtroNombre, setFiltroNombre] = useState(''); // Estado para el filtrado por nombres

    // Manejador de evento para seleccionar un personaje
    const handleSeleccionarPersonaje = (index) => {
        if (personajeSeleccionado === index) {
            // Desselecciona el personaje si ya estaba seleccionado
            setPersonajeSeleccionado(null);
        } else {
            // Selecciona el personaje
            setPersonajeSeleccionado(index); 
        }
    };

    // Manejador de evento para filtrar por estilo
    const handleFiltrarPorEstilo = (estilo) => {
        // Establece el filtro de estilo o lo borra si ya estaba aplicado
        setFiltroEstilo(estilo === filtroEstilo ? '' : estilo); 
    };

    // Manejador de evento para filtrar por nombre
    const handleFiltrarPorNombre = (nombre) => {
        // Establece el filtro de nombre
        setFiltroNombre(nombre); 
    };

    // Manejador de evento para limpiar todos los filtros para el boton de Mostrar Todos
    const handleLimpiarFiltros = () => {
        // Borra el filtro de estilo
        setFiltroEstilo('');
        // Borra el filtro de nombre
        setFiltroNombre(''); 
    };

    // Filtra los personajes con cualquier filtro aplicado.
    const personajesFiltrados = personajesDatos.personajes.filter(personaje => {
        return (filtroEstilo === '' || personaje.estilo === filtroEstilo) && // Filtra por estilo si está definido
            (filtroNombre === '' || personaje.nombre.toLowerCase().includes(filtroNombre.toLowerCase())); // Filtra por nombre si está definido
    });

    return (
        <div style={{ marginRight: '15px', marginLeft: '15px' }}>
            <h2>Personajes de 2XKO</h2>
            {/* Botones para filtrar por estilo */}
            <div className='mb-5 text-center'>
                <button className={filtroEstilo === '' ? 'elegido' : 'btn-customPerso'} onClick={handleLimpiarFiltros}>Mostrar Todos</button>
                <button className={filtroEstilo === 'Tanque' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Tanque')}>Tanques</button>
                <button className={filtroEstilo === 'Tirador' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Tirador')}>Tiradores</button>
                <button className={filtroEstilo === 'Luchador' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Luchador')}>Luchadores</button>
                {/* Campo de búsqueda para filtrar por nombre */}
                <input type="text" className='buscador-custom' placeholder="Buscar" onChange={(e) => handleFiltrarPorNombre(e.target.value)} />
            </div>
            {/* Contenedor para mostrar los personajes filtrados */}
            <div className='distribucion'>
                {personajesFiltrados.map((personaje, index) => (
                    <Card
                        key={index}
                        className={`designCard ${personajeSeleccionado === index ? 'seleccionado' : ''}`}
                        onClick={() => handleSeleccionarPersonaje(index)}
                    >
                        {/* Contenido de cada tarjeta de personaje */}
                        <div className="position-relative">
                            <Card.Img variant="top" src={personaje.foto} alt={personaje.nombre} />
                            {/* Overlay que muestra las estadísticas del personaje al seleccionarlo */}
                            {personajeSeleccionado === index && (
                                <div className="overlay">
                                    <div>
                                        <h5>Estadísticas</h5>
                                        <p>Vida: <ProgressBar animated variant="success" now={personaje.vida} /></p>
                                        <p>Ataque: <ProgressBar animated variant="danger" now={personaje.ataque} /></p>
                                        <p>Defensa: <ProgressBar animated variant="info" now={personaje.defensa} /></p>
                                    </div>
                                </div>
                            )}
                        </div>
                        <Card.Body>
                            <Card.Title className='nombre titulo-custom'>{personaje.nombre}</Card.Title>
                            <Card.Text>
                                Estilo: {personaje.estilo}
                            </Card.Text>
                        </Card.Body>
                    </Card>
                ))}
            </div>
        </div>
    );
};

export default ListaPersonajes;