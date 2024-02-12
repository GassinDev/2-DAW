import React from 'react';
import { createRoot } from 'react-dom/client';
import Rutas from './components/rutas';
import Logo from './components/logo';
import NavBar from './components/navbar';

createRoot(document.getElementById('root')).render(
    <React.StrictMode>
        <Rutas/>
    </React.StrictMode>
);


createRoot(document.getElementById('logo')).render(
    <React.StrictMode>
        <Logo />
    </React.StrictMode>
);


