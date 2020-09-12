import React, {useEffect, useState} from 'react';
import { Button,Container,Row,Col,Table, Pagination } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function List() {

    const [error, setError] = useState(null);
    const [isLoaded, setIsLoaded] = useState(false);
    const [items, setItems] = useState([]);
    const [paginationItems, setPaginationItems] = useState([]);

    const url = 'http://localhost:88/api/developers';

    let getItems = function(url)
    {
        fetch(url)
            .then(res => res.json())
            .then(
                (result) => {
                    setIsLoaded(true);
                    setItems(result.data);
                    let pages = [];
                    let active = result.current_page;

                    for (let page = 1; page <= result.last_page; page++) {
                        pages.push(
                            <Pagination.Item data-page={page} key={page} active={page === active}>
                                {page}
                            </Pagination.Item>,
                        );
                    }

                    setPaginationItems(pages);
                },

                (error) => {
                    setIsLoaded(true);
                    setError(error);
                }
            )
    }

    let pageChanged = function(e){
        const page = e.target.getAttribute('data-page');
        getItems(url+'?page='+page);
    }

    useEffect(() => {
        getItems(url)
    }, [])

    if (error) {
        return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
        return <div>Loading...</div>;
    }

    return (
        <Container>
            <Table striped bordered hover>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>hobby</th>
                    <th>Data de Nascimento</th>
                    <th width={200}>Opções</th>
                </tr>
                </thead>
                <tbody>

                    {items.map(item => (
                        <tr key={item.id}>
                            <td>{item.id}</td>
                            <td>{item.nome}</td>
                            <td>{item.hobby}</td>
                            <td>{item.data_nascimento}</td>
                            <td> <Button variant="primary">Editar</Button>  <Button variant="danger">Remover</Button></td>
                        </tr>
                    ))}
                </tbody>
            </Table>
            <Row>
                <Col>
                    <Pagination onClick={pageChanged} >{paginationItems}</Pagination>
                </Col>
            </Row>
        </Container>
    );
}

export default List;
