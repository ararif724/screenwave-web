import React from "react";

export default function HeaderContents() {
    return (
        <div className="h-auto py-10 w-full flex flex-col gap-10 items-center justify-center bg-primary-lite mt-24">
            <div className="lg:pt-6 w-9/12 pb-4">
                <iframe
                    className="w-full h-[calc(100vh_-_700px)] md:h-[calc(100vh_-_300px)] rounded-2xl"
                    src="https://www.youtube.com/embed/52GoRYP1les?si=y9dBYJWqSgO9yI2B"
                    title="YouTube video player"
                    frameBorder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowFullScreen
                ></iframe>
            </div>
            <div className="sm:py-6 text-center px-4">
                <h1 className="text-4xl sm:text-6xl font-bold leading-[1.2] pb-4 text-slate-700">
                    One video is worth a thousand words
                </h1>
                <h3 className="text-2xl font-normal leading-8 text-violet-80 text-center px-6 md:px-0">
                    Easily record and share AI-powered video messages with your
                    <br className="hidden md:block" />
                    teammates and customers to supercharge productivity
                </h3>
                <div className="text-center left-8 sm:leading-[6] pt-8">
                    <a
                        href="#"
                        className="bg-primary text-slate-200 sm:px-16 px-6 sm:text-3xl text-xl sm:py-7 py-2.5 rounded-full border-4 border-primary-outline border-solid capitalize tracking-wide"
                    >
                        get ScreenWave for free
                    </a>
                </div>
            </div>
        </div>
    );
}
