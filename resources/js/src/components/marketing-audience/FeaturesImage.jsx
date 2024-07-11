import React from "react";
import assets from "../../assets";
import FeaturesListItem from "./FeaturesListItem";

export default function FeaturesImage() {
    return (
        <div className="w-full flex items-center justify-center bg-slate-100 pt-10 pb-20">
            <div className="container">
                <div className="p-4 sm:p-10 bg-gray-90 rounded-[50px] sm:rounded-[100px] flex flex-col lg:flex-row text-slate-300 gap-10">
                    {/* Mainly the demo message center */}
                    <div className="w-full flex items-center justify-center pt-4 sm:pt-10 px-4 sm:px-10 lg:p-10">
                        <textarea
                            name=""
                            className="bg-slate-900 outline-none border border-solid border-primary h-full resize-none p-4 rounded-3xl w-full placeholder:text-primary font-medium text-xl"
                            id=""
                            cols="30"
                            readOnly
                            rows="10"
                            placeholder="Generating Text..."
                        ></textarea>
                    </div>

                    {/* Simple Features list */}
                    <div className="w-full p-4">
                        <h1 className="text-5xl sm:text-7xl font-normal relative">
                            <span className="relative">
                                ScreenWave AI
                                <span className="absolute -top-4 -right-8 opacity-60">
                                    {assets.svg.colorfulStar(40, 40)}
                                </span>
                            </span>
                        </h1>
                        <h3 className="font-light text-xl leading-7 py-6 tracking-wide">
                            Record better & super faster video messages with
                            ScreenWave AI — so you can be more productive and
                            efficient at work. All without lifting a finger. Try
                            for free, then add to your plan for
                            $4/creator/month.
                        </h3>
                        <div className="flex flex-wrap w-full">
                            {[
                                { title: "Message Composer", isNew: true },
                                { title: "Auto CTA", isNew: true },
                                { title: "Auto Summaries", isNew: false },
                                { title: "Auto Titles", isNew: true },
                                { title: "Filler World Removal", isNew: false },
                                { title: "Silence Removal", isNew: false },
                            ].map((list, index) => (
                                <div
                                    key={index}
                                    className="sm:w-6/12 w-full flex items-center justify-start"
                                    style={{
                                        paddingLeft:
                                            index % 2 === 0 ? "0px" : "12px",
                                    }}
                                >
                                    <FeaturesListItem
                                        isNew={list.isNew}
                                        title={list.title}
                                    />
                                </div>
                            ))}
                        </div>
                        <div className="pt-10">
                            <a
                                href="#"
                                className="bg-primary text-slate-200 px-6 py-4 rounded-[35px] border-4 border-violet-900 border-solid capitalize tracking-wide text-sm"
                            >
                                Try for free
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
