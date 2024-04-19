import React, { useEffect, useRef, useState } from "react";
import { createRoot } from "react-dom/client";
import Home from "./src/pages/Home";
import VideoPlayer from "./src/pages/Video";

const homeId = document.getElementById("reactHome");
const videoPlayerId = document.getElementById("videoPlayer");

if (homeId) {
    createRoot(homeId).render(<Home />);
}

if (videoPlayerId) {
    createRoot(videoPlayerId).render(<VideoPlayer />);
}
