import { createSlice } from "@reduxjs/toolkit";

const initialState = {
    comments: [],
    commentEditForm: false,
    commentEditableData: {},
};

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
});

export default videoSlice.reducer;
export const {
    getComments,
    editCommentData,
    updateCommentData,
    deleteCommentData,
} = videoSlice.actions;
