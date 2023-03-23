import React, {useState} from 'react';
import CardMaker from "./CardMaker";
import {useEffectOnce} from "../hook/useEffectOnce";
import fetchUrl from "./Fetch";
const CardLister = () => {
    const [allEvent, setAllEvent] = useState([]);

    useEffectOnce(() => {
        fetchUrl.get("http://gathergo.com/lara/api/events")
            .then(data => setAllEvent(data.events))
    })

    return allEvent && (

            <CardMaker events={allEvent}/>

    );
}

export default CardLister;