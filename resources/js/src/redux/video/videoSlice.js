import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";

const initialState = {
    data: {},
    isLoading: true,
    isError: false,
    error: "Please Wait.",
    reactionError: undefined,

    editTitleIsLoading: false,
    editTitleIsError: false,
    editTitleError: undefined,
    editTitleResponse: {},
};

export const fetchVideo = createAsyncThunk(
    "video/fetchVideo",
    async function (id) {
        const video = (await api.get("video/" + id))?.data;
        const currentUserReaction = (
            await api.get("video/" + id + "/current-user-reaction")
        )?.data;
        return { video, currentUserReaction };
    }
);

export const fetchReaction = createAsyncThunk(
    "video/fetchReaction",
    async function ({ videoId, reactionType }) {
        const reaction = (
            await api.post(`video/${videoId}/reaction/${reactionType}`)
        )?.data;

        return reaction;
    }
);

export const fetchEditVideoTitle = createAsyncThunk(
    "video/fetchEditVideoTitle",
    async function ({ videoId, title }) {
        const result = (await api.put(`video/${videoId}/edit-title`, { title }))
            ?.data;

        return result;
    }
);

const videoSlice = createSlice({
    name: "video/videoSlice",
    initialState,
    reducers: {},
    extraReducers: function (builder) {
        builder
            .addCase(fetchVideo.pending, function (state) {
                state.isError = false;
                state.isLoading = true;
                state.error = "Please Wait.";
            })
            .addCase(fetchVideo.fulfilled, function (state, action) {
                state.isError = false;
                state.isLoading = false;
                state.error = undefined;
                state.data = action.payload.video;
                state.currentUserReaction = action.payload.currentUserReaction;
            })
            .addCase(fetchVideo.rejected, function (state, action) {
                state.isLoading = false;
                state.data = undefined;
                state.isError = true;
                state.error = action.error.message;
            })
            .addCase(fetchReaction.fulfilled, function (state, action) {
                state.currentUserReaction = action.payload?.reaction;
                state.data.likes_count = action.payload?.video?.likes_count;
                state.data.dislikes_count =
                    action?.payload.video?.dislikes_count;
                state.reactionError = undefined;
            })
            .addCase(fetchReaction.rejected, function (state, action) {
                state.reactionError = action.error.message;
            })

            // video title edit/update
            .addCase(fetchEditVideoTitle.pending, function (state) {
                state.editTitleIsError = false;
                state.editTitleIsLoading = true;
                state.editTitleError = "Please Wait.";
            })
            .addCase(fetchEditVideoTitle.fulfilled, function (state, action) {
                state.editTitleIsError = false;
                state.editTitleIsLoading = false;
                state.editTitleError = undefined;
                // state.data = action.payload.video;
                console.log(action);
                state.editTitleResponse = action.payload.currentUserReaction;
            })
            .addCase(fetchEditVideoTitle.rejected, function (state, action) {
                state.editTitleIsError = true;
                state.editTitleIsLoading = false;
                state.editTitleError = action.error.message;
            });
    },
});

export default videoSlice.reducer;
export const {} = videoSlice.actions;
