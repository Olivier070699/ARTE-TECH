import React from 'react';
import './App.css';
import { Router } from '@reach/router';
import Login from './components/Login';
import Home from './components/Home';

function App() {
  return (
    <div className="App">
      <Router>
        <Home path="/"/>
        <Login path="/login"/>
      </Router>
    </div>
  );
}

export default App;
