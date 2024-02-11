import React, { useState, useEffect } from 'react';

function Formulario() {

    const [descripcion, setDescripcion] = useState('');
    const [precio, setPrecio] = useState('');
    const [jsonContent, setJsonContent] = useState([]);

    const handleSubmit = (e) => {
        e.preventDefault();

        const automaticCode = jsonContent.length + 1;

        const nuevoJsonItem = {
            code: automaticCode,
            descripcion: descripcion,
            precio: precio
        };

        setJsonContent([...jsonContent, nuevoJsonItem]);

        setDescripcion('');
        setPrecio('');
    };


    return (
        <div className="container m-0">
            <h1 className="mt-4">Ejercicio 6 - Formulario</h1>
            <form onSubmit={handleSubmit} className="mt-4">
                <div className="form-group">
                    <label htmlFor="descripcion" className='mt-1 mb-1'>Descripción:</label><br/>
                    <input type="text" id="descripcion" value={descripcion} onChange={(e) => setDescripcion(e.target.value)} className="form-control-sm m-" required />
                </div>
                <div className="form-group">
                    <label htmlFor="precio" className='mt-1 mb-1'>Precio:</label><br/>
                    <input type="number" id="precio" value={precio} onChange={(e) => setPrecio(e.target.value)} className="form-control-sm" required />
                </div>
                <button type="submit" className="btn btn-primary mt-2">Nuevo Artículo</button>
            </form>
            <table className="table mt-2">
                <thead className="thead-dark">
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    {jsonContent.map((item, index) => (
                        <tr key={index}>
                            <td>{item.code}</td>
                            <td>{item.descripcion}</td>
                            <td>{item.precio}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

    export default Formulario;