import React from "react";
import NavBar from "./Components/NavBar";
import UserProvider from "./Context/UserProvider.jsx";

const App = () => {
	return (
		<UserProvider>
			<div>
				<NavBar />
			</div>
		</UserProvider>
	);
};
export default App;
