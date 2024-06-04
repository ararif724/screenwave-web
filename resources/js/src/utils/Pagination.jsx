import React from "react";
import assets from "../assets";

export default function Pagination() {
    return (
        <div className="w-full p-2 flex items-center justify-between gap-1 border-b border-solid border-slate-300 pb-3">
            <h2 className="text-2xl font-medium text-slate-400 underline">
                Comments
            </h2>
            <ul className="flex gap-4 bg-white p-2 items-center justify-center border border-solid border-slate-300 shadow-[0px_2px_4px_0px_rgba(0,0,0,0.12)] rounded-md group active">
                <li className="border border-green-500 bg-green-100/30 rounded border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200">
                    <a href="#">{assets.svg.leftArrows(14, 14)}</a>
                </li>
                <div className="flex">
                    <li className="border border-green-500 bg-green-100/30 rounded-tl rounded-bl border-r-0 border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200">
                        <a href="#">{assets.svg.leftArrow(13, 13)}</a>
                    </li>
                    <li className="border border-green-500 bg-green-100/30 border-r-0 border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 group-[.active]:bg-green-500 group-[.active]:text-slate-100 duration-500 hover:bg-green-200">
                        <a href="#">1</a>
                    </li>
                    <li className="border border-green-500 bg-green-100/30 border-r-0 border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200">
                        <a href="#">2</a>
                    </li>
                    <li className="border border-green-500 bg-green-100/30 border-r-0 border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200">
                        <a href="#">3</a>
                    </li>
                    <li className="border border-green-500 bg-green-100/30 rounded-tr rounded-br border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200">
                        <a href="#">{assets.svg.rightArrow(14, 14)}</a>
                    </li>
                </div>
                <li className="border border-green-500 bg-green-100/30 rounded border-solid w-8 h-8 items-center justify-center flex text-slate-600 fill-slate-500 duration-500 hover:bg-green-200">
                    <a href="#">{assets.svg.rightArrows(14, 14)}</a>
                </li>
            </ul>
        </div>
    );
}
