import React, { useState } from 'react';
import { Card } from 'react-bootstrap';
import personajesDatos from '../data/personajes.json';
import ProgressBar from 'react-bootstrap/ProgressBar';

const ListaPersonajes = () => {
    const [personajeSeleccionado, setPersonajeSeleccionado] = useState(null);
    const [filtroEstilo, setFiltroEstilo] = useState('');
    const [filtroNombre, setFiltroNombre] = useState('');

    const handleSeleccionarPersonaje = (index) => {
        if (personajeSeleccionado === index) {
            setPersonajeSeleccionado(null);
        } else {
            setPersonajeSeleccionado(index);
        }
    };

    const handleFiltrarPorEstilo = (estilo) => {
        setFiltroEstilo(estilo === filtroEstilo ? '' : estilo);
    };

    const handleFiltrarPorNombre = (nombre) => {
        setFiltroNombre(nombre);
    };

    const handleLimpiarFiltros = () => {
        setFiltroEstilo('');
        setFiltroNombre('');
    };

    const personajesFiltrados = personajesDatos.personajes.filter(personaje => {
        return (filtroEstilo === '' || personaje.estilo === filtroEstilo) &&
            (filtroNombre === '' || personaje.nombre.toLowerCase().includes(filtroNombre.toLowerCase()));
    });

    return (
        <div style={{ marginRight: '15px', marginLeft: '15px' }}>
            <h2>Personajes de 2XKO</h2>
            <div className='mb-5 text-center'>
                <button className={filtroEstilo === '' ? 'elegido' : 'btn-customPerso'} onClick={handleLimpiarFiltros}>Mostrar Todos</button>
                <button className={filtroEstilo === 'Tanque' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Tanque')}>Tanques</button>
                <button className={filtroEstilo === 'Tirador' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Tirador')}>Tiradores</button>
                <button className={filtroEstilo === 'Luchador' ? 'elegido' : 'btn-customPerso'} onClick={() => handleFiltrarPorEstilo('Luchador')}>Luchadores</button>
                <input type="text" className='buscador-custom' placeholder="Buscar" onChange={(e) => handleFiltrarPorNombre(e.target.value)} />
            </div>
            <div className='distribucion'>
                {personajesFiltrados.map((personaje, index) => (
                    <Card
                        key={index}
                        className={`designCard ${personajeSeleccionado === index ? 'seleccionado' : ''}`}
                        onClick={() => handleSeleccionarPersonaje(index)}
                    >
                        <div className="position-relative">
                            <Card.Img variant="top" src={personaje.foto} alt={personaje.nombre} />
                            {personajeSeleccionado === index && (
                                <div className="overlay">
                                    <div>
                                        <h5>Estadísticas</h5>
                                        <p>Vida: <ProgressBar  animated variant="success" now={personaje.vida} /></p>
                                        <p>Ataque: <ProgressBar animated variant="danger" now={personaje.ataque}/></p>
                                        <p>Defensa: <ProgressBar animated variant="info" now={personaje.defensa}/></p>
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