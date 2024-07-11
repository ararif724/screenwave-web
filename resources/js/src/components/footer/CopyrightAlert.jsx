import assets from "../../assets";
import React from "react";

import SocialMediaIcon from "./SocialMediaIcon";

export default function CopyrightAlert() {
    return (
        <div className="w-full flex items-center justify-center bg-primary-light">
            <div className="container py-6 flex flex-col md:flex-row md:gap-0 gap-4 justify-center items-center md:items-start md:justify-between">
                <div className="flex gap-2 md:gap-6">
                    <SocialMediaIcon icon="facebook" />
                    <SocialMediaIcon icon="youtube" />
                    <SocialMediaIcon icon="linkedin" />
                    <SocialMediaIcon icon="twitter" />
                    <SocialMediaIcon icon="github" />
                </div>
                <div className="text-slate-500 text-xs sm:text-lg flex gap-2 w-full items-center justify-center md:justify-end">
                    <span>©Copyright</span>
                    <span className="text-red-700 font-medium text-sm sm:text-xl">
                        {new Date().getFullYear()}
                    </span>
                    <span>ScreenWave Official Team.</span>
                </div>
            </div>
        </div>
    );
}
