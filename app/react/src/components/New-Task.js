import React from 'react';
import Navbar from './Navigation';

class Home extends React.Component {

    state = {
        tasks: [],
        newTask: {
            client_id: '',
            km: '',
        },
        clients: [],
        tasksOnFoot: [],
        date: '',
        time: ''
    }

    componentDidMount() {
        this.getTasks();
        this.getAllClients();
        this.getTasksOnFoot();

        let that = this;
        let date = new Date().getDate(); //Current Date
        let month = new Date().getMonth() + 1; //Current Month
        let year = new Date().getFullYear(); //Current Year
        let hours = new Date().getHours(); //Current Hours
        let min = new Date().getMinutes(); //Current Minutes
        let sec = new Date().getSeconds(); //Current Seconds
        that.setState({
        //Setting the value of the date time
        date:
            year + '-' + month + '-' + date
        });
        that.setState({
            time:
                hours + ':' + min + ':' + sec
        })
    }

    getTasks = _ => {
        fetch('http://localhost:4000/task')
            .then(response => response.json())
            .then(response =>this.setState({tasks: response.data}))
        .catch(err=>console.error(err))
    }

    getAllClients = _ => {
        fetch('http://localhost:4000/client')
            .then(response => response.json())
            .then(response =>this.setState({clients: response.data}))
        .catch(err=>console.error(err))
    }

    getTasksOnFoot = _ => {
        fetch('http://localhost:4000/task-on-foot')
            .then(response => response.json())
            .then(response =>this.setState({tasksOnFoot: response.data}))
        .catch(err=>console.error(err))
    }

    addTask = _ => {
        const { newTask, date, time } = this.state;
        fetch(`http://localhost:4000/task/add?client_id=${newTask.client_id}&km=${newTask.km}&datum=${date}&start=${time}`)
            .then(this.getTasks)
        .catch(err=>console.error(err))
    }

    renderClient = ({ id, client_name }) => <option  key={id}>{client_name}</option>
    renderFootClient = ({ id, client_name }) => <option key={id}>{client_name}</option>

    render() {
        const { clients, newTask, tasksOnFoot} = this.state;
        return (
            <div>
                <div>
                    <Navbar />
                    <div>
                        <input id="checkin-btn" type="radio" name="check-btn" value="checkin" checked/>checkin
                        <input id="checkout-btn" type="radio" name="check-btn" value="checkout"/>checkout
                    </div>
                    <div id="checkin-container">
                        <h1>Where are you?</h1>
                        <select
                            value={newTask.client_id}
                            onChange={e => this.setState({ newTask: { ...newTask, client_id: e.target.key } })}
                        >
                            <option value="" disabled selected>Select your client</option>
                            {clients.map(this.renderClient)}
                        </select>

                        <input
                            type="number"
                            placeholder="aantal kilometers"
                            value={newTask.km}
                            onChange={e => this.setState({ newTask: { ...newTask, km: e.target.value } })}
                        />
                        <button onClick={this.addTask}>check in</button>
                    </div>

                    <div id="checkout-container">
                        <h1>What did you do?</h1>
                        <select>
                            <option value="" disabled selected>Select your client</option>
                            {tasksOnFoot.map(this.renderFootClient)}
                        </select>
                        <input
                            type="text"
                            placeholder="welke materialen heb je gebruikt?"
                        />
                        <input
                            type="text"
                            placeholder="wat heb je precies gedaan?"
                        />
                        <button>check out</button>
                    </div>
                </div>
            </div>
        );
    }
}

export default Home;