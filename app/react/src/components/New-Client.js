import React from 'react';
import Navbar from './Navigation';

class Home extends React.Component{
    
    state = {
        clients: [],
        newClient: {
            client_name: '',
            adres: ''
        }
    }

    componentDidMount() {
        this.getClients();
    }

    getClients = _ => {
        fetch('http://localhost:4000/client')
            .then(response => response.json())
            .then(response =>this.setState({clients: response.data}))
        .catch(err=>console.error(err))
    }

    addClient = _ => {
        const { newClient } = this.state;
        fetch(`http://localhost:4000/client/add?client_name=${newClient.client_name}&adres=${newClient.adres}`)
            .then(this.getClients)
        .catch(err=>console.error(err))
    }

    render() {
        const { clients, newClient} = this.state;
        return (
            <div>
                <div>
                    <Navbar />
                    <h1>Who's the lucky one?</h1>
                    <form>
                        <label className="form-group">
                            Client Name:
                            <input
                                type="text"
                                className="form-control"
                                name="client"
                                value={newClient.client_name}
                                onChange={e => this.setState({ newClient: { ...newClient, client_name: e.target.value } })}
                            />
                        </label>

                        <label className="form-group">
                            Adres
                            <input
                                type="text"
                                className="form-control"
                                name="street"
                                value={newClient.adres}
                                onChange={e => this.setState({ newClient: { ...newClient, adres: e.target.value } })}
                            />
                        </label>
                        <button className="btn btn-primary mb-3" type="submit" onClick={this.addClient}>submit</button>
                    </form>
                </div>
            </div>
        );
    }
}

export default Home;