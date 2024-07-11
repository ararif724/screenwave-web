import React from "react";
import { BallTriangle } from "react-loader-spinner";

export default function BallTriangleLoader({ message = "" }) {
    return (
        <div className="w-full gap-10 py-12 mt-28 flex items-center justify-center flex-col">
            <BallTriangle
                height={100}
                width={100}
                radius={5}
                color="rgb(244 63 94)"
                ariaLabel="ball-triangle-loading"
                wrapperStyle={{}}
                wrapperClass=""
                visible={true}
            />
            <h1 className="text-4xl p-4 text-rose-500">{message}</h1>
        </div>
    );
}
