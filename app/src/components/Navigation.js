import React from 'react';
import { Link } from '@reach/router';

class Navigation extends React.Component{
    render() {
        return (
            <div>
                <nav>
                    <Link to="/">Home</Link>
                    <Link to="/login">Login</Link>
                </nav>
            </div>
        );
    }
}

export default Navigation;