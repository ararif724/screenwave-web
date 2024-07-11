import { configureStore } from "@reduxjs/toolkit";
import authReducer from "../auth/authSlice";
import apiSlice from "../api/apiSlice";
import videoReducer from "../video/videoSlice";
import commentReducer from "../comment/commentSlice";

const store = configureStore({
    reducer: {
        auth: authReducer,
        [apiSlice.reducerPath]: apiSlice.reducer,
        video: videoReducer,
        comment: commentReducer,
    },
    devTools: import.meta.NODE_ENV !== "production",
    middleware: (getDefaultMiddlewares) =>
        getDefaultMiddlewares().concat(apiSlice.middleware),
});
export default store;
