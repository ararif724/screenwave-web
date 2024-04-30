import { configureStore } from '@reduxjs/toolkit';
import authReducer from '../auth/authSlice';
import apiSlice from '../api/apiSlice';
import videoReducer from '../video/videoSlice';

const store = configureStore({
    reducer: {
        auth: authReducer,
        [apiSlice.reducerPath]: apiSlice.reducer,
        video: videoReducer,
    },
    devTools: import.meta.NODE_ENV !== 'production',
    middleware: (getDefaultMiddlewares) =>
        getDefaultMiddlewares().concat(apiSlice.middleware),
});
export default store;
