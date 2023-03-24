import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import Home from './Components/Home';
import { BrowserRouter, Routes,Route } from "react-router-dom";
import Events from './Components/BasicModal';
import CardLister from './Components/CardLister';
import Calendar from './Components/Calendar';

const root = ReactDOM.createRoot(
    document.getElementById('root')
  );
  root.render(
    <React.StrictMode>
    <BrowserRouter>
    <Routes>
        <Route path="/" element={<App />}>
            <Route index element={<Home />}></Route>
            <Route path="/events" element={<CardLister />} />
            <Route path="/calendar" element={<Calendar/>}/>
        </Route>

    </Routes>

    </BrowserRouter>
  </React.StrictMode>
  );
