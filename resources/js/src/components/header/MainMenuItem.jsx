import React from "react";

import { Link } from "react-router-dom";
import assets from "../../assets";
import MenuList from "./MenuList";

export default function MainMenuItem({
    href,
    title,
    index,
    activeMenuItem,
    setActiveMenuItem,
}) {
    return (
        <li
            className="text-slate-700 relative z-50 group border-b border-solid border-slate-300 p-4 text-xl 2xl:text-md 2xl:border-0 hover:text-primary cursor-pointer min-w-40"
            onClick={function (event) {
                setActiveMenuItem(activeMenuItem === index ? 0 : index);
            }}
            style={{
                fontWeight: activeMenuItem === index && 700,
                color: activeMenuItem === index && "var(--primary)",
            }}
        >
            <div
                to={href}
                className="flex items-center gap-2 2xl:w-auto 2xl:justify-start w-full justify-between"
            >
                <span className="capitalize">{title}</span>

                <span className="duration-500 group-hover:rotate-0 rotate-180 2xl:block hidden">
                    {assets.svg.downArrow(12, 12, "#000")}
                </span>

                <span className="duration-500 group-hover:rotate-0 rotate-180 block 2xl:hidden bg-primary-lite p-1 rounded-full">
                    {assets.svg.downArrow(28, 28, "rgb(86 90 221)")}
                </span>
            </div>
            <div
                className="2xl:absolute z-50 top-6 -left-2 duration-1000 group-hover:!block hidden"
                style={{
                    display: activeMenuItem === index ? "block" : "none",
                }}
            >
                <MenuList />
            </div>
        </li>
    );
}
