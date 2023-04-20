import * as React from "react";
import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import Modal from "@mui/material/Modal";
import TextField from "@mui/material/TextField";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { DatePicker } from "@mui/x-date-pickers/DatePicker";
import { useUser } from "../Context/UserProvider";

const style = {
	position: "absolute",
	top: "50%",
	left: "50%",
	transform: "translate(-50%, -50%)",
	width: 400,
	bgcolor: "background.paper",
	border: "2px solid #000",
	boxShadow: 24,
	p: 4,
};

const AddEventModal = (props) => {
	const { user } = useUser();
	const [open, setOpen] = React.useState(false);
	const handleOpen = () => setOpen(true);
	const handleClose = () => setOpen(false);
	let title = React.useRef("");
	let desc = React.useRef("");
	let date = React.useRef("");

	const handleSubmit = () => {
		const body = {
			created_by: user.user.id,
			title: title.current,
			description: desc.current,
			event_date: date.current,
		};
		fetch("lara/api/events/add", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(body),
		}).then(() => {
			props.setRefresh(true);
			handleClose();
		});
	};
	const handleText = (e, ref) => {
		ref.current = e.target.value;
	};
	const handleDate = (newValue) => {
		date.current = `${newValue.year()}-${newValue.month()}-${newValue.date()}`;
	};

	return (
		<div>
			<Button variant="contained" onClick={handleOpen}>
				Add Event
			</Button>
			<Modal
				open={open}
				onClose={handleClose}
				aria-labelledby="modal-modal-title"
				aria-describedby="modal-modal-description"
			>
				<Box component="form" sx={style} noValidate autoComplete="off">
					<div>
						<Typography id="modal-modal-title" variant="h6" component="h2">
							Title
						</Typography>
						<TextField
							required
							id="outlined-required"
							defaultValue={title.current}
							onChange={(e) => {
								handleText(e, title);
							}}
						/>
						<Typography id="modal-modal-title" variant="h6" component="h2">
							Description
						</Typography>
						<TextField
							id="outlined-multiline-static"
							multiline
							rows={4}
							defaultValue={desc.current}
							onChange={(e) => {
								handleText(e, desc);
							}}
						/>
						<Typography id="modal-modal-title" variant="h6" component="h2">
							Date
						</Typography>
						<LocalizationProvider dateAdapter={AdapterDayjs}>
							<DatePicker
								renderInput={(params) => <TextField {...params} />}
								onChange={(newValue) => {
									handleDate(newValue);
								}}
							/>
						</LocalizationProvider>
						<Button variant="contained" onClick={handleSubmit}>
							Submit
						</Button>
					</div>
				</Box>
			</Modal>
		</div>
	);
};

export default AddEventModal;
