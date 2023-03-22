import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import Home from './Components/Home';
import { BrowserRouter, Routes,Route } from "react-router-dom";



const root = ReactDOM.createRoot(
    document.getElementById('root')
  );
  root.render(
    <React.StrictMode>
    <BrowserRouter>
    <Routes>
        <Route path="/" element={<App />}>
            <Route index element={<Home />}></Route>
        </Route>
        <Route path="/events" element={<App />}>
            <Route index element={<Home />}></Route>
        </Route>
    </Routes>

    </BrowserRouter>
  </React.StrictMode>
  );