import Layout from "./Components/Layout";
import { Route, Routes } from "react-router-dom";


export default function App() {
  return (
    <div className="App">
          <Routes>
            <Route index element={<Layout />}>
              
            </Route>
          </Routes>
    </div>
  );
}