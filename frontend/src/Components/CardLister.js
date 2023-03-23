import React, {useState} from 'react';
import AllEvents from "./AllEvents";
import {useEffectOnce} from "../hook/useEffectOnce";
import fetchUrl from "./Fetch";
const CardLister = () => {
    const [allEvent, setAllEvent] = useState([]);

    useEffectOnce(() => {
        fetchUrl.get("http://gathergo.com/lara/api/events")
            .then(data => setAllEvent(data.events))
    })

    return allEvent && (

            <AllEvents events={allEvent}/>

    );
}

export default CardLister;