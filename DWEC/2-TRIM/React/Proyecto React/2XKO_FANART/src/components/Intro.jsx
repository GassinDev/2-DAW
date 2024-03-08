import React, { useState, useEffect } from 'react';
import Imagen from '../images/intro.gif';

const Intro = () => {
    const [showOverlay, setShowOverlay] = useState(true);

    useEffect(() => {
        const timer = setInterval(() => {
            setShowOverlay(false); 
            clearInterval(timer);
        }, 2120);

        return () => clearInterval(timer); 
    }, []);

    return (
        <div className="intro-overlay" style={{ display: showOverlay ? 'flex' : 'none' }}>
            <img src={Imagen} alt="GIF de introducción" />
        </div>
    );
};

export default Intro;
