import React from "react";

export default function FooterItem({ title, links }) {
  return (
    <ul className="w-full md:w-1/5 p-4">
      <li className="p-2">
        <p className="text-lg font-medium uppercase text-slate-700 pb-1 mb-2 border-solid border-purple-400 pr-10 border-b">
          {title}
        </p>
        <p className="flex flex-col">
          {links.map((link, index) => (
            <a
              href={link.href}
              target="_blank"
              className="text-slate-600 duration-300 hover:underline hover:text-purple-500 font-medium leading-6 font-mono"
              key={index}
            >
              {link.name}
            </a>
          ))}
        </p>
      </li>
    </ul>
  );
}
