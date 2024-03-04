import React from 'react';

// Ventana de error por si no se encuentra la ruta

const Error = () => {
    return (
        <div className='error-div'>
            <h2 className='error'>ERROR</h2>
            <p className='error' >Página no encontrada</p>
            <img src="https://media1.giphy.com/media/9uIvoRPX6rCcyk5F0f/giphy.gif?cid=ecf05e473c541345lj6ojm1sf9v0ztsvwqkyoldq3ez13st1&ep=v1_gifs_related&rid=giphy.gif&ct=g" alt="error" />
        </div>
    );
};

export default Error;