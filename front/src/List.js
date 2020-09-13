import React, {useEffect, useState} from 'react';
import { Button,Container,Row,Col,Table, Pagination } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function List(props) {

    const [error, setError] = useState('');
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

    const pageClick = function(e){
        const page = e.target.getAttribute('data-page');
        const filterQuery = props.filterQueryString;
        getItems(url+'?page='+page+'&'+filterQuery);
    }

    const editDeveloper = function (e)
    {
        let id = e.target.getAttribute('data-id');
        props.setSelectedDeveloperToEdit(id);
    }

    useEffect(() => {
        getItems(url)
        if(props.refreshList) {
            getItems(url);
        }
    }, [])

    if (props.refresh) {
        props.setRefreshList(false);
        const filterQuery = props.filterQueryString;
        getItems(url + '?' + filterQuery);
    }

    if (!items) {
        return( <Container> <div>Nenhum item encontrado!</div> </Container>);
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
                            <td>
                                <Button data-id={item.id} variant="primary" onClick={editDeveloper}>Editar</Button>
                                <Button variant="danger">Remover</Button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </Table>
            <Row>
                <Col>
                    <Pagination onClick={pageClick} >{paginationItems}</Pagination>
                </Col>
            </Row>
        </Container>
    );
}

export default List;
