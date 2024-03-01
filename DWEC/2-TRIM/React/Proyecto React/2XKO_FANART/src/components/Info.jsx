import React from 'react';
import portadaImage from '../images/portada.gif';

const Info = () => {
    return (
        <div className='container-custom'>
            <div className="row text-white">
                <div className="col-12 col-xl-4 cuadroTexto">
                    <p>En el torneo legendario "2XKO", los héroes y villanos del reino de Runaterra se enfrentan en una batalla épica por la supremacía. Desde el noble Garen hasta la misteriosa Katarina, pasando por la temible Elise y el furioso Tryndamere, los campeones luchan con sus habilidades únicas y poderes sobrenaturales.
                        <img className="img-fluid" src="https://media3.giphy.com/media/O0vW3pLS0weFWemq59/giphy.gif?cid=ecf05e475too8x719z5pvif7dz8mxne0r4kq6eponhcdbrtr&ep=v1_gifs_related&rid=giphy.gif&ct=s" alt="veigar" />
                    </p>
                </div>
                <div className="col-12 col-xl-4 text-center">
                    <img src={portadaImage} className="img-fluid mx-auto img-mid" />
                </div>
                <div className="col-12 col-xl-4 cuadroTexto">
                    <p>Mientras tanto, antiguos conflictos y fuerzas oscuras amenazan con sumir al reino en el caos. Los campeones deben enfrentar sus propios demonios internos y forjar alianzas improbables mientras luchan por la supervivencia y el título de campeón supremo de "2XKO".
                        <img className="img-fluid" src="https://media2.giphy.com/media/M51FEiXf0rhmSQekQN/giphy.gif" alt="nunu" />
                    </p>
                </div>
            </div>
        </div>
    );
};

export default Info;