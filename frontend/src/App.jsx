import React from "react";
import { useEffect } from "react";
import { Typography } from "@material-ui/core";

const App = () => {
	const handleCallbackResponse = (response) => {
		console.log("Encoded Token: " + response.credential);
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
			<Typography variant="h1">Hellooo!!</Typography>

			<div id="signInDiv"></div>
		</div>
	);
};
export default App;
