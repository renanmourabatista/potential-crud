import {Button, Modal, Form} from "react-bootstrap";
import React, {useState} from "react";

function FormSearch(props) {

    const [nome, setNome] = useState('');
    const [dataNascimento, setDataNascimento] = useState('');
    const [idade, setIdade] = useState('');
    const [sexo, setSexo] = useState('');
    const [hobby, setHobby] = useState('');

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
        props.setShowForm(false)
    };

    const refreshList =  function () {
        props.setRefreshList(true);
    }

    const resetForm = function () {
        setNome('')
        setDataNascimento('')
        setIdade('')
        setSexo('')
        setHobby('')
    }

    const getSearchQueryString = function()
    {
        let query = '';

        if(nome) {
            query = 'nome='+nome
        }

        query += getParameterQueryString("data_nascimento", dataNascimento)
        query += getParameterQueryString("idade", idade)
        query += getParameterQueryString("sexo", sexo)
        query += getParameterQueryString("hobby", hobby)

        return query;
    }

    const getParameterQueryString = function(name, value)
    {
        if(value) {
            return '&'+name+'='+value
        }

        return '';
    }

    const search = function()
    {
        let queryString = getSearchQueryString();
        props.setFilterQueryString(queryString);
        refreshList();
        props.setShowForm(false);
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
                            <option value="M">M</option>
                            <option value="F">F</option>
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
                <Button variant="primary" onClick={search}>
                    Buscar
                </Button>
            </Modal.Footer>
        </Modal>
    );
}

export default FormSearch;