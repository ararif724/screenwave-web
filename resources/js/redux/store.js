import { configureStore } from "@reduxjs/toolkit";
import authReducer from "./auth/authSlice";
import videoReducer from "./video/videoSlice";

const store = configureStore({
    reducer: {
        auth: authReducer,
        video: videoReducer,
    },
});

export default store;
