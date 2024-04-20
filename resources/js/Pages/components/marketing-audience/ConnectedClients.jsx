import React from "react";
import { clientCompaniesLogos } from "../../assets";

export default function ConnectedClients() {
    return (
        <div className="w-full flex items-center justify-center bg-slate-100">
            <div className="container">
                <h1 className="text-4xl sm:text-5xl font-bold text-slate-700 leading-[1.3] text-center py-10 sm:py-20">
                    More than 25 million people across{" "}
                    <br className="hidden sm:block" /> 400,000 companies choose
                    ScreenWave.
                </h1>

                {/* Client Companies Logo */}
                <div className="w-full flex flex-wrap items-center justify-center pb-10">
                    {clientCompaniesLogos.map((logo, index) => (
                        <div
                            className="w-ful flex items-center justify-center lg:w-[14.2857143%] p-6"
                            key={index}
                        >
                            <img
                                src={logo}
                                alt="Client Company's Logo"
                                className="max-w-48 w-full max-h-16 opacity-50"
                            />
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
