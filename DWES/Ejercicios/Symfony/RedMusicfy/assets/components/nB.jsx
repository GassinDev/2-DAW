import React, { useState } from 'react';

const Navbar = () => {
    const [searchTerm, setSearchTerm] = useState('');

    const handleSearch = (event) => {
        setSearchTerm(event.target.value);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        // Aquí puedes realizar la lógica para manejar la búsqueda
        console.log('Buscando por:', searchTerm);
    };

    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark" style={{ marginBottom: '40px' }}>
            <div className="container">
                <a className="navbar-brand d-flex align-items-center text-white" href="/">
                    <img src="../img/logo.png" alt="Logo" height="30" className="" />
                    Red Musicfy
                </a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/verCanciones">Canciones</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/verUsuarios">Usuarios</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/login">Admin</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/login">Login</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/cliente/new">Registrarse</a>
                        </li>
                    </ul>
                    <form className="d-flex ms-auto" onSubmit={handleSubmit}>
                        <input
                            className="form-control me-2"
                            type="search"
                            placeholder="Buscar..."
                            aria-label="Buscar"
                            value={searchTerm}
                            onChange={handleSearch}
                        />
                        <button className="btn btn-outline-light" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </nav>
    );
}

export default Navbar;


