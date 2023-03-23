import Layout from "./Components/Layout";
import UserProvider from "./Context/UserProvider.jsx";

export default function App() {
	return (
		<div className="App">
			<UserProvider>
				<Layout />
			</UserProvider>
		</div>
	);
}
