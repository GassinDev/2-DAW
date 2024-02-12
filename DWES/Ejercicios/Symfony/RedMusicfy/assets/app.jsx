import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './components/rutas';
import Logo from './components/logo';

createRoot(document.getElementById('root')).render(
    <React.StrictMode>
        <App/>
        <Logo/>
    </React.StrictMode>
);
