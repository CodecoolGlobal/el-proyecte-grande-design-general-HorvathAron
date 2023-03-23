import React from "react";
import {Link} from "react-router-dom";
import Box from "@mui/material/Box";
import CardContent from "@mui/material/CardContent";
import Typography from "@mui/material/Typography";
import CardActions from "@mui/material/CardActions";
import Button from "@mui/material/Button";
import Card from '@mui/material/Card';






const AllEvents = (allEvent) => {


    const getCardList = () => {
        console.log(allEvent);
        return allEvent.events.map((event,index) =>
            <Card variant="outlined">
                <React.Fragment>
                    <CardContent sx={{ m:2, p:2 , maxWidth: 200}} >
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
                    </CardContent>
                    <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom align="center">
                        {event.event_date}
                    </Typography>
                    <CardActions>
                        <Button size="small">Details</Button>
                    </CardActions>
                </React.Fragment>
            </Card>

        )
    }

        return (
            <Box sx={{flexDirection: 'row', display: 'flex',flexWrap: 'wrap',justifyContent: 'center',alignItems: 'center',m:2}}>
                {getCardList()}
            </Box>
        );

}
export default AllEvents;