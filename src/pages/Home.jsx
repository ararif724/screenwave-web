import React from "react";
import { Provider } from "react-redux";
import store from "../../redux/store";
import HomeApp from "../components/home";

export default function ({ isAuth, user }) {
    return (
        <Provider store={store}>
            <HomeApp isAuth={isAuth} user={user} />
        </Provider>
    );
}
