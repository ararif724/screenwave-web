import React from "react";
import assets from "../../assets";

export default function SocialMediaIcon({ icon }) {
    return (
        <div className="bg-primary-lite py-1.5 sm:py-2.5 px-2 sm:px-3 rounded-2xl hover:bg-cyan-500">
            <a href="#">
                {assets.svg.socialMedia[icon](26, 26, "rgb(86 90 221)")}
            </a>
        </div>
    );
}
