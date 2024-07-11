import HeaderContents from "../header/HeaderContents";
import React from "react";
import Installation from "../installation";
import MarketingAudience from "../marketing-audience";

export default function Home() {
    return (
        <>
            <HeaderContents />
            <Installation />
            <MarketingAudience />
        </>
    );
}
