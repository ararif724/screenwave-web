import React, { useEffect, useRef, useState } from "react";
import { createRoot } from "react-dom/client";
import shareIcons from "./assets/shareIcons";
import { FacebookShareButton, EmailShareButton } from "react-share";

var share_box = document.getElementById("share-box");

if (share_box) {
    createRoot(share_box).render(<App />);

    share_box.addEventListener("click", function (e) {
        if (e.target === e.currentTarget) {
            share_box.classList.replace("flex", "hidden");
        }
    });
}

function App() {
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

    console.log({ scrollPosition });

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
        <div className="p-4 md:p-10 max-w-xl w-full bg-gradient-to-tr from-cyan-500/10 via-purple-500/10 to-purple-500/10 bg-white rounded-2xl relative">
            <button
                className="absolute right-0 top-0 m-3 p-2 rounded-full bg-red-500 fill-white shadow-2xl hover:bg-secondary duration-500"
                onClick={function () {
                    share_box.classList.replace("flex", "hidden");
                }}
            >
                <svg
                    width={18}
                    height={18}
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 384 512"
                >
                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                </svg>
            </button>
            <div className="p-2 rounded-3xl overflow-hidden">
                <button
                    className="text-primary hover:text-primary-dark absolute left-3 top-12 md:top-[70px] p-2 z-50 rounded-full bg-slate-500 border-[8px] border-white hover:bg-primary hover:drop-shadow-primary duration-500"
                    onClick={() => handleScroll(-85)}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                        width={22}
                        height={22}
                        fill="white"
                    >
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
                </button>
                <div
                    ref={containerRef}
                    className="flex gap-3 items-center justify-start duration-500"
                    id="icons"
                    style={{
                        width: shareIcons.length * 70,
                        transition: "transform 0.5s ease",
                        transform: `translateX(${-scrollPosition}px)`,
                    }}
                >
                    {shareIcons.map((shareIcon, index) => (
                        <a
                            key={shareIcon.id}
                            className="text-center bg-primary/15 p-2 flex items-center justify-center flex-col rounded-md duration-500 hover:bg-primary text-secondary hover:text-slate-100 cursor-pointer hover:drop-shadow-primary"
                            onClick={function () {
                                window.open(
                                    `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                                        window.location.href
                                    )}`,
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
                    className="text-primary hover:text-primary-dark absolute right-3 rotate-180 top-12 md:top-[70px] p-2 z-50 rounded-full bg-slate-500 border-[8px] border-white hover:bg-primary hover:drop-shadow-primary duration-500"
                    onClick={() => handleScroll(85)}
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                        width={22}
                        height={22}
                        fill="white"
                    >
                        <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
                    </svg>
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
                        className="absolute right-2 top-2 p-2 rounded-md border border-secondary/40 inline-flex bg-slate-300 text-xs fill-secondary text-secondary hover:fill-primary duration-300 shadow-primary-deep not-italic cursor-pointer"
                        onClick={function () {
                            navigator.clipboard.writeText(window.location.href);

                            if (Toast) {
                                Toast.fire({
                                    text: "The shared link copied successfully!",
                                    icon: "success",
                                });
                            }
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
                    Copy the video's <b className="text-primary">Embed</b> link
                </label>
                <div className="bg-white py-2 px-4 border-solid border border-slate-300 relative">
                    <i
                        className="absolute right-2 top-2 p-2 rounded-md border border-secondary/40 inline-flex bg-slate-300 text-xs fill-secondary text-secondary hover:fill-primary duration-300 shadow-primary-deep not-italic cursor-pointer"
                        onClick={function () {
                            navigator.clipboard.writeText(videoIframe);

                            if (Toast) {
                                Toast.fire({
                                    text: "The shared link copied successfully!",
                                    icon: "success",
                                });
                            }
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
    );
}

{
    /* <a className="text-center bg-primary/15 p-2 flex items-center justify-center flex-col rounded-md duration-500 hover:bg-primary text-secondary hover:text-slate-100 cursor-pointer hover:drop-shadow-primary">
<FacebookShareButton
    title="Hello"
    url={window.location.href}
>
    Hello
</FacebookShareButton>
</a>
https://www.facebook.com/share_channel/?link=https%3A%2F%2Fyoutube.com%2Fwatch%3Fv%3DzKzYdpbVtCI%26si%3Du_zaAl2M3jv4yRKX&app_id=87741124305&source_surface=external_reshare&display=popup&hashtag
*/
}
