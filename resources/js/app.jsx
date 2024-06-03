import React from "react";
import { createRoot } from "react-dom/client";
import store from "./src/redux/store";
import { Provider } from "react-redux";
import App from "./src";

const root = document.getElementById("root");
if (root)
    createRoot(root).render(
        <Provider store={store}>
            <App />
        </Provider>
    );

if ("asset" in window && "route" in window && "baseURL" in window) {
    console.log("Asset, Route & Base URL Is Available in globally");
}
