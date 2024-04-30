import React, { useState } from "react";
import assets from "../../assets";
import Share from "./Share";

export default function VideoActions({
    user,
    like,
    dislike,
    videoId,
    likesCount,
    dislikesCount,
    id,
}) {
    const { name, picture } = user || {};
    const [isShareActive, setShareActive] = useState(false);
    const [btnStatus, setBtnStatus] = useState(false);
    const [likeDislike, setLikeDislike] = useState({
        like,
        dislike,
        likesCount,
        dislikesCount,
    });

    async function likeHandler() {
        likeDislikeRequest("like");
    }
    function dislikeHandler() {
        likeDislikeRequest("dislike");
    }

    async function likeDislikeRequest(type) {
        setBtnStatus(true);

        try {
            const url = window.route(`/user/video/${type}/${id}`);

            const response = await fetch(url);
            const result = await response.json();

            console.log(result);

            if (result.status === "success") {
                if (type === "like") {
                    setLikeDislike((prev) => ({
                        ...prev,
                        like: result?.data?.like,
                        dislike: result?.data?.dislike,
                        likesCount: result?.data?.like
                            ? prev.likesCount + 1
                            : prev.likesCount - 1,
                        dislikesCount: prev.dislike
                            ? prev.dislikesCount - 1
                            : prev.dislikesCount,
                    }));
                }
                if (type === "dislike") {
                    setLikeDislike((prev) => ({
                        ...prev,
                        like: result?.data?.like,
                        dislike: result?.data?.dislike,
                        dislikesCount: result?.data?.dislike
                            ? prev.dislikesCount + 1
                            : prev.dislikesCount - 1,
                        likesCount: prev.like
                            ? prev.likesCount - 1
                            : prev.likesCount,
                    }));
                }

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
        <div className="w-full md:p-2 p-4 bg-[#DBF1F030] rounded-lg my-6 shadow-main flex flex-col md:flex-row gap-4 items-center justify-between">
            <div className="flex gap-4 items-start justify-start w-full md:w-auto">
                <figure className="border-4 rounded-full border-solid border-primary">
                    <img
                        src={picture}
                        className="w-16 h-16 rounded-full border border-primary shadow-main"
                        alt={name}
                    />
                </figure>
                <div className="my-auto lg:pr-2">
                    <h1 className="text-2xl font-medium font-primary capitalize text-primary tracking-wide leading-6">
                        {name}
                    </h1>
                    <p className="font-light font-poppins text-sm leading-5 text-slate-500">
                        A enthusiastic software developer.
                    </p>
                </div>
            </div>
            <div className="flex gap-6 items-center justify-center">
                <div className="pt-2.5 pb-1.5 px-6 bg-white/30 shadow-main rounded-full">
                    <div className="flex gap-5">
                        <div
                            className={`flex items-center justify-center gap-2.5 group ${
                                likeDislike.like && "active"
                            }`}
                        >
                            <figure className="mb-2.5 mt-1.5">
                                <button
                                    disabled={btnStatus}
                                    onClick={likeHandler}
                                    className="cursor-pointer duration-500 hover:drop-shadow-primary fill-secondary group-[.active]:fill-primary"
                                >
                                    {assets.svg.like()}
                                </button>
                            </figure>
                            <p className="text-secondary group-[.active]:text-primary font-semibold font-mono tracking-wide text-xl">
                                {likeDislike.likesCount}
                            </p>
                        </div>
                        <p className="border-r border-solid border-slate-400"></p>
                        <div
                            className={`flex items-center justify-center gap-2.5 group ${
                                likeDislike.dislike && "active"
                            }`}
                        >
                            <figure className="mt-2.5 mb-1.5">
                                <button
                                    disabled={btnStatus}
                                    onClick={dislikeHandler}
                                    className="cursor-pointer duration-500 hover:drop-shadow-primary fill-secondary group-[.active]:fill-primary"
                                >
                                    {assets.svg.dislike()}
                                </button>
                            </figure>
                            <p className="text-secondary group-[.active]:text-primary  font-semibold font-mono tracking-wide text-xl">
                                {likeDislike.dislikesCount}
                            </p>
                        </div>
                    </div>
                </div>

                <a
                    href={`https://drive.usercontent.google.com/u/0/uc?id=${videoId}&amp;export=download`}
                    target="_blank"
                >
                    <i className="text-secondary  w-12 h-12 flex items-center justify-center shadow-main rounded-full hover:bg-primary duration-500 hover:drop-shadow-primary group fill-primary hover:fill-white">
                        {assets.svg.download()}
                    </i>
                </a>

                <div
                    className="w-12 h-12 flex items-center justify-center bg-white/30 shadow-main rounded-full duration-500 hover:bg-primary group hover:drop-shadow-primary"
                    onClick={function () {
                        setShareActive(true);
                    }}
                >
                    <i className="m-auto cursor-pointer fill-primary hover:fill-white duration-500">
                        {assets.svg.share2()}
                    </i>
                </div>
            </div>

            {isShareActive && (
                <Share videoId={videoId} setShareActive={setShareActive} />
            )}
        </div>
    );
}
