import React, { useState } from "react";
import assets from "../../assets";

export default function ProfileBubble({ user }) {
    const [activities, setActivities] = useState({ status: false });

    return (
        <div className="relative">
            <a
                onClick={() =>
                    setActivities({ ...activities, status: !activities.status })
                }
                className="bg-primary-lite text-primary rounded-[35px] border-4 border-primary border-solid capitalize tracking-wide block"
            >
                <img
                    src={user.picture}
                    alt="Profile"
                    className="w-14 h-14 rounded-full"
                />
            </a>

            <div
                className="absolute -right-32 sm:-right-10 top-20 bg-white rounded-md border border-solid border-slate-300 shadow-[0px_2px_4px_0px_rgba(0,0,0,0.12) h-0 overflow-hidden"
                style={{
                    transition: "1s",
                    height: activities.status ? "460px" : 0,
                }}
            >
                <div className="flex flex-col items-center justify-center w-full min-w-80 lg:min-w-96 px-4">
                    <figure className="pt-7">
                        <img
                            className="w-20 h-20 rounded-full ring-4 ring-primary/40"
                            src={user.picture}
                            alt="Logo"
                        />
                    </figure>
                    <div className="pb-3 pt-1 text-center leading-5">
                        <h2 className="text-nowrap text-2xl left-5 md:text-3xl font-semibold text-primary">
                            {user?.name}
                        </h2>
                        <p className="font-mono text-sm tracking-wide block text-slate-500">
                            {user?.email}
                        </p>
                    </div>
                    <div className="px-4 w-full pb-6">
                        <div className="pt-1 border-t-2 border-dashed border-slate-300">
                            <p className="mt-3"></p>
                            {[
                                "My Profile",
                                "account logs",
                                "recent videos",
                                "recent activities",
                            ].map((d, i) => (
                                <a
                                    href="#"
                                    key={i}
                                    className="flex w-full gap-4 items-center text-slate-600 justify-start bg-primary/15 p-2 rounded-md my-2 duration-500 hover:bg-primary/30 hover:text-slate-900"
                                >
                                    <i className="fill-slate-500">
                                        {assets.svg.profile(26, 20)}
                                    </i>
                                    <span>|</span>
                                    <span className="font-medium capitalize tracking-wide">
                                        {d}
                                    </span>
                                </a>
                            ))}
                            <a
                                href="£"
                                className="block w-full text-center bg-red-500 font-bold text-sm font-mono text-slate-100 pt-1 pb-1.5 rounded-sm duration-500 hover:bg-red-600 hover:tracking-wide mt-4"
                            >
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
