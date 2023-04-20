import React, { useContext, useEffect, useState } from "react";
import Box from "@mui/material/Box";
import CardContent from "@mui/material/CardContent";
import Typography from "@mui/material/Typography";
import CardActions from "@mui/material/CardActions";
import Card from "@mui/material/Card";
import BasicModal from "./BasicModal";
import AddEventModal from "./AddEventModal";
import Stack from "@mui/material/Stack";
import Button from "@mui/material/Button";
import { UserContext } from "../Context/UserProvider";

const getToken = () => window.localStorage.getItem("token");

const AllEvents = (allEvent) => {

    // const [user, setUser] = useState(null);

    let token = getToken();
    console.log('Token: ');
    console.log(token);

    // console.log('User: ');
    // console.log(user);

    const CardList = () => {
        const {user} = useUser();

        let userId = (user == null) ? null : user.user.id;

		function joinEvent(event, e) {
			let eventId = event.id;

			fetch(
				`/lara/api/participants/add?event_id=${eventId}&user_id=${userId}`,
				{
					headers: {
						authorization: `Bearer ${token}`,
					},
				}
			).then((response) => {
				console.log(response);
			});
		}


        return allEvent.events.events.map((event,index) =>
            <Card variant="outlined"key={index}>
                <React.Fragment>
                    <CardContent sx={{ m:2, p:2 , width: 200, height: 250}} key={index} >
                        <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom align="right">
                            TagHolder
                        </Typography>
                        <Typography variant="h5" component="div">
                            {event.title}
                        </Typography>
                        <Typography sx={{ mb: 1.5 }} color="text.secondary">
                            {event.date}
                        </Typography>
                        <Typography variant="body2">
                            {event.description}
                        </Typography>
                        {
                                userId == event.created_by ?
                                    <Typography variant="body2">
                                        Owner
                                    </Typography> : userId != null ?
                                        <Stack spacing={2} direction="row">
                                            <Button variant="contained" onClick={(e) => { joinEvent(event,e); }}>Join</Button>
                                        </Stack> : null
                        }

                    </CardContent>
                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom align="center">
                        {event.event_date}
                    </Typography>
                    <CardActions>
                        <BasicModal/>
                    </CardActions>
                </React.Fragment>
            </Card>

        )
    }

	return (
		<div>
			<Box
				sx={{
					flexDirection: "row",
					display: "flex",
					flexWrap: "wrap",
					justifyContent: "center",
					alignItems: "center",
					m: 2,
				}}
			>
				{CardList()}
			</Box>
			<AddEventModal setRefresh={allEvent.events.setRefresh} />
		</div>
	);
};
export default AllEvents;
