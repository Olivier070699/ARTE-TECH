import React from 'react';
import './App.css';
import { Router } from '@reach/router';
import Login from './components/Login';
import Home from './components/Home';
import NewClient from './components/New-Client';
import NewTask from './components/New-Task';

function App() {
  return (
    <div className="App">
      <Router>
        <Home path="/"/>
        <Login path="/login" />
        <NewClient path="/new-client" />
        <NewTask path="/new-task"/>
      </Router>
    </div>
  );
}

export default App;
