import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";

const initialState = {
    comments: [],
    isLoading: false,
    isError: false,
    error: undefined,

    addCommentIsLoading: false,
    addCommentIsError: false,
    addCommentError: undefined,
    addCommentResponse: undefined,
    editCommentIsLoading: false,
    editCommentIsError: false,
    editCommentError: undefined,
    editCommentResponse: undefined,
    deleteCommentIsLoading: false,
    deleteCommentIsError: false,
    deleteCommentError: undefined,
    deleteCommentResponse: undefined,

    commentEditForm: false,
    commentEditableData: {},
    currentUserReaction: {},
};

export const fetchAddComment = createAsyncThunk(
    "comment/fetchAddComment",
    async function ({ videoId, comment }) {
        const formData = new FormData();
        formData.append("comment", comment);

        const response = await api.post(`video/${videoId}/comment`, formData);
        return response.data;
    }
);

export const fetchComments = createAsyncThunk(
    "comment/fetchComments",
    async function (videoId) {
        const comments = (await api.get("video/" + videoId + "/comments"))
            ?.data;
        return comments;
    }
);

const commentSlice = createSlice({
    name: "comment/commentSlice",
    initialState,
    reducers: {},
    extraReducers: function (builder) {
        builder
            .addCase(fetchComments.pending, function (state) {
                state.isLoading = true;
                state.isError = false;
                state.error = "Please Wait";
            })
            .addCase(fetchComments.fulfilled, function (state, action) {
                state.isError = false;
                state.isLoading = false;
                state.error = undefined;
                state.comments = action.payload;
            })
            .addCase(fetchComments.rejected, function (state, action) {
                state.isError = true;
                state.isError = false;
                state.error = action.error.message;
            })
            .addCase(fetchAddComment.pending, function (state) {
                state.addCommentIsLoading = true;
                state.addCommentIsError = false;
                state.addCommentError = "Please Wait";
            })
            .addCase(fetchAddComment.fulfilled, function (state, action) {
                state.addCommentIsLoading = false;
                state.addCommentIsError = false;
                state.addCommentError = undefined;
                state.addCommentResponse = action.payload;
                state.comments.data.unshift(action.payload);
            })
            .addCase(fetchAddComment.rejected, function (state, action) {
                state.addCommentIsLoading = true;
                state.addCommentIsError = false;
                state.addCommentError = action.error.message;
            });
    },
});

export default commentSlice.reducer;
export const {} = commentSlice.actions;
