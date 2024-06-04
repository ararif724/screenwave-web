import React, { useEffect, useRef, useState } from "react";
import assets from "../../assets";
import { Toast } from "../../utils/SwalToast";

export default function Share({ videoId, setShareActive }) {
    const videoIframe = `<iframe frameborder='0' src='https://drive.google.com/file/d/${videoId}/preview' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen=''></iframe>`;

    const containerRef = useRef(null);
    const [scrollPosition, setScrollPosition] = useState(0);
    const handleScroll = (scrollOffset) => {
        const container = containerRef.current;
        if (container) {
            const newScrollPosition = scrollPosition + scrollOffset;
            container.scrollLeft = newScrollPosition;
            setScrollPosition(newScrollPosition);
        }
    };

    useEffect(
        function () {
            if (window.innerWidth < 450) {
                if (scrollPosition > 1100) {
                    setScrollPosition(0);
                }
                if (scrollPosition < 0) {
                    setScrollPosition(1099);
                }
            } else {
                if (scrollPosition > 771) {
                    setScrollPosition(0);
                }
                if (scrollPosition < 0) {
                    setScrollPosition(770);
                }
            }
        },
        [scrollPosition]
    );

    return (
        <div
            className="fixed top-0 left-0 w-full flex items-center justify-center min-h-screen bg-black/30 z-50 p-2"
            onClick={function (event) {
                if (event.target === event.currentTarget) {
                    setShareActive(false);
                }
            }}
        >
            <div className="p-4 md:p-10 max-w-xl w-full bg-gradient-to-tr from-cyan-500/10 via-purple-500/10 to-purple-500/10 bg-white rounded-2xl relative">
                <button
                    className="absolute right-0 top-0 m-3 p-2 rounded-full bg-red-500 fill-white shadow-2xl hover:bg-secondary duration-500"
                    onClick={function (event) {
                        setShareActive(false);
                    }}
                >
                    {assets.svg.xMark(18, 18)}
                </button>
                <div className="p-2 rounded-3xl overflow-hidden">
                    <button
                        className="text-primary hover:text-primary-dark absolute left-3 top-12 md:top-[70px] p-2 z-50 rounded-full bg-slate-500 border-[8px] border-white hover:bg-primary hover:drop-shadow-primary duration-500 fill-white"
                        onClick={() => handleScroll(-85)}
                    >
                        {assets.svg.leftArrow()}
                    </button>
                    <div
                        ref={containerRef}
                        className="flex gap-3 items-center justify-start duration-500"
                        id="icons"
                        style={{
                            width: assets.shares.length * 70,
                            transition: "transform 0.5s ease",
                            transform: `translateX(${-scrollPosition}px)`,
                        }}
                    >
                        {assets.shares.map((shareIcon) => (
                            <a
                                // href={shareIcon.share(shareUrl)}
                                key={shareIcon.id}
                                className="text-center bg-primary/15 p-2 flex items-center justify-center flex-col rounded-md duration-500 hover:bg-primary text-secondary hover:text-slate-100 cursor-pointer hover:drop-shadow-primary"
                                onClick={function () {
                                    window.open(
                                        shareIcon.share(shareUrl),
                                        "_blank"
                                    );
                                }}
                            >
                                <i
                                    dangerouslySetInnerHTML={{
                                        __html: shareIcon.icon,
                                    }}
                                    className="overflow-hidden"
                                ></i>
                                <span className="capitalize text-nowrap font-bold text-sm pt-1">
                                    {shareIcon.name}
                                </span>
                            </a>
                        ))}
                    </div>
                    <button
                        className="text-primary hover:text-primary-dark absolute right-3 top-12 fill-white md:top-[70px] p-2 z-50 rounded-full bg-slate-500 border-[8px] border-white hover:bg-primary hover:drop-shadow-primary duration-500"
                        onClick={() => handleScroll(85)}
                    >
                        {assets.svg.rightArrow()}
                    </button>
                </div>

                <div className="flex flex-col mt-4 gap-1 border border-secondary/40 p-2 bg-slate-100 rounded">
                    <label
                        htmlFor=""
                        className="text-secondary font-medium text-sm"
                    >
                        Copy the link/url
                    </label>
                    <div className="bg-white py-2 px-4 border-solid border border-slate-300 relative">
                        <i
                            className="absolute right-1 top-1 p-2 rounded-md border border-secondary/40 inline-flex bg-slate-300 text-xs fill-secondary text-secondary hover:fill-primary duration-300 shadow-primary-deep not-italic cursor-pointer"
                            onClick={function () {
                                navigator.clipboard.writeText(
                                    window.location.href
                                );

                                Toast.fire({
                                    text: "The shared link copied successfully!",
                                    icon: "success",
                                });
                            }}
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width={16}
                                height={16}
                                viewBox="0 0 448 512"
                            >
                                <path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
                            </svg>
                        </i>
                        <code className="font-mono text-slate-600 break-all">
                            {window.location.href}
                        </code>
                    </div>
                </div>

                <div className="flex flex-col mt-4 gap-1 border border-secondary/40 p-2 bg-slate-100 rounded">
                    <label
                        htmlFor=""
                        className="text-secondary font-medium text-sm"
                    >
                        Copy the video's <b className="text-primary">Embed</b>
                        link
                    </label>
                    <div className="bg-white py-2 px-4 border-solid border border-slate-300 relative">
                        <i
                            className="absolute right-2 top-2 p-2 rounded-md border border-secondary/40 inline-flex bg-slate-300 text-xs fill-secondary text-secondary hover:fill-primary duration-300 shadow-primary-deep not-italic cursor-pointer"
                            onClick={function () {
                                navigator.clipboard.writeText(videoIframe);

                                Toast.fire({
                                    text: "The shared link copied successfully!",
                                    icon: "success",
                                });
                            }}
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width={16}
                                height={16}
                                viewBox="0 0 448 512"
                            >
                                <path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
                            </svg>
                        </i>
                        <code className="font-mono text-slate-600 break-all">
                            {videoIframe}
                        </code>
                    </div>
                </div>
            </div>
        </div>
    );
}
