import React from 'react';
import './App.css';
import { Button,Container,Row,Col,Table, Pagination } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import List from "./List";

let active = 2;
let items = [];

for (let number = 1; number <= 5; number++) {
    items.push(
        <Pagination.Item key={number} active={number === active}>
            {number}
        </Pagination.Item>,
    );
}

function App() {
  return (
    <div className="App">
          <Container>
              <Row>
                  <Col><h1 className="mb-4">Gerenciador de Desenvolvedores</h1></Col>
              </Row>
              <Row>
                  <Col>
                    <Button className="float-left mb-2" variant="success">Adicionar</Button>
                  </Col>
                  <Col>
                      <Button className="float-right mb-2" variant="primary">Buscar</Button>
                  </Col>
              </Row>
              <List/>
          </Container>
    </div>
  );
}

export default App;
