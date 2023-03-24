import React from "react";
import Box from "@mui/material/Box";
import CardContent from "@mui/material/CardContent";
import Typography from "@mui/material/Typography";
import CardActions from "@mui/material/CardActions";
import Card from '@mui/material/Card';
import BasicModal from "./BasicModal";






const AllEvents = (allEvent) => {


    const getCardList = () => {
        return allEvent.events.map((event,index) =>
            <Card variant="outlined"key={index}>
                <React.Fragment>
                    <CardContent sx={{ m:2, p:2 , maxWidth: 200}} key={index} >
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
                        <BasicModal/>
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