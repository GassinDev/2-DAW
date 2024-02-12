import '../styles/app.css';
import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Card from 'react-bootstrap/Card';
import { motion } from 'framer-motion';


function ListaCanciones() {
    const [canciones, setCanciones] = useState([]);

    useEffect(() => {
        const fetchCanciones = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/ListadoCanciones');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                setCanciones(data);
            } catch (error) {
                console.error(error);
            }
        };

        fetchCanciones();
    }, []);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 2 }}
            className="row row-cols-1 row-cols-md-3 g-4"
        >
            {canciones.map((cancion, index) => (
                <motion.div className="col" key={index} whileHover={{ scale: 1.1 }}>
                    <Card>
                        <Card.Img
                            variant="top"
                            src={"uploads/images/" + cancion.fotoPortada}
                            alt="portada"
                            style={{ height: "500px", objectFit: "cover" }}
                        />
                        <Card.Body>
                            <Card.Title>{cancion.title}</Card.Title>
                        </Card.Body>
                    </Card>
                </motion.div>
            ))}
        </motion.div>
    );
}

export default ListaCanciones;


