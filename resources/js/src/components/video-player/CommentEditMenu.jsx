import React, { useState } from "react";
import assets from "../../assets";
import { useDispatch } from "react-redux";
import {
    deleteCommentData,
    editCommentData,
} from "../../redux/video/videoSlice";
import { onlyCsrfToken } from "../../utils/CsrfToken";

export default function CommentEditMenu({ comment, setEditMenu }) {
    const dispatch = useDispatch();
    const [btnStatus, setBtnStatus] = useState(false);

    async function deleteCommentHandler() {
        const conf = confirm(
            "Are you sure to permanently delete this comment!"
        );

        if (!conf) {
            setEditMenu();
            return;
        }

        try {
            const url = window.route(
                `/user/video/comment/delete/${comment?.id}`
            );

            const response = await fetch(url, {
                method: "DELETE",
                body: JSON.stringify({ _method: "DELETE" }),
                headers: {
                    "Content-Type": "application/json",
                    ...onlyCsrfToken,
                },
            });

            const result = await response.json();

            if (result.status === "success") {
                setEditMenu();
                dispatch(deleteCommentData(comment));
                return fireToast(result.message, "success");
            }

            return fireToast(result.message);
        } catch (error) {
            return fireToast(
                `There is an error occurred "${error?.message}". Please try again later!`
            );
        } finally {
            setBtnStatus(false);
        }
    }

    function fireToast(text, icon = "error") {
        Toast.fire({
            icon,
            text,
        });
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
