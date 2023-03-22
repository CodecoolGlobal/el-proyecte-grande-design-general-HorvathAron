import React from 'react';
import ReactDOM from 'react-dom';
import App from'./App.jsx';
import UserProvider from './Context/UserProvider.jsx';

ReactDOM.render(
<UserProvider>
    <App />
</UserProvider>
,document.getElementById('root'));