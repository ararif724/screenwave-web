import React, { useEffect, useState } from "react";

const getToken = () =>
    document.querySelector('meta[name="csrf-token"]').getAttribute("content");

export default function CsrfToken() {
    const [token, setToken] = useState(getToken());

    useEffect(function () {
        setToken(getToken());
    }, []);

    return <input type="hidden" name="_token" id="_token" value={token} />;
}
