import React from "react";
import assets from "../../assets";

export default function InstallationFaqItem({ title }) {
  return (
    <li className="flex relative items-center py-3 pl-0 sm:pl-28 pr-7 bg-gradient-to-r from-white/5 via-white/70 to-transparent gap-3">
      <div className="absolute top-0 left-0 min-w-full h-px bg-gradient-to-r from-transparent via-sky-600/40 via-10% to-sky-600/5"></div>
      <div className="absolute bottom-0 left-0 min-w-full h-px bg-gradient-to-r from-transparent via-sky-600/40 via-10% to-sky-600/5"></div>
      <span>{assets.svg.checkMark(24, 24)}</span>
      <span>{title}</span>
    </li>
  );
}
