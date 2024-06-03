import React, { useEffect, useState } from "react";

export function getToken() {
    const tokenId = document.querySelector('meta[name="csrf-token"]');
    if (tokenId) return tokenId.getAttribute("content");

    return "No Token Id Founded!";
}

export default function CsrfToken() {
    const [token, setToken] = useState(getToken());

    useEffect(function () {
        setToken(getToken());
    }, []);

    return <input type="hidden" name="_token" id="_token" value={token} />;
}

export const onlyCsrfToken = { "X-CSRF-TOKEN": getToken() };
