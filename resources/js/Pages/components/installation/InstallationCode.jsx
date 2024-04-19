import React from "react";

export default function InstallationCode() {
    return (
        <div className="w-full bg-primary-lite flex items-center justify-center h-full">
            <div className="container h-full py-10 lg:py-20">
                <div className="flex lg:flex-row flex-col w-full gap-10 lg:gap-20 h-full items-center justify-center">
                    {/* Code Block for install to using a package manager in terminal */}
                    <div className="w-full">
                        <div className="p-4 bg-slate-900 rounded-2xl">
                            <div className="flex gap-2.5 w-full">
                                <div className="h-4 w-4 rounded-full bg-green-500"></div>
                                <div className="h-4 w-4 rounded-full bg-yellow-500"></div>
                                <div className="h-4 w-4 rounded-full bg-red-500"></div>
                            </div>
                            <div className="border-b border-solid border-slate-600 mt-2.5"></div>
                            <div className="text-slate-100 p-2.5 mt-4 flex flex-col gap-2.5">
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">1</p>
                                    <p className="text-slate-500">|</p>
                                    <p className="flex flex-wrap sm:flex-nowrap gap-2.5">
                                        <span className="text-slate-400">
                                            &gt;
                                        </span>
                                        <span className="text-slate-400">
                                            Install flyctl in
                                        </span>
                                        <span className="text-purple-300 font-semibold">
                                            GNU/Linux
                                        </span>
                                    </p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">2</p>
                                    <p className="text-slate-500">|</p>
                                    <p className="text-green-500">$</p>
                                    <p className="flex gap-2.5">
                                        <span className="text-slate-100">
                                            curl -L{" "}
                                        </span>
                                        <span className="text-purple-500 break-all">
                                            https://fly.io/install.sh
                                        </span>
                                        <span className="text-slate-100">
                                            {" "}
                                            | sh
                                        </span>
                                    </p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">3</p>
                                    <p className="text-slate-500">|</p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">4</p>
                                    <p className="text-slate-500">|</p>
                                    <p className="flex gap-2.5">
                                        <span className="text-slate-400">
                                            &gt;
                                        </span>
                                        <span className="text-slate-400">
                                            Ship
                                        </span>
                                        <span className="text-purple-300 font-semibold">
                                            Docker
                                        </span>
                                        <span className="text-slate-400">
                                            image
                                        </span>
                                    </p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">5</p>
                                    <p className="text-slate-500">|</p>
                                    <p className="text-green-500">$</p>
                                    <p className="flex gap-2.5">
                                        <span className="text-slate-100">
                                            fly{" "}
                                        </span>
                                        <span className="text-slate-100">
                                            launch
                                        </span>
                                    </p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">6</p>
                                    <p className="text-slate-500">|</p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">7</p>
                                    <p className="text-slate-500">|</p>
                                    <p className="flex flex-wrap sm:flex-nowrap gap-2.5">
                                        <span className="text-slate-400">
                                            &gt;
                                        </span>
                                        <span className="text-slate-400">
                                            Run it on the
                                        </span>
                                        <span className="text-purple-300 font-semibold">
                                            Three
                                        </span>
                                        <span className="text-slate-400">
                                            conditions
                                        </span>
                                    </p>
                                </code>
                                <code className="flex gap-2.5">
                                    <p className="text-slate-500">8</p>
                                    <p className="text-slate-500">|</p>
                                    <p className="text-green-500">$</p>
                                    <p className="flex flex-wrap sm:flex-nowrap gap-2.5">
                                        <span className="text-slate-100">
                                            fly scale count 3
                                        </span>
                                        <span className="text-cyan-800">
                                            --region
                                        </span>
                                        <span className="text-cyan-500">
                                            ams
                                            <span className="text-slate-100">
                                                ,
                                            </span>
                                        </span>
                                        <span className="text-red-500">
                                            hkg
                                            <span className="text-slate-100">
                                                ,
                                            </span>
                                        </span>
                                        <span className="text-green-500">
                                            sjc
                                        </span>
                                    </p>
                                </code>
                            </div>
                        </div>
                    </div>

                    {/* Manual guideline for installation process */}
                    <div className="w-full">
                        <p className="pb-5 text-primary font-semibold">
                            READY, SET, GO!
                        </p>
                        <h1 className="text-2xl sm:text-4xl font-medium text-slate-900 leading-[1.1] text-start sm:text-justify ">
                            Launch Apps Near Users Speedrun Your App Onto.
                        </h1>
                        <p className="py-5 text-xl font-light text-slate-700 text-justify">
                            Fly.io We’ll deploy straight from your source code.
                            You’ll be up and running in just minutes. Learn More
                        </p>
                        <div className="pt-4">
                            <a
                                href="#"
                                className="bg-primary text-slate-200 px-6 py-3 rounded-[35px] border-4 border-primary-outline border-solid capitalize tracking-wide"
                            >
                                get ScreenWave for free
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
