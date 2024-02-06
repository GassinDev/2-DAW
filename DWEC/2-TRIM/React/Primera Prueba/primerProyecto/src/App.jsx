import { useState } from "react";
import "./App.css";
import { TwitterFollowCard } from "./TwitterFollowCard";


const users = [
    {
        username: 'gassindev',
        name: 'Juan José',
        isFollowing: true
    },
    {
        username: 'pepito',
        name: 'Pepe Jose',
        isFollowing: false
    },
    {
        username: 'maquitos',
        name: 'Manolo Perez',
        isFollowing: true
    }
]

export function App() {
    return (
        <section className="App">
            {
                users.map(({ username, name, isFollowing }) => (

                    <TwitterFollowCard
                    key={username}
                        username={username}
                        initialIsFollowing={isFollowing}
                    >
                        {name}
                    </TwitterFollowCard>

                ))
            }
        </section>
    );
}
