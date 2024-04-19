import React from "react";
import Components from "../components";
import App from "./App";

export default function ({
    video,
    currentUserLike,
    currentUserDislike,
    isAuth,
    user,
}) {
    return (
        <App isAuth={isAuth} user={user}>
            <Components.VideoPlayer
                video={{
                    ...video,
                    like: currentUserLike,
                    dislike: currentUserDislike,
                }}
            />
        </App>
    );
}
