import React, { useEffect, useState } from "react";
import assets from "../../assets";
import { useDispatch, useSelector } from "react-redux";
import { fetchAddComment } from "../../redux/comment/commentSlice";
import { useParams } from "react-router-dom";
import { Comment as CommentLoader } from "react-loader-spinner";

export default function AddComment() {
    const [comment, setComment] = useState("");

    const { addCommentIsLoading, addCommentIsError, addCommentError } =
        useSelector((state) => state.comment);

    const [responseState, setResponseState] = useState({
        status: false,
        loader: addCommentIsLoading,
        error: addCommentIsError,
        message: addCommentError,
    });

    const dispatch = useDispatch();
    const { id } = useParams();

    async function addCommentHandler(e) {
        e.preventDefault();
        setResponseState({ ...responseState, status: true });

        dispatch(fetchAddComment({ videoId: id, comment }));
        setResponseState({ ...responseState, status: false });

        if (!addCommentIsLoading && !addCommentIsError) e.target.reset();
    }

    function fireToast(text, icon = "error") {
        Toast.fire({
            icon,
            text,
        });
    }

    useEffect(
        function () {
            // setResponseState({
            //     ...responseState,
            //     loader: addCommentIsLoading,
            //     error: addCommentIsError,
            //     message: addCommentError,
            // });

            if (!addCommentIsLoading && !addCommentIsError) {
                setComment("");
            }
        },
        [addCommentIsLoading, addCommentIsError]
    );

    console.log("AddComment => ", {
        addCommentIsLoading,
        addCommentIsError,
        addCommentError,
    });

    return (
        <form className="w-full" onSubmit={addCommentHandler} method="POST">
            {/* Render the Main Comment Text Area*/}
            <textarea
                name="comment"
                cols="30"
                value={comment}
                rows="6"
                onChange={(e) => setComment(e.target.value)}
                className="w-full resize-none outline-none border border-solid border-green-500 p-3 text-lg font-mono focus:border-2 text-slate-800 rounded-md"
                placeholder="Write here what's on your mind..."
                id="comment-textarea"
            ></textarea>

            <div className="relative">
                <div className="absolute z-10 p-2 bg-white bottom-3 right-1.5">
                    {!addCommentIsLoading && !addCommentIsError && (
                        <button
                            className="bg-primary text-white font-white flex gap-1 rounded-lg shadow-main"
                            disabled={responseState.status}
                        >
                            <i
                                className="block py-2 px-3 bg-primary rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer text-yellow"
                                id="comment-submit-btn"
                            >
                                {assets.svg.send()}
                            </i>
                        </button>
                    )}

                    {true && addCommentIsLoading && (
                        <CommentLoader
                            width={60}
                            height={60}
                            color="rgb(239 68 68)"
                            backgroundColor="hsl(45 100% 72%)" //"rgb(0 158 145)"
                        />
                    )}
                </div>
            </div>
        </form>
    );
}
