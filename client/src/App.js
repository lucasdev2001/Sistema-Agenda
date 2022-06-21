import "./App.css";
import React, { useState, useEffect } from 'react';
import Card from "./Card";
function App() {
  const [NomeUsuario, setNomeUsuario] = useState("");
  const [data, setData] = React.useState(null);
  React.useEffect(() => {
    fetch('http://localhost/sistema-agenda/server/api/usuarios/')
      .then((res) => res.json())
      .then((data) => setData(data.reverse()));
  }, []);

  const handleSubmit = async(e)=>{
    e.preventDefault();

    try {
      const res = await fetch('http://localhost/sistema-agenda/server/api/usuarios/', {
    method: 'POST',
    mode: 'no-cors',
    headers:{
      'Content-Type': 'application/x-www-form-urlencoded'
    },    
    body: new URLSearchParams({
        'NomeUsuario': `${NomeUsuario}`
    })
}) 
if(res) window.location.replace('/')
      
    } catch (error) {
      console.log(error);
    }
  }
  return (
    <div className="App">
      <header className="text-center text-light">
        <div className="container-fluid p-5">
          <h1 className="display-1">Sistema Agenda 📖</h1>
          <p className="fs-6 fst-italic ">
            Porque ninguém consegue se lembrar de tantos numeros
          </p>

          <div className="row">
            <div className="col-12">
              <button
                className="button-54"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse"
                aria-expanded="false"
                aria-controls="collapse">
                Cadastrar Contato
              </button>
            </div>
            <div className="col-12 d-flex justify-content-center mt-1">
              <div className="collapse w-25" id="collapse">
                <div className="card card-body bg-light text-dark">
                  <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                      <label htmlFor="" className="form-label">
                        Nome do contato
                      </label>
                      <input
                        type="text"
                        className="form-control"
                        value={NomeUsuario}
                        onChange={(e) => setNomeUsuario(e.target.value)}
                      />
                    </div>
                    <button className="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapse">
                      Cadastrar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <main>
        <div className="container-fluid p-5 text-dark">
        <div className="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        {!data ? "Loading..." : data.map((dados)=>{
          return <Card nome={dados.NomeUsuario}  UsuarioID={dados.UsuarioID}/>
        })}
        </div>
        </div>
      </main>
     
    </div>
   
  );
}

export default App;
