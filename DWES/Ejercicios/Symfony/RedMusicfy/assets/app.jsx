import React from 'react';
import { createRoot } from 'react-dom/client';
import Rutas from './components/rutas';
import Logo from './components/logo';
import ListaCanciones from './components/listaCanciones';
import NavigationBar from './components/navbar';
import Navbar from './components/nB';
import ListadoUsuarios from './components/listaUsuarios';


const rootElement = document.getElementById('navbar');
if (rootElement) {
    createRoot(rootElement).render(
        <React.StrictMode>
            <Navbar/>
        </React.StrictMode>
    );
}

const logoElement = document.getElementById('logo');
if (logoElement) {
    createRoot(logoElement).render(
        <React.StrictMode>
            <Logo />
        </React.StrictMode>
    );
}

const songElement = document.getElementById('canciones');
if (songElement) {
    createRoot(songElement).render(
        <React.StrictMode>
            <ListaCanciones />
        </React.StrictMode>
    );
}

const userElement = document.getElementById('usuarios');
if (userElement) {
    createRoot(userElement).render(
        <React.StrictMode>
            <ListadoUsuarios />
        </React.StrictMode>
    );
}



