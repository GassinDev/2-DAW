import React, { useState, useEffect } from 'react';
import { Card, Col, Row, Modal } from 'react-bootstrap';

const PartidasJugadas = () => {
    const [partidas, setPartidas] = useState([]);
    const [selectedImage, setSelectedImage] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await fetch('http://localhost:3002/partidas');
                const data = await response.json();
                setPartidas(data);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        fetchData();
    }, []);

    const handleImageClick = (imageSrc) => {
        setSelectedImage(imageSrc);
    };

    const handleCloseModal = () => {
        setSelectedImage(null);
    };

    return (
        <div className="container py-5" style={{ color: 'yellow' }}>
            <h2 className="text-center mb-4 nombre">Partidas Jugadas</h2>
            {partidas.map((partida, index) => (
                <Row key={index} className="mb-4 justify-content-center">
                    <Col lg={10}>
                        <Card className="text-center" style={{ backgroundColor: 'black', color: 'yellow', border: '2px solid yellow' }}>
                            <Card.Body>
                                <h4 className="mb-3">Partida {index + 1}</h4>
                                <Row>
                                    <Col lg={5} className="mb-3 mb-lg-0 d-flex flex-column align-items-center">
                                        <h5>Equipo Azul</h5>
                                        <div className="d-flex flex-wrap justify-content-center">
                                            {partida.equipoAzul.map((personaje, index) => (
                                                <img
                                                    key={index}
                                                    src={personaje.foto}
                                                    alt={personaje.nombre}
                                                    className="img-fluid rounded-circle mx-2 mb-2"
                                                    style={{ maxWidth: '70px', cursor: 'pointer' }}
                                                    onClick={() => handleImageClick(personaje.foto)}
                                                />
                                            ))}
                                        </div>
                                    </Col>
                                    <Col lg={2} className="d-flex align-items-center justify-content-center">
                                        <h1 className=''>VS</h1>
                                    </Col>
                                    <Col lg={5} className="d-flex flex-column align-items-center">
                                        <h5>Equipo Rojo</h5>
                                        <div className="d-flex flex-wrap justify-content-center">
                                            {partida.equipoRojo.map((personaje, index) => (
                                                <img
                                                    key={index}
                                                    src={personaje.foto}
                                                    alt={personaje.nombre}
                                                    className="img-fluid rounded-circle mx-2 mb-2"
                                                    style={{ maxWidth: '70px', cursor: 'pointer' }}
                                                    onClick={() => handleImageClick(personaje.foto)}
                                                />
                                            ))}
                                        </div>
                                    </Col>
                                </Row>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
            ))}
            <Modal show={selectedImage !== null} onHide={handleCloseModal} centered>
                <Modal.Body style={{ backgroundColor: 'yellow' }}>
                    <img src={selectedImage} alt="Selected" className="img-fluid" />
                </Modal.Body>
            </Modal>
        </div>
    );
};

export default PartidasJugadas;