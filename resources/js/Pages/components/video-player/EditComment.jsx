import React, { useEffect, useState } from "react";
import assets from "../../assets";
import CsrfToken from "../../utils/CsrfToken";
import { useDispatch, useSelector } from "react-redux";
import {
    editCommentData,
    updateCommentData,
} from "../../../redux/video/videoSlice";

export default function EditComment() {
    const dispatch = useDispatch();
    const [btnStatus, setBtnStatus] = useState(false);

    function closeEditForm() {
        dispatch(editCommentData({ status: false, data: {} }));
    }
    const editableComment = useSelector(
        (state) => state.video.commentEditableData
    );
    const [desc, setDesc] = useState(editableComment?.description);

    useEffect(
        function () {
            setDesc(editableComment?.description);
        },
        [editableComment]
    );

    async function addCommentHandler(e) {
        e.preventDefault();
        setBtnStatus(true);

        try {
            const url = window.route(
                `/user/video/comment/update/${editableComment?.id}`
            );

            const formData = new FormData(e.target);
            formData.append("_method", "PATCH");

            const response = await fetch(url, {
                body: formData,
                method: "POST",
                _method: "PATCH",
                headers: { method: "POST", _method: "PATCH" },
            });

            const result = await response.json();

            if (result.status === "success") {
                // updateComment(result.data);
                dispatch(updateCommentData(result?.data));
                return fireToast(result.message, "success");
            }

            return fireToast(result.message);
        } catch (error) {
            return fireToast(
                `There is an error occurred "${error?.message}". Please try again later!`
            );
        } finally {
            closeEditForm();
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
        <form className="w-full" onSubmit={addCommentHandler} method="POST">
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
                </div>
            </div>
        </form>
    );
}
