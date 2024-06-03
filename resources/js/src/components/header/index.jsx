import React from "react";
import NavBar from "./NavBar";
import assets from "../../assets";
import HeaderContents from "./HeaderContents";

export default function Header() {
  return (
    <header className="bg-slate-100">
      {/* Navbar section and a fixed navbar */}
      <div className="min-h-20 w-full">
        <NavBar />
      </div>
      <div className="w-full">
        <HeaderContents />
      </div>
    </header>
  );
}
