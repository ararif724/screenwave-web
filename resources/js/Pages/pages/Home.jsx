import App from "./App";
import Components from "../components";

export default function Home({ isAuth, user }) {
    return (
        <App isAuth={isAuth} user={user}>
            <Components.HeaderContents />
            <Components.Installation />
            <Components.MarketingAudience />
        </App>
    );
}
// isAuth, user
