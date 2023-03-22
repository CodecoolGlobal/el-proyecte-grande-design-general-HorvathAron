import { useEffect, useState } from "react";
import jwt_decode from "jwt-decode";
import Button from "@mui/material/Button";
const Login = () => {
	//change to context
	const [user, setUser] = useState({});

	const handleCallbackResponse = (response) => {
		console.log("Encoded Token: " + response.credential);
		let userObject = jwt_decode(response.credential);
		console.log(userObject);
		setUser(userObject);
		document.getElementById("signInDiv").hidden = true;
	};

	const handleSignOut = (event) => {
		setUser({});
		document.getElementById("signInDiv").hidden = false;
	};

	useEffect(() => {
		//global google
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

			{Object.keys(user).length !== 0 && (
				<Button variant="contained" onClick={(e) => handleSignOut(e)}>
					Sign Out
				</Button>
			)}
			{user && (
				<div>
					<img src={user.picture} alt=""></img>
					<h3>{user.name}</h3>
				</div>
			)}
		</div>
	);
};

export default Login;
