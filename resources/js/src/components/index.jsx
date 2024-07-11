import React from "react";
import Footer from "./footer";
import NavBar from "./header/NavBar";

export default function Components({ children }) {
    return (
        <>
            <NavBar />
            {children}
            <Footer />
        </>
    );
}
