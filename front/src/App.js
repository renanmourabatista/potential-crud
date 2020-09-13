import React, {useState} from 'react';
import './App.css';
import {Button, Container, Row, Col} from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import List from "./List";
import FormDeveloper from "./FormDeveloper";
import FormSearch from "./FormSearch";

function App() {

    const [showForm, setShowForm] = useState(false);
    const [showFormSearch, setShowFormSearch] = useState(false);
    const [refreshList, setRefreshList] = useState(false);
    const [selectedDeveloperToEdit, setSelectedDeveloperToEdit] = useState(false);

    const showFormCreate = () => setShowForm(true);
    const showSearchForm = () => setShowFormSearch(true);

    return (
        <div className="App">
            <Container>
                <Row>
                    <Col><h1 className="mb-4">Gerenciador de Desenvolvedores</h1></Col>
                </Row>
                <Row>
                    <Col>
                        <Button onClick={showFormCreate} className="float-left mb-2" variant="success">Adicionar</Button>
                    </Col>
                    <Col>
                        <Button onClick={showSearchForm} className="float-right mb-2" variant="primary">Buscar</Button>
                    </Col>
                </Row>
                <List setSelectedDeveloperToEdit={setSelectedDeveloperToEdit} setRefreshList={setRefreshList} refresh={refreshList}/>
                <FormDeveloper
                    setSelectedDeveloperToEdit={setSelectedDeveloperToEdit}
                    selectedDeveloperToEdit={selectedDeveloperToEdit}
                    setRefreshList={setRefreshList}
                    setShowForm={setShowForm}
                    show={showForm}
                />
                <FormSearch
                    setRefreshList={setRefreshList}
                    setShowForm={setShowFormSearch}
                    show={showFormSearch}
                />
            </Container>
        </div>
    );
}

export default App;
