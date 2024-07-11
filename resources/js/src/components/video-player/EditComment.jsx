import React, { useEffect, useState } from "react";
import assets from "../../assets";
import CsrfToken from "../../utils/CsrfToken";
import { useDispatch, useSelector } from "react-redux";
import {
    editCommentData,
    fetchEditComment,
} from "../../redux/comment/commentSlice";
import { Toast } from "../../utils/SwalToast";
import { Comment } from "react-loader-spinner";

export default function EditComment() {
    const dispatch = useDispatch();
    const [btnStatus, setBtnStatus] = useState(false);

    function closeEditForm() {
        dispatch(editCommentData({ status: false, data: {} }));
    }
    const {
        commentEditableData,
        editCommentIsLoading,
        editCommentIsError,
        editCommentError,
    } = useSelector((state) => state.comment);
    const [desc, setDesc] = useState(commentEditableData?.comment);

    useEffect(
        function () {
            setDesc(commentEditableData?.comment);
        },
        [commentEditableData]
    );

    async function editCommentHandler(e) {
        e.preventDefault();
        setBtnStatus(true);

        const result = await dispatch(
            await fetchEditComment({
                id: commentEditableData?.id,
                comment: desc,
            })
        );

        if (result?.type === "comment/fetchEditComment/fulfilled") {
            closeEditForm();
            Toast.fire({
                text: "Comment Updated Successfully!",
                icon: "success",
            });
        } else {
            Toast.fire({
                text:
                    "Sorry, Failed to updated the comment! " + editCommentError,
                icon: "error",
            });
        }
        setBtnStatus(false);
    }

    return (
        <form className="w-full" onSubmit={editCommentHandler} method="POST">
            <CsrfToken />
            {/* Render the Main Comment Text Area*/}
            <textarea
                name="description"
                cols="30"
                rows="6"
                className="w-full resize-none outline-none border border-solid border-red-500 p-3 text-lg font-mono focus:border-2 text-slate-800 rounded-md"
                placeholder="Write here what's on your mind..."
                value={desc}
                onChange={(e) => setDesc(e.target.value)}
            ></textarea>

            <div className="relative">
                <div className="absolute z-10 p-2 bg-white bottom-3 right-1.5 flex gap-2">
                    {!editCommentIsLoading ? (
                        <>
                            <p
                                onClick={closeEditForm}
                                className="bg-green-500 text-white font-white flex gap-1 rounded-lg shadow-main"
                                disabled={btnStatus}
                            >
                                <i className="block p-2 bg-green-500 rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer">
                                    {assets.svg.close()}
                                </i>
                            </p>
                            <button
                                className="bg-red-500 text-white font-white flex gap-1 rounded-lg shadow-main"
                                disabled={btnStatus}
                            >
                                <i className="block py-2 px-3 bg-red-500 rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer">
                                    {assets.svg.send()}
                                </i>
                            </button>
                        </>
                    ) : (
                        <Comment
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
