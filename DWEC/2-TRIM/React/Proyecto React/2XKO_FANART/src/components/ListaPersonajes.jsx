import React, { useState } from 'react';
import { Card } from 'react-bootstrap';
import personajesDatos from '../data/personajes.json'; // Importa los datos de los personajes desde un archivo JSON
import ProgressBar from 'react-bootstrap/ProgressBar';

const ListaPersonajes = () => {
    const [personajeSeleccionado, setPersonajeSeleccionado] = useState(null); // Estado para el personaje seleccionado
    const [filtroEstilo, setFiltroEstilo] = useState(''); // Estado para el filtro de estilo
    const [filtroNombre, setFiltroNombre] = useState(''); // Estado para el filtro de nombre

    // Función para manejar la selección de un personaje
    const handleSeleccionarPersonaje = (index) => {
        if (personajeSeleccionado === index) {
            setPersonajeSeleccionado(null); // Si el personaje ya está seleccionado, deselecciónalo
        } else {
            setPersonajeSeleccionado(index); // Si no está seleccionado, selecciona el personaje con el índice proporcionado
        }
    };

    // Función para filtrar los personajes por estilo
    const handleFiltrarPorEstilo = (estilo) => {
        setFiltroEstilo(estilo === filtroEstilo ? '' : estilo); // Si el filtro de estilo coincide con el estilo actualmente seleccionado, desactiva el filtro
    };

    // Función para filtrar los personajes por nombre
    const handleFiltrarPorNombre = (nombre) => {
        setFiltroNombre(nombre); // Actualiza el estado del filtro de nombre
    };

    // Función para limpiar los filtros
    const handleLimpiarFiltros = () => {
        setFiltroEstilo(''); // Reinicia el estado del filtro de estilo
        setFiltroNombre(''); // Reinicia el estado del filtro de nombre
    };

    // Filtra los personajes según los filtros aplicados
    const personajesFiltrados = personajesDatos.personajes.filter(personaje => {
        return (filtroEstilo === '' || personaje.estilo === filtroEstilo) && // Filtra por estilo si está seleccionado
            (filtroNombre === '' || personaje.nombre.toLowerCase().includes(filtroNombre.toLowerCase())); // Filtra por nombre si está proporcionado
    });

    return (
        <div style={{ marginRight: '15px', marginLeft: '15px' }}>
            <h2>Personajes de 2XKO</h2>
            <div className='mb-5 text-center'>
                {/* Botones de filtro */}
                <button className={filtroEstilo === '' ? 'elegido' : 'btn-customPerso'} onClick={handleLimpiarFiltros}>Mostrar Todos</button>
                <button className={filtroEstilo === 'Tanque' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Tanque')}>Tanques</button>
                <button className={filtroEstilo === 'Tirador' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Tirador')}>Tiradores</button>
                <button className={filtroEstilo === 'Luchador' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Luchador')}>Luchadores</button>
                <input type="text" className='buscador-custom' placeholder="Buscar" onChange={(e) => handleFiltrarPorNombre(e.target.value)} />
            </div>
            <div className='distribucion'>
                {/* Mapea y renderiza los personajes filtrados */}
                {personajesFiltrados.map((personaje, index) => (
                    <Card
                        key={index}
                        className={`designCard ${personajeSeleccionado === index ? 'seleccionado' : ''}`}
                        onMouseEnter={() => handleSeleccionarPersonaje(index)} // Cambiar la imagen al pasar el ratón por encima
                        onMouseLeave={() => setPersonajeSeleccionado(null)} // Volver a la imagen original al sacar el ratón
                    >
                        <div className="position-relative">
                            <Card.Img variant="top" src={personajeSeleccionado === index ? personaje.gif : personaje.foto} alt={personaje.nombre} />
                            {/* Overlay de estadísticas */}
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