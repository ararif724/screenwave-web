import React from "react";
import assets from "../../assets";

export default function AddComment() {
    return (
        <div className="w-full">
            {/* Render the Main Comment Text Area*/}
            <textarea
                name=""
                cols="30"
                rows="6"
                className="w-full resize-none outline-none border border-solid border-green-500 p-3 text-lg font-mono focus:border-2 text-slate-800 rounded-md"
                placeholder="Write here what's on your mind..."
                id="comment-textarea"
            ></textarea>

            <div className="relative">
                <div className="absolute z-10 p-2 bg-white bottom-3 right-1.5">
                    <div className="bg-primary text-white font-white flex gap-1 rounded-lg shadow-main">
                        <i
                            className="block py-2 px-3 bg-primary rounded-lg duration-500 hover:bg-secondary hover:drop-shadow-secondary cursor-pointer"
                            id="comment-submit-btn"
                        >
                            {assets.svg.send()}
                        </i>
                    </div>
                </div>
            </div>
        </div>
    );
}
