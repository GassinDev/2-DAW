import React, { useRef, useEffect } from 'react';
import * as THREE from 'three';
import { OBJLoader } from 'three/examples/jsm/loaders/OBJLoader.js';

const Logo = () => {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ clearColor: 0x00ff00 }); 
    renderer.setSize(window.innerWidth, window.innerHeight);

    const containerRef = useRef();

    useEffect(() => {
        containerRef.current.appendChild(renderer.domElement);

        const loader = new OBJLoader();

        loader.load(
            './IronMan.obj',
            function (object) {
                // Agrega el objeto a la escena
                scene.add(object);

                // Centra la cámara en el modelo
                const boundingBox = new THREE.Box3().setFromObject(object);
                const center = new THREE.Vector3();
                boundingBox.getCenter(center);
                camera.position.copy(center);
                camera.lookAt(object.position);

                // Renderiza la escena
                renderer.render(scene, camera);
            },
            function (xhr) {
                console.log((xhr.loaded / xhr.total) * 100 + '% loaded');
            },
            function (error) {
                console.error('Error loading OBJ:', error);
            }
        );

        return () => {
            renderer.dispose();
        };
    }, []);

    return <div ref={containerRef} />;
};

export default Logo;