import React from 'react';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';

// Importación de las páginas y componentes necesarios
import Inicio from '../pages/Inicio';
import AcercaDe from '../pages/AcercaDe';
import AltaUsuarios from '../pages/AltaUsuarios';
import VerPersonajes from '../pages/VerPersonajes';
import InicioSesion from '../pages/InicioSesion';
import Error from './Error';
import Perfil from '../pages/Perfil';


// Componente para la barra de navegacion
function NB() {
    // Verifica si hay una sesión iniciada
    const sesionIniciada = !!sessionStorage.getItem('sesion');

    // Función para cerrar sesión
    const handleLogout = () => {
        // Elimina la sesión
        sessionStorage.removeItem("sesion"); 
        // Redirige al usuario a la página de inicio
        window.location.href = "/"; 
    };

    return (
        <Router>
            <Navbar expand="lg" className="navbar-custom">
                <Container>
                    <Navbar.Brand className='nombre titulo'>
                        <div className="logo-container">
                            <img src="https://media0.giphy.com/media/Uv39iy4kHkig4hDkWL/giphy.gif?cid=6c09b952ct979h1jfvzr3gr03tts4j4qtfzo3kwkqi5yg62o&ep=v1_internal_gif_by_id&rid=giphy.gif&ct=s" alt="bardo" className="logo-img" />
                            <span className="logo-text">2XKO</span>
                        </div>
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                            <Nav.Link as={Link} to="/" className='opcion'>Inicio</Nav.Link>
                            <Nav.Link as={Link} to="/AcercaDe" className='opcion'>Acerca de</Nav.Link>
                            {!sesionIniciada && <Nav.Link as={Link} to="/AltaUsuarios" className='opcion'>Alta de usuarios</Nav.Link>}
                            {!sesionIniciada && <Nav.Link as={Link} to="/InicioSesion" className='opcion'>Inicio de sesión</Nav.Link>}
                            {sesionIniciada && <Nav.Link as={Link} to="/VerPersonajes" className='opcion'>Ver Personajes</Nav.Link>}
                            {sesionIniciada && <Nav.Link as={Link} to="/Perfil" className='opcion'>Perfil</Nav.Link>}
                            {sesionIniciada && <Nav.Link className='opcion' onClick={handleLogout}>Cerrar sesión</Nav.Link>}
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
            <Routes>
                <Route path="/" element={<Inicio />} />
                <Route path="/AcercaDe" element={<AcercaDe />} />
                <Route path="/VerPersonajes" element={<VerPersonajes />} />
                <Route path="/AltaUsuarios" element={<AltaUsuarios />} />
                <Route path="/InicioSesion" element={<InicioSesion />} />
                <Route path="/Perfil" element={<Perfil />} />
                <Route path="*" element={<Error />} /> 
            </Routes>
        </Router>
    );
}

export default NB;