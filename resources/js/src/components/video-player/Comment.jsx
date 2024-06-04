import moment from "moment";
import React, { useState } from "react";
import assets from "../../assets";
import CommentEditMenu from "./CommentEditMenu";
import { useSelector } from "react-redux";

export default function Comment({ comment }) {
    const {
        user_id,
        video_id,
        comment: description,
        updated_at,
        created_at,
        user,
        id,
    } = comment || {};

    const [editMenu, setEditMenu] = useState(false);
    const {
        check,
        user: { id: authId },
    } = useSelector((state) => state.auth) || {};

    return (
        <div className="p-2 bg-white rounded-md border border-solid border-slate-300 mt-3 relative">
            <div className="flex gap-4">
                <figure>
                    <img
                        src={user?.picture}
                        className="!w-10 !h-10 !min-w-10 rounded-full border border-primary shadow-main"
                        alt="User Profile Image"
                    />
                </figure>
                <div className="my-auto w-full">
                    <div className="w-full flex items-center justify-between">
                        <div className="my-auto">
                            <h1 className="leading-3">
                                <span className="text-2xl font-medium font-primary capitalize text-primary tracking-wide">
                                    {user?.name}
                                </span>
                                <br className="block sm:hidden" />
                                <span className="text-secondary text-sm italic font-light font-poppins sm:ml-3 my-auto leading-[0.1] sm:leading-4">
                                    {moment(updated_at).subtract().fromNow()}
                                </span>
                            </h1>
                        </div>

                        {check && authId === user_id && (
                            <div className="text-end">
                                <button
                                    onClick={() => setEditMenu(true)}
                                    className="bg-primary px-3.5 py-2 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary"
                                >
                                    {assets.svg.menu3dots()}
                                </button>
                            </div>
                        )}
                    </div>
                    <div className="font-normal font-poppins text-md leading-6 text-slate-700 pt-2 px-2 relative -ml-14 border-t border-slate-300 mt-2">
                        <p className="leading-6 w-full text-start">
                            {description}
                        </p>
                    </div>
                </div>
            </div>

            {editMenu && (
                <CommentEditMenu
                    comment={comment}
                    setEditMenu={() => setEditMenu(false)}
                />
            )}
        </div>
    );
}
