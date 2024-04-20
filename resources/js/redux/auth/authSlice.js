import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    isAuth: false,
    user: {},
};

const authSlice = createSlice({
    name: "auth/authSlice",
    initialState,
    reducers: {
        initiateAuthenticationCredentials: function (state, action) {
            state.isAuth = action.payload.isAuth;
            state.user = action.payload.user;
        },
    },
});

export default authSlice.reducer;
export const { initiateAuthenticationCredentials } = authSlice.actions;
