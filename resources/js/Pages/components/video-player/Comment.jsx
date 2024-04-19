import moment from "moment";
import React from "react";

export default function Comment({ comment }) {
    const { id, user_id, description, video_id, user, updated_at } =
        comment || {};

    return (
        <div className="p-2 bg-white rounded-md border border-solid border-slate-300 mt-3">
            <div className="flex gap-4">
                <figure>
                    <img
                        src="https://lh3.googleusercontent.com/a/ACg8ocLmPfghFl9aNIkGcyLgJdF4fY2CLomvkX6yVGv92Pe2dsQJ2fw=s96-c"
                        className="!w-10 !h-10 !min-w-10 rounded-full border border-primary shadow-main"
                        alt="User Profile Image"
                    />
                </figure>
                <div className="my-auto w-full">
                    <div className="w-full flex items-center justify-between">
                        <div className="my-auto">
                            <h1 className="leading-3">
                                <span className="text-2xl font-medium font-primary capitalize text-primary tracking-wide">
                                    {user.name}
                                </span>
                                <br className="block sm:hidden" />
                                <span className="text-secondary text-sm italic font-light font-poppins sm:ml-3 my-auto leading-[0.1] sm:leading-4">
                                    {moment(updated_at).subtract().fromNow()}
                                </span>
                            </h1>
                        </div>

                        <div className="text-end">
                            <button
                                className="bg-primary p-3 text-white fill-white rounded-full shadow-main duration-500 hover:bg-secondary hover:shadow-secondary"
                                edit-comment='{"description":"I&apos;m from Pathgriho Foundation","label":"Change Your Comment Descriptions:","editUrl":"http:\/\/localhost\/screenwave-web\/public\/user\/video\/edit-comment\/2\/3\/6","deleteUrl":"http:\/\/localhost\/screenwave-web\/public\/user\/video\/delete-comment\/2\/3\/6"}'
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 512 512"
                                >
                                    <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div className="font-normal font-poppins text-md leading-6 text-slate-700 pt-2 px-2 relative -ml-14 border-t border-slate-300 mt-2">
                        <p className="leading-6 w-full text-start">
                            {description}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    );
}
