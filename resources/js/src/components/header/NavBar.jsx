import React, { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { Link } from "react-router-dom";
import assets from "../../assets";
import MainMenuItem from "./MainMenuItem";
import ProfileBubble from "./ProfileBubble";

export default function NavBar() {
    const [mobileNavbar, setMobileNavbar] = useState(true);
    const [activeMenuItem, setActiveMenuItem] = useState(0);
    const { check, user } = useSelector((state) => state.auth);

    const debounce = (func, delay) => {
        let timeoutId;
        return function (...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
                func.apply(this, args);
            }, delay);
        };
    };

    const handleResize = debounce(() => {
        if (window.innerWidth > 1536) {
            setMobileNavbar(true);
        } else {
            setMobileNavbar(false);
        }
    }, 300);

    useEffect(() => {
        handleResize();
        window.addEventListener("resize", handleResize);
        return () => {
            window.removeEventListener("resize", handleResize);
        };
    }, []);

    return (
        <div className="fixed top-0 left-0 w-full bg-slate-100 z-50 shadow-xl">
            <div className="w-full px-10 relative">
                <div className="flex flex-row w-full items-center justify-between">
                    <Link to="/" className="logo block">
                        <img
                            src={assets.images.logoMain}
                            alt="Logo"
                            className="w-40 h-24"
                        />
                    </Link>
                    <div className="nav flex gap-14">
                        {mobileNavbar && (
                            <ul className="flex flex-col absolute top-24 left-0 bg-slate-100 z-50 2xl:z-10 min-w-screen w-full 2xl:w-auto max-h-screen 2xl:max-w-auto 2xl:min-w-auto 2xl:max-h-auto 2xl:h-auto 2xl:static 2xl:flex-row 2xl:items-center 2xl:justify-end 2xl:gap-6 2xl:text-slate-300 2xl:p-0 py-20 px-10 overflow-auto 2xl:overflow-visible">
                                {/* Main menu item */}
                                <MainMenuItem
                                    href="/video/random"
                                    title="use cases"
                                    index={1}
                                    activeMenuItem={activeMenuItem}
                                    setActiveMenuItem={setActiveMenuItem}
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
                                    <a href="#" className="opacity-0">
                                        Pricing
                                    </a>
                                </li>
                                {check ? /* <form
                                        method="POST"
                                        action={window.route("/logout")}
                                        className="hover:text-slate-900 duration-300 text-slate-700 border-b border-solid border-slate-300 p-4 text-xl 2xl:text-md 2xl:border-0"
                                    >
                                        <CsrfToken />
                                        <button type="submit">Log Out</button>
                                    </form> */ null : (
                                    <li className="hover:text-slate-900 duration-300 text-slate-700 border-b border-solid border-slate-300 p-4 text-xl 2xl:text-md 2xl:border-0">
                                        <a
                                            href={window.route(
                                                "/google-o-auth/"
                                            )}
                                        >
                                            Sign In
                                        </a>
                                    </li>
                                )}
                            </ul>
                        )}

                        {/* Navbar Action Button // style={{ display: !mobileNavbar ? "none" : "flex" }} */}
                        <div className="flex items-center justify-center gap-5">
                            <a
                                href="#"
                                className="hidden md:block bg-primary/80 text-slate-100 hover:text-white duration-500 px-6 py-3 rounded-[35px] border-4 border-primary-outline border-solid capitalize tracking-wide hover:bg-primary font-medium"
                            >
                                get ScreenWave for free
                            </a>

                            {
                                // Render the Profile bubble
                                check && <ProfileBubble user={user} />
                            }
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
