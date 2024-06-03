import apiSlice from "../api/apiSlice";
import { userLoggedIn, userResister } from "./authSlice";

const authApi = apiSlice.injectEndpoints({
    endpoints: (builder) => ({
        register: builder.mutation({
            query: (data) => ({
                url: "/register",
                method: "POST",
                body: data,
            }),

            async onQueryStarted(data, { queryFulfilled, dispatch }) {
                try {
                    const successResister = await queryFulfilled;

                    localStorage.setItem(
                        "auth",
                        JSON.stringify({
                            accessToken: successResister.data.accessToken,
                            user: successResister.data.user,
                        })
                    );

                    dispatch(
                        userLoggedIn({
                            accessToken: successResister.data.accessToken,
                            user: successResister.data.user,
                        })
                    );
                } catch (err) {
                    console.log(err);
                }
            },
        }),

        login: builder.mutation({
            query: (data) => ({
                url: "/login",
                method: "POST",
                body: data,
            }),

            async onQueryStarted(data, { queryFulfilled, dispatch }) {
                try {
                    const successResister = await queryFulfilled;

                    localStorage.setItem(
                        "auth",
                        JSON.stringify({
                            accessToken: successResister.data.accessToken,
                            user: successResister.data.user,
                        })
                    );

                    dispatch(
                        userLoggedIn({
                            accessToken: successResister.data.accessToken,
                            user: successResister.data.user,
                        })
                    );
                } catch (err) {
                    console.log(err);
                }
            },
        }),
    }),
});

export const { useRegisterMutation, useLoginMutation } = authApi;
