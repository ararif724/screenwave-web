import { BrowserRouter, Route, Routes } from "react-router-dom";
import "sweetalert2/src/sweetalert2.scss";
import Components from "./components";
import Video from "./components/video-player";
import Home from "./components/home";

function App() {
    return (
        <BrowserRouter basename="/f">
            <Routes>
                <Route
                    index
                    element={
                        <Components>
                            <Home />
                        </Components>
                    }
                />
                <Route
                    path="/video/:id"
                    element={
                        <Components>
                            <Video />
                        </Components>
                    }
                />
                <Route path="*" element={() => 0} />
            </Routes>
        </BrowserRouter>
    );
}

export default App;

// import Video from "./pages/Video";
// import Login from "./pages/Login";
// import Register from "./pages/Register";
// import Home from "./pages/Home";

/* <Route path="/login" element={<Login />} /> */
/* <Route path="/register" element={<Register />} /> */

/* <Components.Footer />  http://127.0.0.1:8000/f */

/* <Components.NavBar /> 
import Components from "../index";
 */ // export default {
//     Footer,
//     Header,
//     Installation,
//     MarketingAudience,
//     VideoPlayerApp,
//     NavBar,
//     HeaderContents,
//     HomeApp,
// };import Header from "./header";
// import Installation from "./installation";
// import MarketingAudience from "./marketing-audience";
// import HeaderContents from "./header/HeaderContents";
// import VideoPlayerApp from "./video-player";
// import HomeApp from "./home";
