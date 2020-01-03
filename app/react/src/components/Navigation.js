import React from 'react';
import { Link } from '@reach/router';

class Navigation extends React.Component{
    render() {
        return (
            <div>
                <nav>
                    <Link to="/">Home</Link>
                    <Link to="/login">Login</Link>
                    <Link to="/new-client">New Client</Link>
                    <Link to="/new-task">New Task</Link>
                </nav>
            </div>
        );
    }
}

export default Navigation;