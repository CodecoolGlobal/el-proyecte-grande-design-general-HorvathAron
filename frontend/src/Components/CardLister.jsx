import React, { useState, useEffect } from "react";
import AllEvents from "./AllEvents";
import { useEffectOnce } from "../hook/useEffectOnce";
import fetchUrl from "./Fetch";
const CardLister = () => {
	const [allEvent, setAllEvent] = useState([]);
	const [refresh, setRefresh] = useState(true);

	useEffect(() => {
		if (refresh) {
			fetchUrl
				.get("http://gathergo.com/lara/api/events")
				.then((data) => setAllEvent(data.events));
			setRefresh(false);
		}
	});
	const props = {
		events: allEvent,
		setRefresh: setRefresh,
	};
	return allEvent && <AllEvents events={props} />;
};

export default CardLister;
