import React from 'react';

const Navbar = () => {
    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark" style={{ marginBottom: '40px' }}>
            <div className="container">
                <a className="navbar-brand text-white" href="/">
                    <img src="img/logo.png" alt="Logo" height="30" className="d-inline-block align-top" />
                    Red Musicfy
                </a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarNav">
                    <ul className="navbar-nav">
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/verCanciones">Canciones</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/verUsuarios">Usuarios</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}

export default Navbar;



