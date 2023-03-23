import { useEffect } from "react";
import jwt_decode from "jwt-decode";
import Button from "@mui/material/Button";
import { useUser } from "../Context/UserProvider";

const Login = () => {
	const { user, login, logout } = useUser();

	const handleCallbackResponse = (response) => {
		const userObject = jwt_decode(response.credential);
		const creds = { name: userObject.name, email: userObject.email };
		console.log(creds);
		login(creds);

		document.getElementById("signInDiv").hidden = true;
	};

	const handleSignOut = () => {
		logout();
		document.getElementById("signInDiv").hidden = false;
	};

	useEffect(() => {
		//google
		window.google.accounts.id.initialize({
			client_id:
				"488646322950-v3t6bpc8ach5eno89o5h249ae5h23vvl.apps.googleusercontent.com",
			callback: handleCallbackResponse,
		});
		window.google.accounts.id.renderButton(
			document.getElementById("signInDiv"),
			{
				theme: "outline",
				size: "large",
			}
		);
	}, []);

	return (
		<div>
			<div id="signInDiv"></div>
			<Button variant="contained" onClick={() => handleSignOut()}>
				Sign Out
			</Button>
		</div>
	);
};

export default Login;