import React, { useState } from 'react';

function UserData() {
    const [userId, setUserId] = useState('');
    const [userData, setUserData] = useState(null);
    const [error, setError] = useState(null);

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await fetch(`https://jsonplaceholder.typicode.com/users/${userId}`);
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            if (data) {
                setUserData(data);
                setError(null);
            } else {
                setUserData(null);
                setError('Usuario no encontrado');
            }
        } catch (error) {
            setUserData(null);
            setError('Error al buscar los datos del usuario');
        }
    };

    return (
        <div>
            <h1>Ejercicio 4 - Buscar por id los detalles de un usuario</h1>
            <form onSubmit={handleSubmit}>
                <label htmlFor="userId">Introduzca un ID (1 - 10): </label>
                <input
                    type="number"
                    id="userId"
                    name="userId"
                    min="1"
                    max="10"
                    value={userId}
                    onChange={(e) => setUserId(e.target.value)}
                    required
                />
                <button type="submit">Buscar Usuario</button>
            </form>
            {userData && (
                <div>
                    <h2>Detalles del Usuario </h2>
                    <p>Name: {userData.name}</p>
                    <p>Username: {userData.username}</p>
                    <p>Email: {userData.email}</p>
                    <p>Address: {userData.address.street}, {userData.address.suite}, {userData.address.city}, {userData.address.zipcode}</p>
                    <p>Geo: Lat:{userData.address.geo.lat} - Lng:{userData.address.geo.lng}</p>
                </div>
            )}
            {error && <p>{error}</p>}
        </div>
    );
}

export default UserData;

