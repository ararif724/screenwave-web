import Components from "../components";

export default function App({ children, isAuth, user }) {
    return (
        <>
            <Components.NavBar isAuth={isAuth} user={user} />
            {children}
            <Components.Footer isAuth={isAuth} user={user} />
        </>
    );
}
