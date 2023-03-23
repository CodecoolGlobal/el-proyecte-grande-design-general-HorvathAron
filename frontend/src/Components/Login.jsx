import { useCallback, useEffect } from "react";
import jwt_decode from "jwt-decode";
import Button from "@mui/material/Button";
import { useUser } from "../Context/UserProvider";

const Login = () => {
	const {user, login, logout } = useUser();

	const handleCallbackResponse = useCallback ((response) => {
		const userObject = jwt_decode(response.credential);
		const creds = { name: userObject.name, email: userObject.email };
		login(creds);
	},[login]);

	const handleSignOut = () => {
		logout();
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
	}, [handleCallbackResponse]);

	return user!=null ? (
			<Button variant="contained" onClick={() => handleSignOut()}>
				Sign Out
			</Button>
			):(<div id="signInDiv"/>)
};

export default Login;
