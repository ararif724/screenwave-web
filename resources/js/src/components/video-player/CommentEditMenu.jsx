import React, { useState } from "react";
import assets from "../../assets";
import { useDispatch, useSelector } from "react-redux";
import {
    editCommentData,
    fetchDeleteComment,
} from "../../redux/comment/commentSlice";
import { Toast } from "../../utils/SwalToast";
import { ThreeDots } from "react-loader-spinner";

export default function CommentEditMenu({ comment, setEditMenu }) {
    const dispatch = useDispatch();
    const [btnStatus, setBtnStatus] = useState(false);

    const { deleteCommentIsLoading, deleteCommentIsError, deleteCommentError } =
        useSelector((state) => state.comment);

    async function deleteCommentHandler() {
        setBtnStatus(true);

        const result = await dispatch(await fetchDeleteComment(comment?.id));

        if (result?.type === "comment/fetchDeleteComment/fulfilled") {
            Toast.fire({
                text: "Comment Deleted Successfully!",
                icon: "success",
            });
        } else if (deleteCommentIsError) {
            Toast.fire({
                text: deleteCommentError,
                icon: "error",
            });
        } else {
            Toast.fire({
                text: "Sorry, Failed to delete the comment! ",
                icon: "error",
            });
        }

        setBtnStatus(false);
    }

    return (
        <div className="absolute z-50 right-0 top-4">
            <div className="2xl:mt-10 mr-0 relative text-purple-500">
                <ul className="p-4 w-40 bg-slate-100 2xl:bg-white 2xl:shadow-xl text-slate-700 rounded-2xl relative border border-solid border-slate-300">
                    <li className="bg-white -z-10 w-8 h-8 absolute -top-3 right-3 border border-solid border-slate-300 rotate-45 2xl:block hidden"></li>

                    <li className="p-2.5 cursor-pointer" onClick={setEditMenu}>
                        <button
                            onClick={function () {
                                dispatch(
                                    editCommentData({
                                        status: true,
                                        data: comment,
                                    })
                                );
                            }}
                            className="flex gap-6 text-center hover:tracking-wide font-medium duration-500 hover:text-violet-500 fill-violet-500"
                        >
                            <i className="font-light">
                                {assets.svg.edit(22, 22)}
                            </i>
                            <span className="text-sla-600 text-sm text-center">
                                Edit
                            </span>
                        </button>
                    </li>
                    <li className="p-2.5 cursor-pointer">
                        {deleteCommentIsLoading ? (
                            <ThreeDots
                                width={40}
                                height={40}
                                color="rgb(239 68 68)"
                                backgroundColor="hsl(45 100% 72%)" //"rgb(0 158 145)"
                            />
                        ) : (
                            <button
                                className="flex gap-6 text-center hover:tracking-wide font-medium duration-500 hover:text-red-500 fill-red-500"
                                disabled={btnStatus}
                                onClick={deleteCommentHandler}
                            >
                                <i className="font-light">
                                    {assets.svg.trash(22, 22)}
                                </i>
                                <span className="text-sla-600 text-sm text-center">
                                    Delete
                                </span>
                            </button>
                        )}
                    </li>

                    <li className="p-2.5 cursor-pointer" onClick={setEditMenu}>
                        <button className="flex gap-6 text-center hover:tracking-wide font-medium duration-500 hover:text-emerald-500 fill-emerald-500">
                            <i className="font-light">
                                {assets.svg.xMark(22, 22)}
                            </i>
                            <span className="text-sla-600 text-sm text-center">
                                Close
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    );
}
