import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Carousel } from 'react-bootstrap';


// Componente con un carrusel
const SplashArtCarousel = () => {
    return (
        <Carousel prevIcon={null} nextIcon={null} indicators={false} interval={5000} fade className='carousel'>
            <Carousel.Item>
                <div className="row fondo" style={{ backgroundImage: `url('./src/images/fondo.jpg')` }}>
                    <h2 className='text-center nombre resaltado'>2VS2 FIGHTER</h2>
                    <div className="col-4">
                        <img className='character moving-image' src="https://purepng.com/public/uploads/large/purepng.com-project-katarina-skin-splashart-renderlolleague-of-legendsrenderprojectlucian-331521944896bh5am.png" alt="katarina" />
                    </div>
                    <div className="col-4">
                        <h2 className='nombre vs'>VS</h2>
                    </div>
                    <div className="col-4">
                        <img className='character moving-image' src="https://purepng.com/public/uploads/large/purepng.com-project-lucian-skin-splashart-renderlolleague-of-legendsrenderprojectlucian-331521944884fidgu.png" alt="lucian" />
                    </div>
                </div>
            </Carousel.Item>
            <Carousel.Item>
                <div className="row fondo" style={{ backgroundImage: `url('./src/images/fondo.jpg')` }}>
                    <h2 className='text-center nombre resaltado'>MUCHOS PERSONAJES</h2>
                    <div className="col-4">
                        <img className='character moving-image' src="https://purepng.com/public/uploads/large/purepng.com-project-vayne-skin-splashart-renderlolleague-of-legendsrenderprojectvayne-331521944866xpoip.png" alt="katarina" />
                    </div>
                    <div className="col-4">
                        <h2 className='nombre vs'>VS</h2>
                    </div>
                    <div className="col-4">
                        <img className='character moving-image' src="https://purepng.com/public/uploads/large/purepng.com-shockblade-zed-skinsplashartchampionleague-of-legendsskinzed-331519931602nj3ld.png" alt="lucian" />
                    </div>
                </div>
            </Carousel.Item>
        </Carousel>
    );
}

export default SplashArtCarousel;
