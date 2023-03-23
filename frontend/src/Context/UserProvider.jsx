import {
	createContext,
	useCallback,
	useContext,
	useEffect,
	useState,
} from "react";

const UserContext = createContext();

const getToken = () => window.localStorage.getItem("token");
const setToken = (token) => window.localStorage.setItem("token", token);

const UserProvider = ({ children }) => {
	const [user, setUser] = useState(null);
	const [loading, setLoading] = useState(true);

	const getMe = useCallback((token) => {
		fetch("/lara/api/auth/me", {
			headers: {
				authorization: `Bearer ${token}`,
			},
		})
			.then((r) => r.json())
			.then((user) => {
				setUser(user);
				console.log(user)
			})
			.finally(() => {
				setLoading(false);
			});
	}, []);

	useEffect(() => {
		const token = getToken();

		if (!token) {
			setLoading(false);
			return;
		}

		getMe(token);
	}, [getMe]);

	const login = (creds) => {
		fetch("/lara/api/auth/login", {
			method: "POST",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(creds),
		})
			.then((res) => res.json())
			.then((res) => {
				const { token } = res;
				if (token) {
					setToken(token);
					getMe(token);
				}
			});
		setUser(user);
	};

	const logout = () => {
		fetch("/lara/api/auth/logout", {
			headers: {
				authorization: `Bearer ${getToken()}`,
			},
		})
			.then((r) => r.json())
			.then((response) => {
				setUser(null);
				setToken("");
				console.log(response);
			});
	};

	return (
		<UserContext.Provider value={{ user, login, logout }}>
			{!loading && children}
		</UserContext.Provider>
	);
};

export const useUser = () => useContext(UserContext);

export default UserProvider;
