import { useDispatch } from "react-redux";
import { initiateAuthenticationCredentials } from "../../../redux/auth/authSlice";
import Components from "../index";
import { useEffect } from "react";

export default function HomeApp({ isAuth, user }) {
    const dispatch = useDispatch();

    useEffect(function () {
        dispatch(initiateAuthenticationCredentials({ isAuth, user }));
    }, []);

    return (
        <>
            <Components.NavBar />
            <Components.HeaderContents />
            <Components.Installation />
            <Components.MarketingAudience />
            <Components.Footer />
        </>
    );
}
