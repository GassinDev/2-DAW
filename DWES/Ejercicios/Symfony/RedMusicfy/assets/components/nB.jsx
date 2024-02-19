import React, { useState } from 'react';

const Navbar = () => {

    // const [user, setUser] = useState(null);

    // useEffect(() => {
    //     fetch('/api/user/info')
    //         .then(response => response.json())
    //         .then(data => setUser(data));
    // }, []);

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
                            <a className="nav-link text-white" href="/login">Login</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link text-white" href="/register">Registrarse</a>
                        </li>
                        {/* {user && (
                            <li>
                                <a href="/miPerfil">{user.username}</a>
                                <a href="#" onClick={() => handleLogout()}>Cerrar sesión</a>
                            </li>
                        )} */}
                    </ul>
                </div>
            </div>
        </nav>
    );
}

export default Navbar;


