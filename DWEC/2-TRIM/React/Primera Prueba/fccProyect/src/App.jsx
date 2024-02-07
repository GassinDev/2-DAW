import { useState } from 'react'
import './App.css'

function App() {
  const [count, setCount] = useState(0)
  const [foto, setFoto] = useState("https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExcGNpams3NmE5MjQya3d3YWx5bXZoaXJ1Y2gzOW83Z2w3Z3gxc214ZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/xTIdzKrWmAIy3dPiKX/giphy.gif")

  const imagen1 =  "https://media3.giphy.com/media/vjZkgd6XlhPHSZgQNY/giphy.gif?cid=ecf05e47z7d0le5uq9ng45x9b2n63jmefkr5vj0pv6syrww3&ep=v1_gifs_related&rid=giphy.gif&ct=g"
  const imagen2 = "https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExcGNpams3NmE5MjQya3d3YWx5bXZoaXJ1Y2gzOW83Z2w3Z3gxc214ZiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/xTIdzKrWmAIy3dPiKX/giphy.gif"
  const cambiarFoto = () => {
    setFoto((fotoActual) => (fotoActual === imagen1 ? imagen2 : imagen1));
  };

  return (
    <>
      <div className="card">
        <button onClick={() => setCount((count) => count + 1)}>
          Dale click {count}
        </button>
        <button onClick={cambiarFoto}>
          <img src={foto} alt="foto"/>
        </button>
        
      </div>

    </>
  )
}

export default App
