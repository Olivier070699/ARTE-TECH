/* eslint-disable no-restricted-globals */
/* eslint-disable no-undef */
import React from 'react';
import axios from 'axios';
import { Redirect } from '@reach/router';
import Navbar from './Navigation';

class Login extends React.Component{

    constructor(props) {
        super(props);

        this.state = {
            username: '',
            password: '',
            userNiceName: '',
            userEmail: '',
            loggedIn: false,
            loading: false,
            error: ''
        };
    };

    onFormSubmit = () => {
        event.preventDefault();

        const siteUrl = 'http://localhost';
        const loginData = {
            username: this.state.username,
            password: this.state.password
        }

        this.setState({ loading: true }, () => {
            axios.post(`${siteUrl}/wp-json/jwt-auth/v1/token`, loginData)
                .then(res => {
                    if (undefined === res.data.token) {
                        this.setState({ error: data.message, loading: false });
                        return
                    }

                    localStorage.setItem('token', res.data.token);
                    localStorage.setItem('userName', res.date.userNiceName);

                    this.setState({
                        loading: false,
                        token: res.data.token,
                        userNiceName: res.data.userNiceName,
                        userEmail: res.data.userEmail,
                        loggedIn: true
                    });
                })
                .catch(err => {
                    this.setState({ error: err.response.data, loading: false });
            })
        })
    };

    handleOnChange = (event) => {
       this.setState({[event.target.name]: event.target.value}) 
    };

    render() {
        
        const { username, password, loggedIn } = this.state;
        if (loggedIn || localStorage.getItem('token')) {
            return <Redirect to={`/${username}`} noThrow/>
        } else {
            return (
                <div>
                    <div>
                        <Navbar />
                        <form onSubmit={this.onFormSubmit}>
                        <label className="form-group">
                            Username:
                            <input
                                type="text"
                                className="form-control"
                                name="username"
                                value={username}
                                onChange={this.handleOnChange}
                            />
                        </label>
                        <br />
                        <label className="form-group">
                            Password:
                            <input
                                type="password"
                                className="form-control"
                                name="password"
                                value={password}
                                onChange={this.handleOnChange}
                            />
                        </label>
                        <br />
                        <button className="btn btn-primary mb-3" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            );
        }
    }
}

export default Login;