import * as React from 'react';
import {useEffect, useState} from 'react';
import PropTypes from 'prop-types';
import dayjs from 'dayjs';
import Badge from '@mui/material/Badge';
import {AdapterDayjs} from '@mui/x-date-pickers/AdapterDayjs';
import {LocalizationProvider} from '@mui/x-date-pickers/LocalizationProvider';
import {PickersDay} from '@mui/x-date-pickers/PickersDay';
import {DateCalendar} from '@mui/x-date-pickers/DateCalendar';
import {DayCalendarSkeleton} from '@mui/x-date-pickers/DayCalendarSkeleton';
import axios from "axios";
import {useUser} from "../Context/UserProvider";
import AllEvents from "./AllEvents";


function getDay(date) {
  return parseInt(date.slice(8,10));
}

function getDates(events) {
    const eventDates = [0];
    events.map((event) => {
        eventDates.push(getDay(event.event_date));
    });
    return eventDates;
}
/**
 * Mimic fetch with abort controller https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
 * ⚠️ No IE11 support
 */
function fetchEvents(date, user, { signal }) {
  const userId = user.user.id;
  const month = date.month()+1;
  const year = date.year();

  return new Promise((resolve, reject) => {
    const timeout = setTimeout( async () => {
        const userResponse =  await axios.get(`http://gathergo.com/lara/api/calendar/user-events?userId=${userId}&month=${month}&year=${year}`);
        const participatedResponse =  await axios.get(`http://gathergo.com/lara/api/calendar/participated-events?userId=${userId}&month=${month}&year=${year}`);
        const userEvents = userResponse.data;
        const participatedEvents = participatedResponse.data;

        const events = userEvents.concat(participatedEvents);

        const daysToHighlight = getDates(events);

        resolve({ daysToHighlight });
    }, 500);

    signal.onabort = () => {
      clearTimeout(timeout);
      reject(new DOMException('aborted', 'AbortError'));
    };
  });
}

const initialValue = dayjs();

function ServerDay(props) {
  const { highlightedDays = [], day, outsideCurrentMonth, ...other } = props

  const isSelected =
    !props.outsideCurrentMonth && highlightedDays.indexOf(day.date()) > 0;

  return (
    <Badge
      key={props.day.toString()}
      overlap="circular"
      badgeContent={isSelected ? '🌚' : undefined}
    >
      <PickersDay {...other} outsideCurrentMonth={outsideCurrentMonth} day={day} />
    </Badge>
  );
}

ServerDay.propTypes = {
  /**
   * The date to show.
   */
  day: PropTypes.object.isRequired,
  highlightedDays: PropTypes.arrayOf(PropTypes.number),
  /**
   * If `true`, day is outside of month and will be hidden.
   */
  outsideCurrentMonth: PropTypes.bool.isRequired,
};

export default function DateCalendarServerRequest() {
  const requestAbortController = React.useRef(null);
  const [isLoading, setIsLoading] = React.useState(false);
  const [highlightedDays, setHighlightedDays] = React.useState([13]);
  const {user} = useUser();
  const [showChildComponent, setShowChildComponent] = useState(false);
  const [events, setEvents] = useState([]);
  const [refresh, setRefresh] = useState(false);
  const [year, setYear] = useState();
  const [month, setMonth] = useState();
  const [day, setDay] = useState();

  useEffect(() => {
      if (refresh) {

          axios.get(`http://gathergo.com/lara/api/calendar/events?year=${year}&month=${month}&day=${day}`)
               .then((response) => setEvents(response.data));

          setHighlightedDays(fetchDaysToHighLight());

          setShowChildComponent(true);
          setRefresh(false);
      }
  },[refresh]);

  const fetchDaysToHighLight = async () => {
      const userId = user.user.id;
      const userResponse =  await axios.get(`http://gathergo.com/lara/api/calendar/user-events?userId=${userId}&month=${month}&year=${year}`);
      const participatedResponse =  await axios.get(`http://gathergo.com/lara/api/calendar/participated-events?userId=${userId}&month=${month}&year=${year}`);
      const userEvents = userResponse.data;
      const participatedEvents = participatedResponse.data;

      const events = userEvents.concat(participatedEvents);

      const daysToHighlight = getDates(events);
      return daysToHighlight;
  }

  const fetchHighlightedDays = (date) => {
      console.log(date);
    const controller = new AbortController();
    fetchEvents(date, user, {
      signal: controller.signal,
    })
      .then(({ daysToHighlight }) => {
        setHighlightedDays(daysToHighlight);
        setIsLoading(false);
      })
      .catch((error) => {
        // ignore the error if it's caused by `controller.abort`
        if (error.name !== 'AbortError') {
          throw error;
        }
      });

    requestAbortController.current = controller;
  };

  React.useEffect(() => {
    fetchHighlightedDays(initialValue);
    // abort request on unmount
    return () => requestAbortController.current?.abort();
  }, []);

  const handleMonthChange = (date) => {
    if (requestAbortController.current) {
      // make sure that you are aborting useless requests
      // because it is possible to switch between months pretty quickly
      requestAbortController.current.abort();
    }

    setIsLoading(true);
    setHighlightedDays([]);
    fetchHighlightedDays(date);
  };

  const  handleDayClick = async (e)=> {
      const year = e.year();
      const month = e.month()+1;
      const day = e.date();

      const response =  await axios.get(`http://gathergo.com/lara/api/calendar/events?year=${year}&month=${month}&day=${day}`);
      const events = response.data;
      setShowChildComponent(true);
      setEvents(events);
      setYear(year);
      setMonth(month);
      setDay(day);

      }


    const props = {
        events: events,
        setRefresh: setRefresh
    }

    return (
    <LocalizationProvider dateAdapter={AdapterDayjs}>
      <DateCalendar
        defaultValue={initialValue}
        loading={isLoading}
        onMonthChange={handleMonthChange}
        onChange={handleDayClick}
        renderLoading={() => <DayCalendarSkeleton />}
        slots={{
          day: ServerDay,
        }}
        slotProps={{
          day: {
            highlightedDays,
          },
        }}
      />
        {showChildComponent && <AllEvents events={props}/>}

    </LocalizationProvider>

  );
}