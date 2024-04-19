import React from "react";
import assets from "../../assets";

export default function MenuList() {
  return (
    <div className="2xl:mt-10 mr-0 relative text-purple-500">
      <ul className="p-6 bg-slate-100 2xl:bg-white 2xl:shadow-xl text-slate-700 rounded-2xl w-80 relative">
        <li className="bg-slate-100 2xl:bg-white w-8 h-8 absolute -top-3 left-10 rotate-45 2xl:block hidden"></li>
        <DropdownItem
          icon={assets.svg.team(22, 22, "rgb(248 113 113)")}
          title="Team Management"
          href="#"
        />
        <DropdownItem
          icon={assets.svg.dollar(22, 18, "rgb(74 222 128)")}
          title="Sales"
          href="#"
        />
        <DropdownItem
          icon={assets.svg.code(22, 18, "rgb(168 85 247)")}
          title="Engineering"
          href="#"
        />
        <DropdownItem
          icon={assets.svg.design(22, 18, "rgb(139 92 246)")}
          title="Design"
          href="#"
        />
        <DropdownItem
          icon={assets.svg.edit(22, 18, "rgb(244 63 94)")}
          title="Marketing"
          href="#"
        />
        <DropdownItem
          icon={assets.svg.dollar(22, 18, "rgb(34 197 94)")}
          title="Money"
          href="#"
        />
      </ul>
    </div>
  );
}

const DropdownItem = ({ icon, title, href }) => (
  <li className="p-2.5">
    <a href={href} className="flex gap-6 text-center">
      <span className="font-light">{icon}</span>
      <span className="text-sla-600 text-sm text-center duration-300 hover:text-slate-800">
        {title}
      </span>
    </a>
  </li>
);
/* <li className="p-1">
          <a href="#" className="flex gap-6 text-center">
            <span className="text-red-400">{assets.svg.team(22, 22)}</span>
            <span className="text-sla-600 text-sm text-center duration-300 hover:text-slate-800">
              Team Management
            </span>
          </a>
        </li> */
