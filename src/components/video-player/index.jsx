import { useDispatch } from "react-redux";
import { initiateAuthenticationCredentials } from "../../../redux/auth/authSlice";
import Components from "../index";
import VideoPlayer from "./VideoPlayer";
import { useEffect } from "react";

export default function VideoPlayerApp({ video, isAuth, user }) {
    const dispatch = useDispatch();

    useEffect(function () {
        dispatch(initiateAuthenticationCredentials({ isAuth, user }));
    }, []);

    return (
        <>
            <Components.NavBar />
            <VideoPlayer video={video} />
            <Components.Footer />
        </>
    );
}
