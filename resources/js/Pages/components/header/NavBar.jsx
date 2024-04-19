import React, { useState } from "react";
import assets from "../../assets";
import MainMenuItem from "./MainMenuItem";

export default function NavBar() {
    const [mobileNavbar, setMobileNavbar] = useState(true);
    const [activeMenuItem, setActiveMenuItem] = useState(0);

    return (
        <div className="fixed top-0 left-0 w-full bg-slate-100 z-50 shadow-xl">
            <div className="w-full px-10 relative">
                <div className="flex flex-row w-full items-center justify-between">
                    <div className="logo">
                        {/* {assets.svg.screenWave()} */}
                        {/* <picture>{assets.svg.logo(160, 100)}</picture> */}
                        {/* <img src={assets.images.sw} alt="Logo" className="w-40 h-24"/> */}
                        <img
                            src={assets.images.logoMain}
                            alt="Logo"
                            className="w-40 h-24"
                        />
                        {/* <div className="text-3xl py-2 text-primary font-bold"> ScreenWave </div> */}
                        {/* increase/decrease the logo height and fixed the header height size ex: the logo height is 100px now */}
                    </div>
                    <div className="nav flex gap-14">
                        {mobileNavbar && (
                            <ul className="flex flex-col absolute top-24 left-0 bg-slate-100 z-50 2xl:z-10 min-w-screen w-full 2xl:w-auto max-h-screen 2xl:max-w-auto 2xl:min-w-auto 2xl:max-h-auto 2xl:h-auto 2xl:static 2xl:flex-row 2xl:items-center 2xl:justify-end 2xl:gap-6 2xl:text-slate-300 2xl:p-0 py-20 px-10 overflow-auto 2xl:overflow-visible">
                                {/* Main menu item */}
                                <MainMenuItem
                                    href="#"
                                    title="use cases"
                                    index={1}
                                    activeMenuItem={activeMenuItem}
                                    setActiveMenuItem={setActiveMenuItem}
                                    //   setActiveMenuItem(activeMenuItem === 1 ? 0 : 1)
                                />
                                <MainMenuItem
                                    href="#"
                                    title="For Business"
                                    index={2}
                                    activeMenuItem={activeMenuItem}
                                    setActiveMenuItem={setActiveMenuItem}
                                />
                                <MainMenuItem
                                    href="#"
                                    title="Resources"
                                    index={3}
                                    activeMenuItem={activeMenuItem}
                                    setActiveMenuItem={setActiveMenuItem}
                                />
                                <MainMenuItem
                                    href="#"
                                    title="Company"
                                    index={4}
                                    activeMenuItem={activeMenuItem}
                                    setActiveMenuItem={setActiveMenuItem}
                                />

                                {/* Static Menu Button */}
                                <li className="hover:text-slate-900 duration-300 text-slate-700 border-b border-solid border-slate-300 p-4 text-xl 2xl:text-md 2xl:border-0">
                                    <a href="#">Pricing</a>
                                </li>
                                <li className="hover:text-slate-900 duration-300 text-slate-700 border-b border-solid border-slate-300 p-4 text-xl 2xl:text-md 2xl:border-0">
                                    <a href="#">Sign In</a>
                                </li>
                            </ul>
                        )}

                        {/* Navbar Action Button */}
                        <div
                            className="hidden md:!flex flex-row absolute -left-4 top-28 bg-transparent md:bg-slate-100 z-50 md:z-10 min-w-screen w-full md:w-auto max-h-screen md:max-w-auto md:min-w-auto md:max-h-auto md:h-auto md:static items-center justify-center md:justify-end gap-6 md:text-slate-300 overflow-auto md:overflow-visible"
                            style={{ display: !mobileNavbar ? "none" : "flex" }}
                        >
                            <a
                                href="#"
                                className="bg-primary text-slate-200 px-6 py-3 rounded-[35px] border-4 border-primary-outline border-solid capitalize tracking-wide"
                            >
                                get ScreenWave for free
                            </a>
                            <a
                                href="#"
                                className="bg-primary-lite text-primary rounded-[35px] border-4 border-primary border-solid capitalize tracking-wide"
                            >
                                <img
                                    src={assets.images.owner}
                                    alt="Profile"
                                    className="w-14 h-14 rounded-full"
                                />
                            </a>
                        </div>

                        {/* Mobile Menu Button */}
                        <div className="flex items-center justify-center 2xl:hidden">
                            <button
                                className="p-4 rounded-full shadow-2xl border border-solid border-slate-300 bg-primary-lite"
                                onClick={() => setMobileNavbar(!mobileNavbar)}
                            >
                                {assets.svg[
                                    !mobileNavbar ? "menubar" : "close"
                                ](26, 26, "rgb(86 90 221)")}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
