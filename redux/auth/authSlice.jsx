import { createSlice } from '@reduxjs/toolkit';

const initialState = { accessToken: '', isAuth: false, user: {} };

const authSlice = createSlice({
    name: 'auth',
    initialState,
    reducers: {
        userLoggedIn: (state, action) => {
            state.accessToken = action.payload.accessToken;
            state.user = action.payload.user;
        },

        userLoggedOut: (state) => {
            state.accessToken = '';
            state.user = {};
        },

        initiateAuthenticationCredentials: function (state, action) {
            state.isAuth = action.payload.isAuth;
            state.user = action.payload.user;
        },
    },
});

export default authSlice.reducer;
export const { userResister, userLoggedIn, initiateAuthenticationCredentials } =
    authSlice.actions;
