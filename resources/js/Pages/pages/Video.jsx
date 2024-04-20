import React, { useEffect } from "react";
import Components from "../components";
import App from "./App";
import { Provider } from "react-redux";
import store from "../../redux/store";

export default function ({
    video,
    currentUserLike,
    currentUserDislike,
    isAuth,
    user,
}) {
    return (
        <Provider store={store}>
            <Components.VideoPlayerApp
                video={{
                    ...video,
                    like: currentUserLike,
                    dislike: currentUserDislike,
                }}
                isAuth={isAuth}
                user={user}
            />
        </Provider>
    );
}
