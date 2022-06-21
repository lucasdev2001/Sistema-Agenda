import React, { useState, useEffect } from "react";

export default function Card(props) {
  const [NomeUsuarioEdit, setNomeUsuarioEdit] = useState("");
  const [agenda, setAgenda] = React.useState(null);
  const [Numero, setNumero] = useState("");
  React.useEffect(() => {
    fetch("http://localhost/sistema-agenda/server/api/numeros/id.php")
      .then((res) => res.json())
      .then((data) => setAgenda(data));
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await fetch(
        "http://localhost/sistema-agenda/server/api/numeros/id.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            Numero: `${Numero}`,
            UsuarioID: e.target.id,
          }),
        }
      )
      if(res) window.location.replace('/');
    } catch (error) {
      console.log(error);
    }

  };

  const handleEditSubmit = async (e)=>{
    e.preventDefault();
    try {
      const res = await fetch(`http://localhost/sistema-agenda/server/api/usuarios/id.php?UsuarioID=${e.target.id}`, {
        method: 'PUT',
        headers:{
          'Content-Type': 'application/x-www-form-urlencoded'
        },    
        body: new URLSearchParams({
            'NomeUsuario': `${NomeUsuarioEdit}`
        })
    })
    if(res) window.location.replace('/');
    } catch (error) {
      console.log(error);
    }
  }


const handleDelete = async(e)=>{
  e.preventDefault();
  try {
    const res = await fetch(`http://localhost/sistema-agenda/server/api/usuarios/id.php?UsuarioID=${e.target.id}`, {
      method: 'DELETE'
    }) 
    if(res) window.location.replace('/');
  } catch (error) {
    console.log(error);
  }

}

  const handleEditButton = (e)=>{
    const form = document.getElementById(`editDiv${props.UsuarioID}`);
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  }

  return (
    <>
      <div className="col">
        <div className="card">
          <div className="card-body">
            <h5 className="card-title">{props.nome}</h5>
            <p className="card-text">
    
            </p>

            <form id={props.UsuarioID} onSubmit={handleSubmit}>
              <div className="input-group mb-3">
                <input
                  type="text"
                  className="form-control"
                  placeholder="Adicionar Número"
                  required
                  onChange={(e) => setNumero(e.target.value)}
                  value={Numero}
                />
                <br />
                <button className="btn btn-outline-secondary" type="submit">
                  Adicionar
                </button>
              </div>
            </form>
            {!agenda
              ? "Parece que não existe nenhum número..."
              : agenda.map((dados) => {
                  if (dados.UsuarioID === props.UsuarioID) {
                    return <p>{dados.Numero}</p>;
                  }
                })}
          </div>
          <div className="card-footer bg-transparent border-info">
            <button type="button" class="btn btn-primary m-1" id={props.UsuarioID} onClick={handleEditButton} >
              Editar
            </button>
            <button type="button" class="btn btn-danger m-1" id={props.UsuarioID} onClick={handleDelete}>
              Deletar
            </button>
            <div id={`editDiv${props.UsuarioID}`} style={{display: "none"}}>
            <form onSubmit={handleEditSubmit} id={props.UsuarioID}>
              <div class="mb-3">
                <label class="form-label">
                  Editar Nome do contato
                </label>
                <input
                  type="text"
                  class="form-control"
                  defaultValue={props.nome}
                  onInput={(e) => setNomeUsuarioEdit(e.target.value)}
                />
              </div>
              <button type="submit" class="btn btn-primary">
                Confirmar
              </button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
