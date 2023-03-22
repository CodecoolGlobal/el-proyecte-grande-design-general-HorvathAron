import Layout from "./Components/Layout";
import { Route, Routes } from "react-router-dom";
import Calendar from './Components/Calendar';



export default function App() {
  return (
    <div className="App">
          <Routes>
            <Route index element={<Layout />}>
            <Calendar/>

            </Route>
          </Routes>
    </div>
  );
}