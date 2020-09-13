import {Button, Modal, Form} from "react-bootstrap";
import React, {useState} from "react";

function FormSearch(props) {
    const url =  'http://localhost:88/api/developers?';

    const [nome, setNome] = useState('');
    const [dataNascimento, setDataNascimento] = useState('');
    const [idade, setIdade] = useState('');
    const [sexo, setSexo] = useState('');
    const [hobby, setHobby] = useState('');
    const [developerId, setDeveloperId] = useState('');

    const updateNome = function (e) {
        setNome(e.target.value)
    }

    const updateDataNascimento = function (e) {
        setDataNascimento(e.target.value)
    }

    const updateIdade = function (e) {
        setIdade(e.target.value)
    }

    const updateSexo = function (e) {
        setSexo(e.target.value)
    }

    const updateHobby = function (e) {
        setHobby(e.target.value)
    }

    const handleClose = function () {
        resetForm();
        props.setShowForm(false)
    };

    const refreshList =  function () {
        props.setRefreshList(true);
    }

    let save = function()
    {
        if(developerId) {
            update(url, developerId);
            return;
        }

        create(url);
    }

    const resetForm = function () {
        setNome('')
        setDataNascimento('')
        setIdade('')
        setSexo('')
        setHobby('')
    }

    const getBodyData = function()
    {
       return JSON.stringify({
            "nome": nome,
            "data_nascimento": dataNascimento,
            "idade": idade,
            "sexo": sexo,
            "hobby": hobby,
        })
    }

    const handleApiResponse = function(result) {
            let message = result.message + '\n';

            if(result.errors) {
                for(let i in result.errors) {
                    message += result.errors[i][0] + '\n';
                }
            } else {
                resetForm();
                handleClose();
                refreshList();
                setDeveloperId('');
            }

            alert(message);
    }

    const create = function(url)
    {
        const options = {
            headers: {'Content-Type':'application/json'},
            method: 'POST',
            body: getBodyData()
        }

        fetch(url, options)
            .then(res => res.json())
            .then(
                (result) => handleApiResponse (result),
                (error) => {
                    console.log(error.message);
                }
            )
    }

    const update = function(url, id)
    {
        const options = {
            headers: {'Content-Type':'application/json'},
            method: 'PUT',
            body: getBodyData()
        }

        fetch(url + '/'+id, options)
            .then(res => res.json())
            .then(
                (result) => handleApiResponse (result),

                (error) => {
                    console.log(error.message);
                }
            )
    }

    return (
        <Modal show={props.show} onHide={handleClose} animation={false}>
            <Modal.Header closeButton>
                <Modal.Title>Buscar</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Form>
                    <Form.Group controlId="form.nome">
                        <Form.Label>Nome</Form.Label>
                        <Form.Control value={nome} onChange={updateNome}  name="nome" type="text" placeholder="Nome" />
                    </Form.Group>
                    <Form.Group controlId="form.data_nascimento">
                        <Form.Label>Data de Nascimento</Form.Label>
                        <Form.Control value={dataNascimento} onChange={updateDataNascimento} name="data_nascimento" type="date" />
                    </Form.Group>
                    <Form.Group controlId="form.idade">
                        <Form.Label>Idade</Form.Label>
                        <Form.Control value={idade} onChange={updateIdade} name="idade" type="number" />
                    </Form.Group>
                    <Form.Group controlId="form.sexo">
                        <Form.Label>Sexo</Form.Label>
                        <Form.Control value={sexo} onChange={updateSexo} name="sexo"  as="select" custom>
                            <option value="">Escolha</option>
                            <option>M</option>
                            <option>F</option>
                        </Form.Control>
                    </Form.Group>
                    <Form.Group controlId="form.hobby">
                        <Form.Label>hobby</Form.Label>
                        <Form.Control value={hobby} onChange={updateHobby} name="hobby" type="text" />
                    </Form.Group>
                </Form>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={handleClose}>
                    Cancelar
                </Button>
                <Button variant="primary" onClick={save}>
                    Buscar
                </Button>
            </Modal.Footer>
        </Modal>
    );
}

export default FormSearch;