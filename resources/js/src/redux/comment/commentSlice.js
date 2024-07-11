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

export const fetchEditComment = createAsyncThunk(
    "comment/fetchEditComment",
    async function ({ id, comment }) {
        const response = await api.put(`/comment/${id}`, { comment });
        return response.data;
    }
);

export const fetchDeleteComment = createAsyncThunk(
    "comment/fetchDeleteComment",
    async function (id) {
        const response = (await api.delete(`/comment/${id}`))?.data;
        return { response, id };
    }
);

export const fetchPaginateComments = createAsyncThunk(
    "comment/fetchPaginateComments",
    async function (url) {
        const result = (await api.get(url))?.data;
        return result;
    }
);

const commentSlice = createSlice({
    name: "comment/commentSlice",
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
                state.isLoading = false;
                state.error = action.error.message;
            })

            // paginating comments
            .addCase(fetchPaginateComments.pending, function (state) {
                state.isLoading = true;
                state.isError = false;
                state.error = "Please Wait";
            })
            .addCase(fetchPaginateComments.fulfilled, function (state, action) {
                state.isError = false;
                state.isLoading = false;
                state.error = undefined;
                state.comments = action.payload;
            })
            .addCase(fetchPaginateComments.rejected, function (state, action) {
                state.isLoading = false;
                state.isError = true;
                state.error = action.error.message;
            })

            // add comment fetch request/thunk
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

                if ("auth" in window) {
                    state.comments.data.unshift({
                        ...action.payload,
                        ...window.auth,
                    });
                } else state.comments.data.unshift(action.payload);
            })
            .addCase(fetchAddComment.rejected, function (state, action) {
                state.addCommentIsLoading = false;
                state.addCommentIsError = true;
                state.addCommentError = action.error.message;
            })

            //edit comment request/thunk
            .addCase(fetchEditComment.pending, function (state) {
                state.editCommentIsLoading = true;
                state.editCommentIsError = false;
                state.editCommentError = "Please Wait";
            })
            .addCase(fetchEditComment.fulfilled, function (state, action) {
                state.editCommentIsLoading = false;
                state.editCommentIsError = false;
                state.editCommentError = undefined;
                state.editCommentResponse = action.payload;
                state.commentEditForm = false;

                const updatedIndex = state.comments?.data?.findIndex(
                    (c) => c.id === action.payload.id
                );

                if (updatedIndex > -1) {
                    state.comments.data[updatedIndex] = {
                        ...state.comments[updatedIndex],
                        ...action.payload,
                    };
                }
            })
            .addCase(fetchEditComment.rejected, function (state, action) {
                state.editCommentIsLoading = false;
                state.editCommentIsError = true;
                state.editCommentError = action.error.message;
            })

            // delete comment request/thunk
            .addCase(fetchDeleteComment.pending, function (state) {
                state.deleteCommentIsLoading = true;
                state.deleteCommentIsError = false;
                state.deleteCommentError = "Please Wait";
            })
            .addCase(fetchDeleteComment.fulfilled, function (state, action) {
                state.deleteCommentIsLoading = false;
                state.deleteCommentIsError = false;
                state.deleteCommentError = undefined;
                state.deleteCommentResponse = action.payload;

                const deleteIndex = state.comments?.data?.findIndex(
                    (c) => c.id === action.payload.id
                );

                if (deleteIndex > -1) {
                    state.comments?.data?.splice(deleteIndex, 1);
                }
            })
            .addCase(fetchDeleteComment.rejected, function (state, action) {
                state.deleteCommentIsLoading = false;
                state.deleteCommentIsError = true;
                state.deleteCommentError = action.error.message;
            });
    },
});

export default commentSlice.reducer;
export const { editCommentData, deleteCommentData, updateCommentData } =
    commentSlice.actions;
