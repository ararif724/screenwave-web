import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";

const initialState = {
    data: {},
    isLoading: true,
    isError: false,
    error: "Please Wait.",
    reactionError: undefined,
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

const videoSlice = createSlice({
    name: "video/videoSlice",
    initialState,
    reducers: {
        getComments: function (state, action) {
            state.comments = action.payload.comments;
        },

        editCommentData: function (state, action) {
            state.commentEditForm = action.payload.status;
            state.commentEditableData = action.payload.data;
        },

        updateCommentData: function (state, action) {
            console.log(action);

            state.commentEditForm = false;

            const updatedIndex = state.comments.findIndex(
                (c) => c.id === action.payload.id
            );
            if (updatedIndex > -1) {
                state.comments[updatedIndex] = {
                    ...state.comments[updatedIndex],
                    ...action.payload,
                };
            }
        },

        deleteCommentData: function (state, action) {
            const updatedIndex = state.comments.findIndex(
                (c) => c.id === action.payload.id
            );
            if (updatedIndex > -1) {
                state.comments.splice(updatedIndex, 1);
            }
        },
    },
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
                // state.comments = action.payload.comments;
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
            });
    },
});

export default videoSlice.reducer;
export const {
    getComments,
    editCommentData,
    updateCommentData,
    deleteCommentData,
} = videoSlice.actions;
