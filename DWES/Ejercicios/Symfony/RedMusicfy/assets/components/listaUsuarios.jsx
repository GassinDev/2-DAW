import '../styles/app.css';
import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import Card from 'react-bootstrap/Card';
import { motion } from 'framer-motion';


function ListadoUsuarios() {
    const [usuarios, setUsuarios] = useState([]);

    useEffect(() => {
        const fetchUsuarios = async () => {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/ListadoUsuarios');
                if (!response.ok) {
                    throw new Error('Failed to fetch data');
                }
                const data = await response.json();
                setUsuarios(data);
            } catch (error) {
                console.error(error);
            }
        };

        fetchUsuarios();
    }, []);

    return (
        <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            transition={{ duration: 2 }}
            className="row row-cols-1 row-cols-md-3 g-4"
        >
            {usuarios.map((user, index) => (
                <motion.div className="col" key={index} whileHover={{ scale: 1.1 }}>
                    <Card>
                        <Card.Img
                            variant="top"
                            src={"uploads/images/" + user.fotoPerfil}
                            alt="portada"
                            style={{ height: "500px", objectFit: "cover" }}
                        />
                        <Card.Body>
                            <Card.Title>{user.username}</Card.Title>
                        </Card.Body>
                    </Card>
                </motion.div>
            ))}
        </motion.div>
    );
}

export default ListadoUsuarios;
