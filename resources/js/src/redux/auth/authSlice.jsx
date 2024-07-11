import { createSlice } from "@reduxjs/toolkit";

let initialState = { accessToken: "", check: false, user: {} };

if ("auth" in window) initialState = { ...initialState, ...window.auth };

const authSlice = createSlice({
    name: "auth",
    initialState,
    reducers: {
        userLoggedIn: (state, action) => {
            state.accessToken = action.payload.accessToken;
            state.user = action.payload.user;
        },

        userLoggedOut: (state) => {
            state.accessToken = "";
            state.user = {};
        },

        initiateAuthenticationCredentials: function (state, action) {
            state.check = action.payload.check;
            state.user = action.payload.user;
        },
    },
});

export default authSlice.reducer;
export const { userResister, userLoggedIn, initiateAuthenticationCredentials } =
    authSlice.actions;
