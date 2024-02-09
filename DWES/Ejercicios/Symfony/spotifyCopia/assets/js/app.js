// import React from 'react';
// import ReactDOM from 'react-dom';

// const App = ({ prop1, prop2 }) => (
//     React.createElement('div', null,
//         React.createElement('h1', null, `${prop1} ${prop2}!`)
//     )
// );

// const root = document.getElementById('root');

// ReactDOM.render(
//     React.createElement(App, { prop1: 'Hola', prop2: 'Mundo' }),
//     root
// );
import React from 'react';

const App = ({ canciones }) => (
    <div>
        <h1>Elementos de la tabla</h1>
        <ul>
            {canciones.map((cancion, index) => (
                <li key={index}>{cancion.title}</li>
            ))}
        </ul>
    </div>
);

export default App;